@extends('layout')
@section('content')       
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
       Lịch sử đơn hàng
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
                @else
                    <span class="text text-danger">Đơn hàng đã bị hủy</span>
                @endif
            </td>

            <td>
              @if( $ord->order_status == 2 ) 
                <a href="{{ URL::to('/order/received/' . $ord->order_code) }}" class="btn btn-success">Đã nhận hàng</a>
              @endif
              @if( $ord->order_status == 5 ) 
                <p><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#huydon">Trả hàng</button></p>
              @endif
              @if( $ord->order_status != 3 && $ord->order_status != 4 && $ord->order_status != 5 ) 
                <p><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#huydon">Hủy đơn hàng</button></p>
              @endif
                  <!-- Modal -->
                  <div id="huydon" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <form>
                        @csrf
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Lí do hủy</h4>
                        </div>
                        <div class="modal-body">
                          <p><textarea rows="5" class="lydohuydon" required placeholder="Lý do hủy đơn hàng..."></textarea></p>
                        </div>
                        <div class="modal-footer">
                          <button 
                          type="button" 
                          style="background-color: red; color: white; padding: 10px 20px; border: none; border-radius: 5px;" 
                          id="{{ $ord->order_code }}" 
                          onclick="Huydonhang('{{ $ord->order_code }}')">
                          Hủy đơn hàng
                      </button>

                          <button type="button" style="background-color: transparent; color: gray; padding: 10px 20px; border: 1px solid gray; border-radius: 5px; margin-left: 10px;" data-dismiss="modal">
                              Hủy
                          </button>

                        </div>
                      </div>
                      </form>
                    </div>
                  </div>
              <a href="{{URL::to('/view-history-order/' . $ord->order_code)}}" class="active" ui-toggle-class="">
                Xem đơn hàng</i></a>

               {{-- <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')" href="{{URL::to('/delete-order/' . $ord->order_code)}}" class="active" ui-toggle-class=""> 
                <i class="fa fa-times text-danger text"></i>
              </a>  --}} 
            </td>
          </tr>
          @endforeach
            
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection 