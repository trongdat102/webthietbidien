<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

use Illuminate\Http\Request;

class ProductController extends Controller

{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard'); // Thêm dấu chấm phẩy ở đây
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function add_product()
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        $provider_product = DB::table('tbl_provider_product')->orderby('provider_id', 'desc')->get();

        return view('admin.add_product', [
            'cate_product' => $cate_product,
            'brand_product' => $brand_product,
            'provider_product' => $provider_product
        ]);
    }

    public function all_product()
    {
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->join('tbl_provider_product', 'tbl_provider_product.provider_id', '=', 'tbl_product.provider_id')
            ->select('tbl_product.*', 'tbl_category_product.category_name', 'tbl_brand.brand_name', 'tbl_provider_product.provider_name')
            ->paginate(10);// Lấy dữ liệu từ cơ sở dữ liệu

        $manager_product = view('admin.all_product')->with('all_product', $all_product);

        return view('admin_layout')->with('admin_content', $manager_product);
    }

    public function save_product(Request $request)
    {
        $this->AuthLogin();

        // Thực hiện validate dữ liệu đầu vào
        $request->validate([
            'product_quantity' => 'required|numeric',
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_desc' => 'required',
            'product_content' => 'required',
            'product_cate' => 'required',
            'product_brand' => 'required',
            'product_provider' => 'required',
            'product_status' => 'required',
            'product_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            // Thông báo lỗi cho từng trường
            'product_quantity.required' => 'Vui lòng nhập số lượng sản phẩm.',
            'product_quantity.numeric' => 'Số lượng sản phẩm phải là số.',
            'product_name.required' => 'Vui lòng nhập tên sản phẩm.',
            'product_price.required' => 'Vui lòng nhập giá sản phẩm.',
            'product_price.numeric' => 'Giá sản phẩm phải là số.',
            'product_desc.required' => 'Vui lòng nhập mô tả sản phẩm.',
            'product_content.required' => 'Vui lòng nhập thông số kỹ thuật.',
            'product_cate.required' => 'Vui lòng chọn loại sản phẩm.',
            'product_brand.required' => 'Vui lòng chọn thương hiệu.',
            'product_provider.required' => 'Vui lòng chọn nhà cung cấp.',
            'product_status.required' => 'Vui lòng chọn trạng thái hiển thị.',
            'product_image.image' => 'File tải lên phải là hình ảnh.',
            'product_image.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc gif.',
            'product_image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.'
        ]);

        // Lưu dữ liệu sản phẩm vào cơ sở dữ liệu
        $data = [];
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['provider_id'] = $request->product_provider;
        $data['product_status'] = $request->product_status;

        // Xử lý ảnh tải lên
        $get_image = $request->file('product_image');
        if ($get_image) {
            $new_image = rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
        }

        DB::table('tbl_product')->insert($data);

        // Đặt thông báo và điều hướng
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('add-product');
    }


    public function unactive_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->update(['product_status' => 1]); // Sử dụng mảng để cập nhật giá trị

        Session::put('message', 'Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function active_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->update(['product_status' => 0]); // Sử dụng mảng để cập nhật giá trị

        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        $provider_product = DB::table('tbl_provider_product')->orderby('provider_id', 'desc')->get();

        $all_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $all_product)->with('cate_product', $cate_product)
            ->with('brand_product', $brand_product)->with('provider_product', $provider_product);
        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['provider_id'] = $request->product_provider;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');

        if ($get_image) {
            $new_image = rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
        }

        // Sử dụng update thay vì insert
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);

        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function delete_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }

    // End Admin Page
    public function details_product($product_id)
    {

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();

        // Lấy danh sách các thương hiệu sản phẩm
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $details_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->join('tbl_provider_product', 'tbl_provider_product.provider_id', '=', 'tbl_product.provider_id')
            ->where('tbl_product.product_id', $product_id)
            ->get();

        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
        }


        $related_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->join('tbl_provider_product', 'tbl_provider_product.provider_id', '=', 'tbl_product.provider_id')
            ->where('tbl_category_product.category_id', $category_id)
            ->whereNotIn('tbl_product.product_id', [$product_id])
            ->get();
        return view('pages.sanpham.show_details')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('product_details', $details_product)->with('relate', $related_product);

    }


}
