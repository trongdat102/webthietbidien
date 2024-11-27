<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function AuthLogin() {
    $admin_id = Session::get('admin_id');
    if ($admin_id) {
        return Redirect::to('dashboard'); // Thêm dấu chấm phẩy ở đây
    } else {
        return Redirect::to('admin')->send(); 
    }
}
    public function add_provider_product(){
        $this->AuthLogin();
        return view('admin.add_provider_product');
    }
    public function all_provider_product(){
        $this->AuthLogin();
        $all_provider_product = DB::table('tbl_provider_product')->get();
        $manager_provider_product = view('admin.all_provider_product')->with('all_provider_product',$all_provider_product);
        return view('admin_layout')->with('admin.all_provider_product', $manager_provider_product);
    }   
    public function save_provider_product(Request $request) {
        $this->AuthLogin();
    // Thêm yêu cầu xác thực
    $request->validate([
        'provider_product_name' => 'required',
        'provider_product_desc' => 'required',
        'provider_product_status' => 'required'
    ], [
        // Tùy chỉnh thông báo lỗi
        'provider_product_name.required' => 'Vui lòng nhập tên nhà cung cấp.',
        'provider_product_desc.required' => 'Vui lòng nhập mô tả cho nhà cung cấp.',
        'provider_product_status.required' => 'Vui lòng chọn trạng thái hiển thị.'
    ]);

    // Thêm dữ liệu vào database nếu hợp lệ
    $data = [
        'provider_name' => $request->provider_product_name,
        'provider_desc' => $request->provider_product_desc,
        'provider_status' => $request->provider_product_status
    ];

    DB::table('tbl_provider_product')->insert($data);
    Session::put('message', 'Thêm nhà cung cấp thành công');
    return Redirect::to('/add-provider-product');
}

    public function unactive_provider_product($provider_product_id)
{   $this->AuthLogin();
    DB::table('tbl_provider_product')
        ->where('provider_id', $provider_product_id)
        ->update(['provider_status' => 1]); // Sử dụng mảng để cập nhật giá trị

    Session::put('message', 'Không kích hoạt danh mục nhà cung thành công');
    return Redirect::to('all-provider-product');
}

    public function active_provider_product($provider_product_id)
{   $this->AuthLogin();
    DB::table('tbl_provider_product')
        ->where('provider_id', $provider_product_id)
        ->update(['provider_status' => 0]); // Sử dụng mảng để cập nhật giá trị

    Session::put('message', 'Kích hoạt danh mục nhà cung cấp thành công');
    return Redirect::to('all-provider-product');
}
    public function edit_provider_product($provider_product_id){
        $this->AuthLogin();
        $all_provider_product = DB::table('tbl_provider_product')->where('provider_id',$provider_product_id)->get();
        $manager_provider_product = view('admin.edit_provider_product')->with('edit_provider_product',$all_provider_product);
        return view('admin_layout')->with('admin.edit_provider_product', $manager_provider_product);
    }
    public function update_provider_product(Request $request,$provider_product_id){
        $this->AuthLogin();
        $data = array();
        $data['provider_name'] = $request->provider_product_name;
        $data['provider_desc'] = $request->provider_product_desc;
        DB::table('tbl_provider_product')->where('provider_id',$provider_product_id)->update($data);
        Session::put('message', 'Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-provider-product');
    }
    public function delete_provider_product($provider_product_id){
        $this->AuthLogin();
        DB::table('tbl_provider_product')->where('provider_id',$provider_product_id)->delete();
        Session::put('message', 'Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-provider-product');
    }
}
