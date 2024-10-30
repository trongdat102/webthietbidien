@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>

			<div class="review-payment">
				<h2>Xem lại giỏ hàng và thanh toán</h2>
			</div>
			<div class="table-responsive cart_info">
				<?php
			    $content = Cart::getContent();
				?>


				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Mô tả</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{ asset('public/uploads/product/' . $v_content->attributes->image) }}" alt="" style="width: 50px; height: 50px;"></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).' '.'đ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('update-cart-quantity')}}" method="post">
										@csrf
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->quantity}}">
									<input type="hidden" value="{{$v_content->id}}" name="id_cart" class="form-control">
									<input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-small">
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									<?php
									$subtotal = $v_content-> price * $v_content->quantity;
									echo number_format($subtotal). ' '.'đ';
									?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->id)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<h4 style="margin: 40px 0; font-size: 20px;">Chọn hình thức thanh toán</h4>
			<form method="post" action="{{URL::to('/order-place')}}">
				@csrf
			<div class="payment-options">
					<span>
						<label><input name="payment_option" value="1" type="checkbox"> Chuyển khoản ngân hàng</label>
					</span>
					<span>
						<label><input name="payment_option" value="2" type="checkbox"> Tiền mặt</label>
					</span>
					<span>
						<label><input name="payment_option" value="3" type="checkbox"> ZaloPay</label>
					</span> 
					<input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-small">
				</div>
			</form>
		</div>
	</section> <!--/#cart_items-->
@endsection
