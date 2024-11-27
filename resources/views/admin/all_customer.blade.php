@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh sách tài khoản khách hàng
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <!-- export_brand.blade.php -->
                    <form action="{{ route('export.excel.customer') }}" method="POST">
                        @csrf
                        <input type="submit" value="Xuất báo cáo " class="btn btn-info">
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
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Họ và tên</th>
                        <th>Tài khoản</th>
                        <th>Mật khẩu</th>
                        <th>Số điện thoại</th>

                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_customer as $key => $cus_pro)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{ $cus_pro->customer_name}}</td>
                            <td>{{ $cus_pro->customer_email}}</td>
                            <td>{{ $cus_pro->customer_password}}</td>
                            <td>{{ $cus_pro->customer_phone}}</td>

                            <td>

                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa khách hàng này không?')" href="{{URL::to('/delete-customer/' . $cus_pro->customer_id)}}" class="active" ui-toggle-class="">
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
                            <li class="{{ $all_customer->onFirstPage() ? 'disabled' : '' }}">
                                <a href="{{ $all_customer->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
                            </li>
                            <!-- Các trang -->
                            @for ($i = 1; $i <= $all_customer->lastPage(); $i++)
                                <li class="{{ $all_customer->currentPage() == $i ? 'active' : '' }}">
                                    <a href="{{ $all_customer->url($i) }}">{{ $i }}</a>
                                </li>

                            @endfor
                            <!-- Nút Next -->
                            <li class="{{ !$all_customer->hasMorePages() ? 'disabled' : '' }}">
                                <a href="{{ $all_customer->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </footer>

        </div>
    </div>
@endsection
