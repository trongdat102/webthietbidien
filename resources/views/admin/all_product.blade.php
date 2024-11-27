@extends('admin_layout')
@section('admin_content')       
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
       Liệt kê sản phẩm
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
            <th>Tên thiết bị điện</th>
            <th>Số lượng</th>
            <th>Giá thiết bị điện</th>
            <th>Hình ảnh thiết bị điện</th>
            <!--<th>Mô tả bị điện</th>
            <th>Thông số kỹ thuật</th>-->
            <th>Loại thiết bị điện</th>
            <th>Hãng thiết bị điện</th>
            <th>Nhà cung cấp thiết bị điện</th>
            <th>Hiển thị</th>            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_product as $key => $pro)
          <tr>
            <td>{{ $pro->product_name}}</td>
            <td>{{ $pro->product_quantity}}</td>
            <td>{{ $pro->product_price}}</td>
            <td><img src="public/uploads/product/{{ $pro->product_image}}" height="150" width="100"></td>
            <td>{{ $pro->category_name}}</td>
            <td>{{ $pro->brand_name}}</td>
            <td>{{ $pro->provider_name}}</td>

            <td><span class="text-ellipsis">
              @if($pro->product_status == 0)
                  <a href="{{ URL::to('/unactive-product/' . $pro->product_id) }}">
                      <span class="fa-thumbs-styling fa fa-thumbs-up"></span>
                  </a>
              @else
                  <a href="{{ URL::to('/active-product/' . $pro->product_id) }}">
                      <span class="fa-thumbs-styling fa fa-thumbs-down"></span>
                  </a>
              @endif
             </span></td>

            <td>
              <a href="{{URL::to('/edit-product/' . $pro->product_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
               <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')" href="{{URL::to('/delete-product/' . $pro->product_id)}}" class="active" ui-toggle-class=""> 
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