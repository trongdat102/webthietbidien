@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a class="active">Thanh toán giỏ hàng</a></li>
				</ol>
			</div>
			{{-- <div class="register-req">
				<p>Đăng kí hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
			</div> --}}

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Điền thông tin vận chuyển</p>
							<div class="form-one">
							<form method="post">
									@csrf
								<input type="text" name="shipping_email" class="shipping_email" placeholder="Email*">
								<input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên*">
								<input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ*">
								<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại*">
								<textarea name="shipping_notes" class="shipping_notes"  placeholder="Ghi chú đơn hàng của bạn*" rows="5"></textarea>
								
								<div class="">
									<div class="form-group">
									    <label for="payment_select">Chọn hình thức thanh toán</label>
									    <select name="payment_select" class="form-control input-sm m-bot15 payment_select">
									        @foreach ($payment_methods as $payment)
									            <option value="{{ $payment->payment_id }}">{{ $payment->payment_method }}</option>
									        @endforeach
									    </select>
									</div>

							    </div>
							    <input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-small send_order">
							</form>
							</div>
						</div>
					</div>
					<div class="col-sm-12 clearfix">
						 @if(session()->has('message'))
				            <div class="alert alert-success"> 
				                {!! session()->get('message') !!}
				            </div>
				        @elseif(session()->has('error'))
				            <div class="alert alert-danger">
				                {!! session()->get('error') !!}
				            </div>
				        @endif
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
                        		{{-- <a class="btn btn-default check_out" href="">Thanh toán</a> --}}
                    			{{-- <a class="btn btn-default check_out" href="">Mã giảm giá</a> --}}
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
	</section> <!--/#cart_items-->
@endsection
