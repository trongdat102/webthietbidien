<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Product;
use PDF;
use DB;
use Session;
use App\Models\Statistic;

class OrderController extends Controller
{
    public function markAsReceived($order_code)
{
    $order = Order::where('order_code', $order_code)->first();
    if ($order) {
        $order->order_status = 5;
        $order->save();

        return redirect()->back()->with('message', 'Nhận hàng thành công.');
    }

    return redirect()->back()->with('message', 'Đơn hàng không tìm thấy.');
}


    public function huy_don_hang(Request $request) {
    $data = $request->all();
    $order = Order::where('order_code', $data['order_code'])->first();

    if ($order) {
        $order->order_destroy = $data['lydo'];
        $order->order_status = 3; // Đánh dấu đơn hàng là đã bị hủy
        $order->save();

        // Trừ số liệu trong bảng Statistic
        $order_date = $order->order_date;
        $statistic = Statistic::where('order_date', $order_date)->first();

        if ($statistic) {
            $total_order = 1; 
            $quantity = 0;
            $sales = 0;

            // Lấy chi tiết đơn hàng để cập nhật số lượng và doanh thu
            $order_details = OrderDetails::where('order_code', $data['order_code'])->get();
            foreach ($order_details as $detail) {
                $product = Product::find($detail->product_id);

                if ($product) {
                    $qty = $detail->product_sales_quantity;
                    $product->product_quantity += $qty; // Cộng lại số lượng sản phẩm vào kho
                    $product->product_sold -= $qty;     // Trừ số lượng đã bán
                    $product->save();

                    $quantity += $qty;
                    $sales += $detail->product_price * $qty;
                }
            }

            // Trừ dữ liệu trong bảng Statistic
            $statistic->sales -= $sales;
            $statistic->quantity -= $quantity;
            $statistic->total_order -= $total_order;
            $statistic->save();
        }
    }
}

    public function order_code(Request $request, $order_code){
        
        $order = Order::where('order_code', $order_code)->first();
        $order -> delete();
        Session::put('message', 'Xóa đơn hàng thành công');
        return Redirect() -> back();
    }
    public function update_qty(Request $request){
        $data = $request -> all();
        $order_details = OrderDetails::where('product_id', $data['order_product_id'])->where('order_code', $data['order_code'])->first();
        $order_details -> product_sales_quantity = $data['order_qty'];
        $order_details -> save();
    }
    

public function update_order_qty(Request $request) {
    $data = $request->all();

    if (!isset($data['order_id'])) {
        return response()->json(['error' => 'ID đơn hàng không tồn tại'], 400);
    }

    $order = Order::find($data['order_id']);
    if (!$order) {
        return response()->json(['error' => 'Không tìm thấy đơn hàng'], 404);
    }

    $order->order_status = $data['order_status'];
    $order->save();

    $order_date = $order->order_date;
    $statistic = Statistic::where('order_date', $order_date)->first();
    $statistic_count = $statistic ? 1 : 0;

    if (!isset($data['order_product_id']) || !isset($data['quantity'])) {
        return response()->json(['error' => 'Thông tin sản phẩm hoặc số lượng không tồn tại'], 400);
    }

    if (count($data['order_product_id']) !== count($data['quantity'])) {
        return response()->json(['error' => 'Số lượng sản phẩm và số lượng đặt hàng không khớp'], 400);
    }

    if ($order->order_status == 2) {
        $total_order = 1; // Đặt giá trị là 1 cho mỗi đơn hàng, không tính theo số lượng sản phẩm
        $sales = 0;
        $profit = 0;
        $quantity = 0;

        foreach ($data['order_product_id'] as $key => $product_id) {
            $product = Product::find($product_id);
            if ($product) {
                $qty = $data['quantity'][$key];
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                $product_price = $product->product_price;

                $product->product_quantity = $product_quantity - $qty;
                $product->product_sold = $product_sold + $qty;
                $product->save();

                $quantity += $qty;
                $sales += $product_price * $qty;
                // $profit += ($product_price * $qty) - 1000; // Chỉnh lại công thức tính lợi nhuận theo yêu cầu
            }
        }

        if ($statistic) {
            $statistic->sales += $sales;
            $statistic->profit += $profit;
            $statistic->quantity += $quantity;
            $statistic->total_order += $total_order;
            $statistic->save();
        } else {
            $statistic_new = new Statistic();
            $statistic_new->order_date = $order_date;
            $statistic_new->sales = $sales;
            $statistic_new->profit = $profit;
            $statistic_new->quantity = $quantity;
            $statistic_new->total_order = $total_order;
            $statistic_new->save();
        }
    }
}

    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf = \PDF::loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();

    }

    public function print_order_convert($checkout_code){
        $order_details = OrderDetails::where('order_code', $checkout_code)->get();
        $order = Order::where('order_code', $checkout_code) -> get();
        foreach($order as $key => $ord){
            $customer_id = $ord -> customer_id;
            $shipping_id = $ord -> shipping_id;
            
        }
            $customer = Customer::where('customer_id', $customer_id)->first();
            $shipping = Shipping::where('shipping_id', $shipping_id)->first();

            $order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();
            $output = '';

           $output = <<<HTML
    <html>
    <head>
        <style>
            body { font-family: DejaVu Sans, sans-serif; }
            .invoice-box {
                max-width: 800px;
                margin: auto;
                padding: 30px;
                border: 1px solid #eee;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                font-size: 16px;
                line-height: 24px;
                color: #555;
            }
            .title { text-align: center; font-size: 20px; font-weight: bold; }
            .table { width: 100%; margin-top: 20px; border-collapse: collapse; }
            .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            .table th { background-color: #f2f2f2; }
        </style>
    </head>
    <body>
        <div class='invoice-box'>
            <div class='title'>Hóa Đơn Bán Hàng</div>
            <p>Mã đơn hàng: <strong>{$checkout_code}</strong></p>
            <p>Ngày: <strong>" . date('d/m/Y') . "</strong></p>
            <hr>
            <p><strong>Thông tin khách hàng</strong></p>
            <p>Họ tên: {$customer->customer_name}</p>
            <p>Số điện thoại: {$customer->customer_phone}</p>
            <p>Email: {$customer->customer_email}</p>
            <hr>
            <p><strong>Thông tin vận chuyển</strong></p>
            <p>Tên người nhận: {$shipping->shipping_name}</p>
            <p>Địa chỉ: {$shipping->shipping_address}</p>
            <p>Số điện thoại: {$shipping->shipping_phone}</p>
            <p>Email: {$shipping->shipping_email}</p>
            <p>Ghi chú đơn hàng: {$shipping->shipping_notes}</p>
            <hr>
            <p><strong>Chi tiết đơn hàng</strong></p>
            <table class='table'>
                <thead>
                    
                    <tr>
                        <th>Sản phẩm</th>
                        <th>SL</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                
                </thead>
                <tbody>
HTML;

    // Khởi tạo tổng tiền
    $total = 0;

    // Lặp qua từng sản phẩm trong đơn hàng
    foreach ($order_details_product as $product) {
        $product -> product_name;
        $product -> product_sales_quantity;
        $product -> product_price;
        $subtotal = $product -> product_sales_quantity * $product -> product_price;
        $total += $subtotal; // Cộng dồn vào tổng tiền

        // Thêm hàng sản phẩm vào bảng
        $output .= "<tr>
                        <td>{$product->product_name}</td>
                        <td>{$product->product_sales_quantity}</td>
                        <td>" . number_format($product->product_price, 0, ',', '.') . " đ</td>
                        <td>" . number_format($subtotal, 0, ',', '.') . " đ</td>
                    </tr>";
    }

        $output .= "
                </tbody>
            </table>
            <hr>
            <p><strong>Tổng cộng:</strong> " . number_format($total, 0, ',', '.') . " đ</p>
            </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th width='200px'>Nhân viên bán hàng</th>
                <th width='800px'>Người nhận</th>
            </tr>
        </thead>
        <tbody>";
        $output .="
            </tbody>
        </table>
        </div>
    </body>
    </html>
    ";
    return $output;

}

    public function view_order($order_code){
        $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code) -> get();
        foreach($order as $key => $ord){
            $customer_id = $ord -> customer_id;
            $shipping_id = $ord -> shipping_id;
            $order_status = $ord -> order_status;
            
        }
            $customer = Customer::where('customer_id', $customer_id)->first();
            $shipping = Shipping::where('shipping_id', $shipping_id)->first();

            $order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();
        return view('admin.view_order')->with(compact('order_details','customer','shipping','order_details','order','order_status'));
    }
    public function manage_order(){
        $order = Order::orderby('created_at', 'DESC') -> get();
        return view('admin.manage_order')->with(compact('order'));
    }

    public function history(){
        if(!Session::get('customer_id')){
            return Redirect('login-checkout')->with('error','Vui lòng đăng nhập để xem lịch sử mua hàng');

        }else{

            
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();

            $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();

            $provider_product = DB::table('tbl_provider_product')->where('provider_status','0')->orderby('provider_id', 'desc')->get(); 
            $order = Order::where('customer_id', Session::get('customer_id'))->orderby('order_id', 'DESC') -> get();
            return view('pages.history.history')->with('category',$cate_product)->with('brand',$brand_product)->with('order', $order);
        }
    }

    public function view_history_order(Request $request, $order_code){
        if(!Session::get('customer_id')){
            return Redirect('login-checkout')->with('error','Vui lòng đăng nhập để xem lịch sử mua hàng');

        }else{

            
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();

            $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();

            $provider_product = DB::table('tbl_provider_product')->where('provider_status','0')->orderby('provider_id', 'desc')->get(); 
            //xem lịch sử mua hàng 
            $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
            $order = Order::where('order_code', $order_code) -> first();

            $customer_id = $order -> customer_id;
            $shipping_id = $order -> shipping_id;
            $order_status = $order -> order_status;
            
        
            $customer = Customer::where('customer_id', $customer_id)->first();
            $shipping = Shipping::where('shipping_id', $shipping_id)->first();

            $order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();
            
            return view('pages.history.view_history_order')
            ->with('category',$cate_product)
            ->with('brand',$brand_product)
            ->with('order_details',$order_details)
            ->with('customer',$customer)
            ->with('shipping',$shipping)
            ->with('order',$order)
            ->with('order_status',$order_status)
            ;
        }
    }
}
