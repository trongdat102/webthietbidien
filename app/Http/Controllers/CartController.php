<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function gio_hang (){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();
        
        return view('pages.cart.cart_ajax')
        ->with('category',$cate_product)
        ->with('brand',$brand_product);
    }
    
    public function add_cart_ajax(Request $request) {
        //Session::forget('cart');
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0,26),5);

        // Lấy giỏ hàng từ session
        $cart = Session::get('cart', []);

        // Kiểm tra xem sản phẩm có trong giỏ hàng hay chưa
        $is_avalable = false;
        foreach($cart as $key => $val) {
            if($val['product_id'] == $data['cart_product_id']) {
                $is_avalable = true;
                break;
            }
        }

        // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới vào giỏ hàng
        if (!$is_avalable) {
            $cart[] = [
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            ];

            // Cập nhật lại giỏ hàng trong session
            Session::put('cart', $cart);
        }

        Session::save();
    }
    public function del_product($session_id){
        $cart = Session::get('cart');
        if($cart == true){
            foreach($cart as $key => $val){
                if($val['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return Redirect()->back()->with('message','Xóa sản phẩm thành công');
        }
        else{
            return Redirect()->back()->with('message','Xóa sản phẩm thát bại');
        }
    }
    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart == true){
            foreach($data['cart_qty'] as $key => $qty){
                foreach ($cart as $session => $val) {
                    if($val['session_id']==$key){
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart', $cart);
            return Redirect()->back()->with('message','Cập nhật số lượng thành công');
        }else{
            return Redirect()->back()->with('message','Cập nhật số lượng thát bại');
        }
    }
    public function del_all_product()
{
    $cart = Session::get('cart');
    if ($cart) {
        Session::forget('cart');
        return redirect()->back()->with('message', 'Xóa giỏ hàng thành công');
    } else {
        return redirect()->back()->with('message', 'Giỏ hàng hiện đang trống');
    }
}

    public function save_cart(Request $request){
        $productId = $request -> productid_hidden;
        $quantity = $request -> qty;
        $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();

       if ($product_info) {
        // Cart::add(455, 'Sample Item', 100.99, 2, array());
        // Cart::remove('293ad'); // Xóa sản phẩm theo ID
        $data['id'] = $product_info->product_id;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['quantity'] = $quantity;
        $data['attributes'] ['image'] = $product_info->product_image;
        $data['conditions'] = '123';
        Cart::add($data);

    }
        return Redirect::to('/show-cart');

    }
    public function show_cart(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();
        
        return view('pages.cart.show_cart')
        ->with('category',$cate_product)
        ->with('brand',$brand_product);
    }
    public function delete_to_cart ($id){
        Cart::remove($id);
        return Redirect::to('/show-cart');

    }
    public function update_cart_quantity(Request $request){
        $id = $request -> id_cart;
        $quantity = $request -> cart_quantity;
        Cart::update($id, array('quantity' => array('relative' => false,'value' => $quantity),));
        return Redirect::to('/show-cart');
    }
}
