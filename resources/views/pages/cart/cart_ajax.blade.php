@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                <li class="active">Giỏ hàng</li>
            </ol>
        </div>
        @if(session()->has('message'))
        		<div class="alert alert-success"> 
        				{{ session() -> get('message') }}
        		</div>
        	@elseif(session()->has('error'))
        		<div>
        				{{ session() -> get('error') }}
        		</div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive cart_info">
                <form action="{{URL('/update-cart')}}" method="post">
                	@csrf
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Hình ảnh</td>
                                <td class="description">Tên sản phẩm</td>
                                <td class="price">Giá</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Thành tiền</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                        	@if(Session::get('cart') == true)
                        	@php
                            	$total = 0;
                            @endphp
                            @foreach(Session::get('cart') as $key => $cart)
                            @php
                            	$subtotal = $cart['product_price'] * $cart['product_qty'];
                            	$total+=$subtotal;
                            @endphp
                            <tr>
                                <td class="cart_product">
                                    <img src="{{ asset('public/uploads/product/' . $cart['product_image']) }}"  width= "70px" alt="{{ $cart['product_name'] }}">
                                </td>
                                <td class="cart_description">
                                    <h4 style="font-size: 10px;"><a href="">{{ $cart['product_name'] }}</a></h4>
                                </td>
                                <td class="cart_price">
                                    <p>{{ number_format($cart['product_price'], 0, ',', '.') }}₫</p>
                                </td>
                                <td class="cart_quantity">
                                	<div class="cart_quantity_button">
                                        <input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{ $cart['product_qty'] }}" style="width: 50px; height: 30px;">
                                        
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        {{ number_format($subtotal, 0, ',', '.') }}₫
                                    </p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="{{url('/del-product/' . $cart['session_id'])}}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>                 
                            @endforeach
                            <tr>
                            <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="check_out btn-small"></td>
                            <td><a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa giỏ hàng</a>
                            </td>
                            <td>
                                @if(Session::get('customer_id'))
                        		<a class="btn btn-default check_out" href="{{url('/checkout')}}">Thanh toán</a>
                                @else
                    			<a class="btn btn-default check_out" href="{{url('/login-checkout')}}">Thanh toán</a>
                                @endif
                            </td>

                            	<td colspan="2"><li>Tổng:<span>{{ number_format($total, 0, ',', '.') }}₫</span></li>
                        			<li>Phí vận chuyển: <span>Free</span></li>
                        			<li>Thành tiền: <span></span></li> 
                    			</td>
                            </tr>
                            @else
                            <tr><td colspan="5"> <center>
                            	@php
                            	echo 'Giỏ hàng trống';
                            	@endphp
                            	</center></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    
                 </form>
                </div>
            </div>
        </div>
    </div>
<!-- </section>
<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        
                    </ul>                    
                   
                    
                </div>
            </div>
        </div>
    </div>
</section> -->
@endsection
