@extends('admin_layout')
@section('admin_content')       
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
       Liệt kê đơn hàng
    </div>
    <div class="row w3-res-tb">
        <div class="col-sm-6 m-b-xs">
            <form action="{{ route('export.excel.orders') }}" method="POST">
                @csrf
                <label for="start_date">Từ ngày:</label>
                <input type="date" name="start_date" required>

                <label for="end_date">Đến ngày:</label>
                <input type="date" name="end_date" required>

                <input type="submit" value="Xuất báo cáo" class="btn btn-info">
            </form>


        </div>
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
            <th>Thứ tự</th>
            <th>Mã đơn hàng</th>
            <th>Ngày đặt hàng</th>
            <th>Tình trạng đơn hàng</th>
            <th>Lý do hủy đơn/Trả hàng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
          $i = 0;
          @endphp
          @foreach($order as $key => $ord)
          @php
          $i++;
          @endphp
          <tr>
            <td><i>{{$i}}</i></label></td>
            <td>{{ $ord->order_code }}</td>
            <td>{{ $ord->created_at }}</td>
            <td>@if( $ord->order_status == 1 )
                    <span class="text text-success">Đơn hàng mới</span>
                @elseif( $ord->order_status == 4 )
                    <span class="text text-primary">Đang giao hàng</span>
                @elseif( $ord->order_status == 2 )
                    <span class="text text-primary">Đã giao hàng</span>  
                @elseif( $ord->order_status == 5 )
                    <span class="text text-primary">Giao hàng thành công</span>   
                @elseif( $ord->order_status == 6 )
                    <span class="text text-danger">Đơn hàng bị trả lại</span>
                @else
                    <span class="text text-danger">Đơn hàng đã bị hủy</span>
                @endif

            </td>
            <td>
              @if($ord->order_status == 3 || $ord->order_status == 6)
              {{ $ord->order_destroy }}
              @endif
            </td>
            <td>
              <a href="{{URL::to('/view-order/' . $ord->order_code)}}" class="active" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i></a>

               <a onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?')" href="{{URL::to('/delete-order/' . $ord->order_code)}}" class="active" ui-toggle-class=""> 
                <i class="fa fa-times text-danger text"></i>
              </a>  
            </td>
          </tr>
          @endforeach
            
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection