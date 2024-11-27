@extends('admin_layout')

@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh Sửa Chi Tiết Sản Phẩm: {{ $product->product_name }} (Kho: {{ $warehouse->warehouse_name }})
                </header>
                <div class="panel-body">
                    <form action="{{ route('warehouse.detail.update', $detail->warehouse_details_id) }}" method="POST">
                        @csrf
                        @method('POST')

                        <!-- Tên sản phẩm (không thể chỉnh sửa) -->
                        <div class="form-group">
                            <label for="product_name">Tên Sản Phẩm</label>
                            <input type="text" class="form-control" value="{{ $product->product_name }}" disabled>
                        </div>

                        <!-- Kho (không thể chỉnh sửa) -->
                        <div class="form-group">
                            <label for="warehouse_name">Kho</label>
                            <input type="text" class="form-control" value="{{ $warehouse->warehouse_name }}" disabled>
                        </div>

                        <!-- Số lượng -->
                        <div class="form-group">
                            <label for="warehouse_details_quantity">Số Lượng</label>
                            <input type="text" name="warehouse_details_quantity" class="form-control" value="{{ $detail->warehouse_details_quantity }}">
                        </div>

                        <!-- Giá nhập -->
                        <div class="form-group">
                            <label for="warehouse_details_price">Giá Nhập</label>
                            <input type="text" name="warehouse_details_price" class="form-control" value="{{ $detail->warehouse_details_price }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
