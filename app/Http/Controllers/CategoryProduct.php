<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class CategoryProduct extends Controller
{
    public function AuthLogin() {
    $admin_id = Session::get('admin_id');
    if ($admin_id) {
        return Redirect::to('dashboard'); // Thêm dấu chấm phẩy ở đây
    } else {
        return Redirect::to('admin')->send(); 
    }
}
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
    }   
    public function luu_danhmucsanpham(Request $request){
        $this->AuthLogin();
    // Validation yêu cầu các trường bắt buộc
    $request->validate([
        'category_product_name' => 'required',
        'category_product_desc' => 'required',
        'category_product_status' => 'required'
    ], [
        // Thông báo lỗi tùy chỉnh
        'category_product_name.required' => 'Vui lòng nhập tên loại thiết bị.',
        'category_product_desc.required' => 'Vui lòng nhập mô tả loại thiết bị.',
        'category_product_status.required' => 'Vui lòng chọn trạng thái hiển thị.'
    ]);

    // Lưu dữ liệu vào cơ sở dữ liệu nếu không có lỗi
    $data = array();
    $data['category_name'] = $request->category_product_name;
    $data['category_desc'] = $request->category_product_desc;
    $data['category_status'] = $request->category_product_status;

    DB::table('tbl_category_product')->insert($data);
    Session::put('message', 'Thêm loại thiết bị thành công');
    return Redirect::to('/add-category-product');
}

    public function unactive_category_product($category_product_id)
{   $this->AuthLogin();
    DB::table('tbl_category_product')
        ->where('category_id', $category_product_id)
        ->update(['category_status' => 1]); // Sử dụng mảng để cập nhật giá trị

    Session::put('message', 'Không kích hoạt danh mục sản phẩm thành công');
    return Redirect::to('all-category-product');
}

    public function active_category_product($category_product_id)
{   $this->AuthLogin();
    DB::table('tbl_category_product')
        ->where('category_id', $category_product_id)
        ->update(['category_status' => 0]); // Sử dụng mảng để cập nhật giá trị

    Session::put('message', 'Kích hoạt danh mục sản phẩm thành công');
    return Redirect::to('all-category-product');
}
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$all_category_product);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message', 'Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message', 'Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    //end function admin page

    public function show_category_home($category_id) {
    // Lấy danh sách các danh mục sản phẩm
    $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();

    // Lấy danh sách các thương hiệu sản phẩm
    $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

    // Lấy sản phẩm theo ID danh mục
    $category_by_id = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->where('tbl_product.category_id', $category_id)
        ->get(); // Thực hiện truy vấn để lấy dữ liệu
    $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();

    // Trả về view với các biến
    return view('pages.category.show_category')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('category_by_id', $category_by_id) // Không cần gọi get() ở đây
        ->with('category_name', $category_name);
}
}
