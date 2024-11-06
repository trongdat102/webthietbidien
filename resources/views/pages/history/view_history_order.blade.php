@extends('layout')
@section('content')       
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
       Chi tiết đơn hàng
    </div>
    <div class="table-responsive">
                        <?php
    $message = Session::get('message');
    if($message){
        echo '<span style="color: orangered; font-weight: bold; padding: 10px; border-radius: 5px; width: 100%; ">', $message, '</span>';
        Session::put('message', null);
    }
?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>
          </tr>  
        </tbody>
      </table>
    </div>
  </div>
</div>
<br> <br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
       Thông tin chi tiết đơn hàng
    </div>
    <div class="table-responsive">
                        <?php
    $message = Session::get('message');
    if($message){
        echo '<span style="color: orangered; font-weight: bold; padding: 10px; border-radius: 5px; width: 100%; ">', $message, '</span>';
        Session::put('message', null);
    }
?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người nhận</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Ghi chú</th>
            <th>Hình thức thanh toán</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>{{$shipping->shipping_email}}</td>
            <td>{{$shipping->shipping_notes}}</td>
            <td>@if( $shipping->shipping_method == 0 ) Chuyển khoản 
              @else Tiền mặt
            @endif</td>
          </tr>  
        </tbody>
      </table>
    </div>
  </div>
</div>
<br> <br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
       Chi tiết sản phẩm
    </div>

    <div class="table-responsive">
                        <?php
    $message = Session::get('message');
    if($message){
        echo '<span style="color: orangered; font-weight: bold; padding: 10px; border-radius: 5px; width: 100%; ">', $message, '</span>';
        Session::put('message', null);
    }
?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">Thứ tự</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Tổng tiền</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
          $i = 0;
          $total = 0;
          @endphp
         @foreach($order_details as $key => $details)
         @php
          $i++;
          $subtotal = $details->product_price*$details->product_sales_quantity;
          $total += $subtotal;
          @endphp
          <tr class="color_qty_{{$details->product_id}}">

            <td><i>{{$i}}</i></td>
            <td>{{$details->product_name}}</td>
            
            <td>
              <input type="number" readonly {{$order_status == 2 ? 'disabled' : ''}} class="order_qty_{{$details->product_id}}" min="1" value="{{$details->product_sales_quantity}}" name="product_sales_quantity">
              <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">
              <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">
              <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">


            </td>
            <td>{{number_format($details->product_price , 0, ',', '.')}}₫</td>
            <td>{{number_format($subtotal , 0, ',', '.')}}₫</td>
          </tr>
         @endforeach
            <tr>
              <td>Thanh toán: {{number_format($total , 0, ',', '.')}}₫</td>
            </tr>
        </tbody>
      </table>
      <a target="blank" href="{{url('/print-order/'.$details->order_code)}}">In đơn hàng </a>
    </div>
  </div>
</div>
@endsection