
@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Kho
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
                        <form role="form" action="{{URL::to('/save-warehouse')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="warehouse_name">Tên Kho</label>
                                <input type="text" name="warehouse_name" class="form-control" id="warehouse_name" placeholder="Tên kho">
                                <!-- Hiển thị lỗi -->
                                @error('warehouse_name')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="warehouse_address">Địa chỉ Kho</label>
                                <textarea id="warehouse_address" style="resize: none; text-align: left;" rows="5" class="form-control" name="warehouse_address" placeholder="Địa chỉ kho"></textarea>
                                <!-- Hiển thị lỗi -->
                                @error('warehouse_address')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="warehouse_status">Trạng thái Hiển thị</label>
                                <select name="warehouse_status" class="form-control input-sm m-bot15">
                                    <option value="">Chọn trạng thái</option>
                                    <option value="1">Ẩn</option>
                                    <option value="0">Hiển thị</option>
                                </select>
                                <!-- Hiển thị lỗi -->
                                @error('warehouse_status')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" name="add_warehouse" class="btn btn-info">Thêm Kho</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>


@endsection
