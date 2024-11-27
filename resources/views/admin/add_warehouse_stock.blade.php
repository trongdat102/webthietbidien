@extends('admin_layout')

@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Nhập hàng vào kho
                </header>
                <div class="panel-body">
                    <?php
                    $message = Session::get('message');
                    if($message){
                        echo '<span style="color: orangered; font-weight: bold; padding: 10px; border-radius: 5px; width: 100%; ">', $message, '</span>';
                        Session::put('message', null);
                    }
                    ?>
                    <div class="position-center">
                        <form role="form" action="{{ route('store.warehouse.stock') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="warehouse_id">Chọn kho</label>
                                <select class="form-control" name="warehouse_id" required>
                                    <option value="">Chọn kho</option>
                                    @foreach($warehouses as $warehouse)
                                        <option value="{{ $warehouse->warehouse_id }}">{{ $warehouse->warehouse_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="product_id">Tên thiết bị</label>
                                <select class="form-control" name="product_id" required>
                                    <option value="">Chọn thiết bị</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="warehouse_details_quantity">Số lượng</label>
                                <input type="text" class="form-control" name="warehouse_details_quantity" min="1" required>
                            </div>

                            <div class="form-group">
                                <label for="warehouse_details_price">Giá nhập</label>
                                <input type="text" class="form-control" name="warehouse_details_price" min="0" step="0.01" required>
                            </div>

                            <button type="submit" name="add_warehouse_stock" class="btn btn-info">Thêm hàng</button>
                        </form>
                    </div>

                </div>
            </section>
        </div>
    </div>

@endsection
