@extends('admin_layout')
@section('admin_content')       
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
       Danh sách phương thức thanh toán
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
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên phương thức thanh toán</th>
            <th>Hiển thị</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_payment as $key => $payment_pay)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $payment_pay->payment_method}}</td>
            <td><span class="text-ellipsis">
              @if($payment_pay->payment_status == 0)
                  <a href="{{ URL::to('/unactive-payment/' . $payment_pay->payment_id) }}">
                      <span class="fa-thumbs-styling fa fa-thumbs-up"></span>
                  </a>
              @else
                  <a href="{{ URL::to('/active-payment/' . $payment_pay->payment_id) }}">
                      <span class="fa-thumbs-styling fa fa-thumbs-down"></span>
                  </a>
              @endif
             </span></td>

            <td>
              <a href="{{URL::to('/edit-payment/' . $payment_pay->payment_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
               <a onclick="return confirm('Bạn có chắc chắn muốn xóa phương thức thanh toán này không?')" href="{{URL::to('/delete-payment/' . $payment_pay->payment_id)}}" class="active" ui-toggle-class=""> 
                <i class="fa fa-times text-danger text"></i>
              </a>  
            </td>
          </tr>
          @endforeach
            
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection