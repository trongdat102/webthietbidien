<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class BrandProduct extends Controller
{
    public function AuthLogin() {
    $admin_id = Session::get('admin_id');
    if ($admin_id) {
        return Redirect::to('dashboard'); // Thêm dấu chấm phẩy ở đây
    } else {
        return Redirect::to('admin')->send(); 
    }
}
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);
    }   
    public function save_brand_product(Request $request){
    // Thêm các yêu cầu xác thực
    $request->validate([
        'brand_product_name' => 'required',
        'brand_product_desc' => 'required',
        'brand_product_status' => 'required'
    ], [
        // Tùy chỉnh thông báo lỗi cho từng trường
        'brand_product_name.required' => 'Vui lòng nhập tên thương hiệu.',
        'brand_product_desc.required' => 'Vui lòng nhập mô tả thương hiệu.',
        'brand_product_status.required' => 'Vui lòng chọn trạng thái hiển thị.'
    ]);

    // Nếu xác thực thành công, thêm dữ liệu vào database
    $data = array();
    $data['brand_name'] = $request->brand_product_name;
    $data['brand_desc'] = $request->brand_product_desc;
    $data['brand_status'] = $request->brand_product_status;

    DB::table('tbl_brand')->insert($data);
    Session::put('message', 'Thêm thương hiệu sản phẩm thành công');
    return Redirect::to('/add-brand-product');
}

    public function unactive_brand_product($brand_product_id)
{   $this->AuthLogin();
    DB::table('tbl_brand')
        ->where('brand_id', $brand_product_id)
        ->update(['brand_status' => 1]); // Sử dụng mảng để cập nhật giá trị

    Session::put('message', 'Không kích hoạt danh mục sản phẩm thành công');
    return Redirect::to('all-brand-product');
}

    public function active_brand_product($brand_product_id)
{   $this->AuthLogin();
    DB::table('tbl_brand')
        ->where('brand_id', $brand_product_id)
        ->update(['brand_status' => 0]); // Sử dụng mảng để cập nhật giá trị

    Session::put('message', 'Kích hoạt danh mục sản phẩm thành công');
    return Redirect::to('all-brand-product');
}
    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }
    public function update_brand_product(Request $request,$brand_product_id){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        Session::put('message', 'Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('message', 'Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    //end function admin page
    public function show_brand_home($brand_id) {
    // Lấy danh sách các danh mục sản phẩm
    $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();

    // Lấy danh sách các thương hiệu sản phẩm
    $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

    // Lấy sản phẩm theo ID thương hiệu
    $brand_by_id = DB::table('tbl_product')
        ->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
        ->where('tbl_product.brand_id', $brand_id)
        ->get(); // Thực hiện truy vấn để lấy dữ liệu
    $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();

    // Trả về view với các biến
    return view('pages.brand.show_brand')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('brand_by_id', $brand_by_id) // Sử dụng biến đã được định nghĩa
        ->with('brand_name', $brand_name);
}

}
