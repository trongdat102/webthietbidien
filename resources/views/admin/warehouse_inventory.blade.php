@extends('admin_layout')

@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
               Danh sách hàng tồn kho
            </div>
            <div class="row w3-res-tb">

                <div class="col-sm-6 m-b-xs">
                    <form action="{{ route('export.excel.inventory') }}" method="POST">
                        @csrf

                        <input type="submit" value="Xuất báo cáo" class="btn btn-info">
                    </form>


                </div>

            </div>


            <div class="table-responsive">

                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng còn lại</th>
                        <th>Số lượng đã bán</th>
                        <th>Giá nhập</th>
                        <th>Giá bán</th>
                        <th>Tình trạng</th> <!-- Thêm cột Tình trạng -->
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{ $product->product_name }}</td>

                            <!-- Số lượng còn lại -->
                            <td>
                                @php
                                    $remainingQuantity = $product->product_quantity - $product->product_sold;
                                @endphp
                                {{ $remainingQuantity > 0 ? $remainingQuantity : 0 }}
                            </td>

                            <!-- Số lượng đã bán -->
                            <td>{{ $product->product_sold }}</td>

                            <!-- Hiển thị giá nhập -->
                            <td>
                                @if($product->warehouseDetails->isNotEmpty())
                                    {{ number_format($product->warehouseDetails->first()->warehouse_details_price, 0, ',', '.') }} VND
                                @else
                                    Chưa có thông tin
                                @endif
                            </td>

                            <!-- Hiển thị giá bán -->
                            <td>{{ number_format($product->product_price, 0, ',', '.') }} VND</td>

                            <!-- Hiển thị tình trạng -->
                            <td>
                                @if($remainingQuantity <= 0)
                                    <span style="color: red;">Đã hết hàng</span>
                                @elseif($remainingQuantity > 0 && $remainingQuantity <= 10)
                                    <span style="color: orange;">Sắp hết hàng</span>
                                @else
                                    <span style="color: green;">Còn hàng</span>
                                @endif
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
                            <li class="{{ $products->onFirstPage() ? 'disabled' : '' }}">
                                <a href="{{ $products->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
                            </li>
                            <!-- Các trang -->
                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                <li class="{{ $products->currentPage() == $i ? 'active' : '' }}">
                                    <a href="{{ $products->url($i) }}">{{ $i }}</a>
                                </li>

                            @endfor
                            <!-- Nút Next -->
                            <li class="{{ !$products->hasMorePages() ? 'disabled' : '' }}">
                                <a href="{{ $products->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </footer>

        </div>


    </div>

@endsection
