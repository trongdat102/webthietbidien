<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function confirm_order(Request $request){
        $data = $request->all();
        if (!Session::has('cart') || count(Session::get('cart')) == 0) {
        return response()->json([
            'status' => 'error',
            'message' => 'Giỏ hàng trống. Vui lòng thêm sản phẩm trước khi đặt hàng!'
        ], 400); // Trả về lỗi với mã 400 (Bad Request)
    }
        $shipping = new Shipping();
        $shipping -> shipping_name = $data['shipping_name'];
        $shipping -> shipping_address = $data['shipping_address'];
        $shipping -> shipping_phone = $data['shipping_phone'];
        $shipping -> shipping_email = $data['shipping_email'];
        $shipping -> shipping_notes = $data['shipping_notes'];
        $shipping -> shipping_method = $data['shipping_method'];
        $shipping -> save();
        $shipping_id = $shipping -> shipping_id;

        $checkout_code = substr(md5(microtime()), rand(0,26),5);

        $order = new Order();
        $order -> customer_id = Session::get('customer_id');
        $order -> shipping_id = $shipping_id;
        $order -> order_status = 1;
        $order -> order_code = $checkout_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order -> created_at = $today;
        $order -> order_date = $order_date;
        $order -> save();
        if(Session::get('cart')){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails;
                $order_details -> order_code = $checkout_code;
                $order_details -> product_id = $cart['product_id'];
                $order_details -> product_name = $cart['product_name'];
                $order_details -> product_price = $cart['product_price'];
                $order_details -> product_sales_quantity = $cart['product_qty'];
                $order_details -> save();
            }
        }
        Session::forget('cart');
    }
    public function AuthLogin() {
    $admin_id = Session::get('admin_id');
    if ($admin_id) {
        return Redirect::to('dashboard'); // Thêm dấu chấm phẩy ở đây
    } else {
        return Redirect::to('admin')->send(); 
    }
}
    public function view_order($id){
        $this->AuthLogin();

        $order_by_id = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')
            ->select('tbl_order.*', 'tbl_customers.*', 'tbl_shipping.*','tbl_order_details.*')
            ->first(); // Lấy dữ liệu từ cơ sở dữ liệu
        $manager_order_by_id = view('admin.view_order')->with('order_by_id', $order_by_id);
        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
        
    }

    public function login_checkout(){
    $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();

    $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();

    $provider_product = DB::table('tbl_provider_product')->where('provider_status','0')->orderby('provider_id', 'desc')->get(); 
        return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function add_customer(Request $request) {
    // Kiểm tra dữ liệu đầu vào
    $validatedData = $request->validate([
        'customer_name' => 'required',
        'customer_email' => 'required|email|unique:tbl_customers,customer_email',
        'customer_password' => 'required',
        'customer_phone' => 'required',
    ], [
        'customer_name.required' => 'Vui lòng nhập họ và tên.',
        'customer_email.required' => 'Vui lòng nhập email.',
        'customer_email.email' => 'Địa chỉ email không hợp lệ.',
        'customer_email.unique' => 'Email đã tồn tại.',
        'customer_password.required' => 'Vui lòng nhập mật khẩu.',
        'customer_phone.required' => 'Vui lòng nhập số điện thoại.',
    ]);

    // Lưu thông tin khách hàng
    $data = [
        'customer_name' => $request->customer_name,
        'customer_phone' => $request->customer_phone,
        'customer_email' => $request->customer_email,
        'customer_password' => md5($request->customer_password),
    ];

    try {
        $customer_id = DB::table('tbl_customers')->insertGetId($data);

        // Lưu vào session
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);

        // Trả về thông báo thành công
        return redirect('/checkout')->with('success', 'Đăng ký thành công!');
    } catch (\Exception $e) {
        // Trả về thông báo lỗi
        return redirect()->back()->with('error', 'Đăng ký thất bại. Vui lòng thử lại.');
    }
}


    public function checkout(){
    $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();

    $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

    $provider_product = DB::table('tbl_provider_product')->where('provider_status', '0')->orderby('provider_id', 'desc')->get();

    $payment_methods = DB::table('tbl_payment')->where('payment_status', '0')->get(); // Lấy danh sách phương thức thanh toán

    return view('pages.checkout.show_checkout')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('payment_methods', $payment_methods); 
}

    public function save_checkout_customer(Request $request)
    {
    $data = array();
    $data['shipping_name'] = $request->shipping_name;
    $data['shipping_phone'] = $request->shipping_phone;
    $data['shipping_email'] = $request->shipping_email;
    $data['shipping_notes'] = $request->shipping_notes;
    $data['shipping_address'] = $request->shipping_address;


    // Lưu thông tin khách hàng và lấy ID của khách hàng vừa được thêm
    $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

    // Lưu ID và tên khách hàng vào Session
    Session::put('shipping_id', $shipping_id);

    // Chuyển hướng đến trang checkout
    return Redirect::to('/payment');
    }


    public function payment(){
    $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();

    $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();

    $provider_product = DB::table('tbl_provider_product')->where('provider_status','0')->orderby('provider_id', 'desc')->get(); 
    return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);
    }


    public function order_place(Request $request){
    //insert payment method
    $data = array();
    $data['payment_method'] = $request->payment_option;
    $data['payment_status'] = 'Đang chờ xử lý';
    $payment_id = DB::table('tbl_payment')->insertGetId($data);

    //insert order
    $order_data = array();
    $order_data['customer_id'] = Session::get('customer_id');
    $order_data['shipping_id'] = Session::get('shipping_id');
    $order_data['payment_id'] = $payment_id;
    $order_data['order_total'] = Cart::getTotal();
    $order_data['order_status'] = 'Đang chờ xử lý';
    $order_id = DB::table('tbl_order')->insertGetId($order_data);

    //insert order details
    $content = Cart::getContent();
    foreach ($content as $v_content) {
        $order_d_data = array();
        $order_d_data['order_id'] = $order_id;
        $order_d_data['product_id'] = $v_content->id;
        $order_d_data['product_name'] = $v_content->name;
        $order_d_data['product_price'] = $v_content->price;
        $order_d_data['product_sales_quantity'] = $v_content->quantity;
        DB::table('tbl_order_details')->insert($order_d_data);
    }
    if ($data['payment_method'] == 1) {
        echo 'Chuyển khoản';
    } elseif ($data['payment_method'] == 2) {
        Cart::remove($order_d_data);
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product);
    } else {
        echo 'ZaloPay';
    }

    

    //Chuyển hướng đến trang checkout
   //return Redirect::to('/payment');
    }


    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')
        ->where('customer_email', $email)
        ->where('customer_password', $password)
        ->first();

        if($result){
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/checkout');
        }else{
            return Redirect::to('/login-checkout')->with('login_error', 'Sai tài khoản hoặc mật khẩu. Vui lòng thử lại.');
        }
    }
    public function manage_order() {
    $this->AuthLogin();

    $all_order = DB::table('tbl_order')
        ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
        ->select('tbl_order.*', 'tbl_customers.customer_name')
        ->orderby('tbl_order.order_id', 'desc') // Đã loại bỏ khoảng trắng thừa
        ->get(); // Lấy dữ liệu từ cơ sở dữ liệu

    $manager_order = view('admin.manage_order')->with('all_order', $all_order);

    return view('admin_layout')->with('content', $manager_order);
}

}
