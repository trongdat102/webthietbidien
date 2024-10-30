@extends('admin_layout')
@section('admin_content')       
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
       Thông tin khách hàng
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
       Thông tin vận chuyển
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
            <th>Tên người vận chuyển</th>
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
       Liệt kê chi tiết đơn hàng
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
            <th>Số lượng kho còn</th>
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
          <tr>

            <td><i>{{$i}}</i></td>
            <td>{{$details->product_name}}</td>
            <td>{{$details->product->product_quantity}}</td>
            <td>
              <input type="number" min="1" value="{{$details->product_sales_quantity}}" name="product_sales_quantity">
              <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">
              <button class="btn btn-default" name="update_quantity">Cập nhật</button>
            </td>
            <td>{{number_format($details->product_price , 0, ',', '.')}}₫</td>
            <td>{{number_format($subtotal , 0, ',', '.')}}₫</td>
          </tr>
         @endforeach
            <tr>
              <td>Thanh toán: {{number_format($total , 0, ',', '.')}}₫</td>
            </tr>
            <tr>
              <td colspan="6">
                @foreach($order as $key => $or)
                @if($or->order_status == 1)
                <form>
                  @csrf
                    <select class="form-control order_details">
                      <option value="">-------Chọn tình trạng-------</option>
                      <option id="{{$or->order_id}}" selected value="1">Chưa xử lý </option>
                      <option id="{{$or->order_id}}" value="2">Đã xử lý - Đã giao hàng </option>
                      <option id="{{$or->order_id}}" value="3">Hủy đơn hàng - Đang chờ </option>
                    </select>
                </form>
                @elseif($or->order_status == 2)
                <form>
                  @csrf
                    <select class="form-control order_details">
                      <option value="">-------Chọn tình trạng-------</option>
                      <option id="{{$or->order_id}}" value="1">Chưa xử lý </option>
                      <option id="{{$or->order_id}}" selected value="2">Đã xử lý - Đã giao hàng </option>
                      <option id="{{$or->order_id}}" value="3">Hủy đơn hàng - Đang chờ </option>
                    </select>
                </form>
                @else
                <form>
                  @csrf
                    <select class="form-control order_details">
                      <option value="">-------Chọn tình trạng-------</option>
                      <option id="{{$or->order_id}}" value="1">Chưa xử lý </option>
                      <option id="{{$or->order_id}}" selected value="2">Đã xử lý - Đã giao hàng </option>
                      <option id="{{$or->order_id}}" selected value="3">Hủy đơn hàng - Đang chờ </option>
                    </select>
                </form>
                @endif
                @endforeach
              </td>
            </tr>
        </tbody>
      </table>
      <a target="blank" href="{{url('/print-order/'.$details->order_code)}}">In đơn hàng </a>
    </div>
  </div>
</div>
@endsection