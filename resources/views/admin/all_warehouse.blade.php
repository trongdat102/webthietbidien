@extends('admin_layout')

@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh sách kho
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
                        <th>Tên kho</th>
                        <th>Địa chỉ</th>
                        <th>Trạng thái</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_warehouse  as $warehouse)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>
                                <!-- Link đến trang chi tiết kho -->
                                <a href="{{ URL::to('/warehouse-inventory/')}}">>
                                    {{ $warehouse->warehouse_name }}
                                </a>
                            </td>
                            <td>{{ $warehouse->warehouse_address }}</td>

                            <td><span class="text-ellipsis">
                                 @if($warehouse->warehouse_status == 0)
                                        <a href="{{ URL::to('/unactive-warehouse/' . $warehouse->warehouse_id) }}">
                                             <span class="fa-thumbs-styling fa fa-thumbs-up"></span>
                                             </a>
                                    @else
                                        <a href="{{ URL::to('/active-warehouse/' . $warehouse->warehouse_id) }}">
                      <span class="fa-thumbs-styling fa fa-thumbs-down"></span>
                  </a>
                                    @endif
             </span></td>

                            <td>
                                <a href="{{URL::to('/edit-warehouse/' . $warehouse->warehouse_id)}}" class="active"
                                   ui-toggle-class="">
                                    <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa kho này không?')"
                                   href="{{URL::to('/delete-warehouse/' . $warehouse->warehouse_id)}}"
                                   class="active" ui-toggle-class="">
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
                        <small class="text-muted inline m-t-sm m-b-sm">Hiển thị tối đa 10 sản phẩm</small>
                    </div>
                    <div class="pagination-wrapper text-center">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            <!-- Nút Previous -->
                            <li class="{{ $all_warehouse->onFirstPage() ? 'disabled' : '' }}">
                                <a href="{{ $all_warehouse->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
                            </li>
                            <!-- Các trang -->
                            @for ($i = 1; $i <= $all_warehouse->lastPage(); $i++)
                                <li class="{{ $all_warehouse->currentPage() == $i ? 'active' : '' }}">
                                    <a href="{{ $all_warehouse->url($i) }}">{{ $i }}</a>
                                </li>

                            @endfor
                            <!-- Nút Next -->
                            <li class="{{ !$all_warehouse->hasMorePages() ? 'disabled' : '' }}">
                                <a href="{{ $all_warehouse->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </footer>

        </div>
    </div>



@endsection
