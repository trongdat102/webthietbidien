<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function AuthLogin() {
    $admin_id = Session::get('admin_id');
    if ($admin_id) {
        return Redirect::to('dashboard'); // Thêm dấu chấm phẩy ở đây
    } else {
        return Redirect::to('admin')->send(); 
    }
}
    public function add_payment(){
        $this->AuthLogin();
        return view('admin.add_payment');
    }
    public function all_payment(){
        $this->AuthLogin();
        $all_payment = DB::table('tbl_payment')->get();
        $manager_payment = view('admin.all_payment')->with('all_payment',$all_payment);
        return view('admin_layout')->with('admin.all_payment', $manager_payment);
    }   
    public function save_payment(Request $request) {
    $this->AuthLogin();

    // Validate request
    $request->validate([
        'payment_select' => 'required',
        'payment_status' => 'required'
    ], [
        'payment_select.required' => 'Vui lòng chọn phương thức thanh toán.',
        'payment_status.required' => 'Vui lòng chọn trạng thái hiển thị.'
    ]);

    // Lưu dữ liệu vào database
    $data = [
        'payment_method' => $request->payment_select, // Nhận giá trị từ select
        'payment_status' => $request->payment_status
    ];

    DB::table('tbl_payment')->insert($data);
    Session::put('message', 'Thêm phương thức thanh toán thành công');
    return Redirect::to('/all-payment');
}


    public function unactive_payment($payment_id)
{   $this->AuthLogin();
    DB::table('tbl_payment')
        ->where('payment_id', $payment_id)
        ->update(['payment_status' => 1]); // Sử dụng mảng để cập nhật giá trị

    Session::put('message', 'Không kích hoạt danh mục nhà cung thành công');
    return Redirect::to('all-payment');
}

    public function active_payment($payment_id)
{   $this->AuthLogin();
    DB::table('tbl_payment')
        ->where('payment_id', $payment_id)
        ->update(['payment_status' => 0]); // Sử dụng mảng để cập nhật giá trị

    Session::put('message', 'Kích hoạt danh mục phương thức thanh toán thành công');
    return Redirect::to('all-payment');
}
    public function edit_payment($payment_id){
        $this->AuthLogin();
        $all_payment = DB::table('tbl_payment')->where('payment_id',$payment_id)->get();
        $manager_payment = view('admin.edit_payment')->with('edit_payment',$all_payment);
        return view('admin_layout')->with('admin.edit_payment', $manager_payment);
    }
    public function update_payment(Request $request,$payment_id){
        $this->AuthLogin();
        $data = array();
        $data['payment_method'] = $request->payment_method;
        DB::table('tbl_payment')->where('payment_id',$payment_id)->update($data);
        Session::put('message', 'Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-payment-product');
    }
    public function delete_payment($payment_id){
        $this->AuthLogin();
        DB::table('tbl_payment')->where('payment_id',$payment_id)->delete();
        Session::put('message', 'Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-payment');
    }
    public function checkout() {
    $payment_method = DB::table('tbl_payment')
        ->where('payment_status', 0) // Chỉ lấy phương thức thanh toán đang kích hoạt
        ->get();

    return view('pages.checkout')->with(compact('payment_method'));
}

}
