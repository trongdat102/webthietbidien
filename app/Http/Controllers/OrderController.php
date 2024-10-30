<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Product;
use PDF;
class OrderController extends Controller
{
    public function update_order_qty(Request $request){
        //Update order
        $data = $request -> all();
        $order = Order::find($data['order_id']);
        $order -> order_status = $data['order_status'];
        $order -> save();
        if($order -> order_status == 2){
            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $product_quantity = $product -> product_quantity;
                $product_sold = $product -> product_sold;

                foreach ($data['quantity'] as $key2 => $qty){
                    if($key == $key2){
                        $pro_remain = $product_quantity - $qty;
                        $product -> product_quantity = $pro_remain;
                        $product -> product_sold = $product_sold + $qty;
                        $product -> save();
                    }
                }
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
            
        }
            $customer = Customer::where('customer_id', $customer_id)->first();
            $shipping = Shipping::where('shipping_id', $shipping_id)->first();

            $order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();
        return view('admin.view_order')->with(compact('order_details','customer','shipping','order_details','order'));
    }
    public function manage_order(){
        $order = Order::orderby('created_at', 'DESC') -> get();
        return view('admin.manage_order')->with(compact('order'));
    }
}
