@extends('admin_layout')

@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Chi tiết kho: {{ $warehouse->warehouse_name }}
                </header>
                <div class="panel-body">
                    <?php
                    $message = Session::get('message');
                    if($message){
                        echo '<span style="color: orangered; font-weight: bold; padding: 10px; border-radius: 5px; width: 100%; ">', $message, '</span>';
                        Session::put('message', null);
                    }
                    ?>
                    <!-- Nút in hóa đơn -->
                    <form action="#" method="GET" class="form-inline mb-3">
                        <label for="date" class="mr-2">Chọn ngày:</label>
                        <input type="date" name="date" id="date" class="form-control mr-2" required>
                        <button type="submit" class="btn btn-primary">In hóa đơn</button>
                    </form>



                    <!-- Bảng chi tiết kho -->
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Tên kho</th>
                            <th>Số lượng</th>
                            <th>Giá nhập</th>
                            <th>Ngày nhập</th>
                            <th style="width:30px;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($warehouseDetails as $detail)
                            <tr>
                                <td>{{ $detail->product->product_name }}</td>
                                <td>{{ $detail->warehouse->warehouse_name }}</td>
                                <td>{{ $detail->warehouse_details_quantity }}</td>
                                <td>{{ number_format($detail->warehouse_details_price, 0, ',', '.') }} VND</td>
                                <td>{{ $detail->warehouse_details_date }}</td>
                                <td>
                                    <!-- Nút Chỉnh sửa -->
                                    <a href="{{ route('warehouse.detail.edit', $detail->warehouse_details_id) }}" class="active" ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>

                                    <!-- Nút Xóa -->
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')"
                                       href="{{ route('warehouse.detail.delete', $detail->warehouse_details_id) }}"
                                       class="active" ui-toggle-class="">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a>
                                </td>



                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection
