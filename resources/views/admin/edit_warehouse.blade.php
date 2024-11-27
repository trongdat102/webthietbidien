@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật kho
                </header>
                <div class="panel-body">
                    <!-- Thông báo khi có lỗi hoặc thành công -->
                    <?php
                    $message = Session::get('message');
                    if($message){
                        echo '<span style="color: orangered; font-weight: bold; padding: 10px; border-radius: 5px; width: 100%; ">', $message, '</span>';
                        Session::put('message', null);
                    }
                    ?>

                    @foreach($edit_warehouse as $key => $edit_value)
                        <div class="position-center">
                            <form role="form" action="{{ URL::to('/update-warehouse/'.$edit_value->warehouse_id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="warehouse_name">Tên kho</label>
                                    <input
                                        type="text"
                                        value="{{ old('warehouse_name', $edit_value->warehouse_name) }}"
                                        name="warehouse_name"
                                        class="form-control"
                                        id="warehouse_name"
                                        placeholder="Tên kho"
                                        required
                                    >
                                    <!-- Hiển thị lỗi nếu có -->
                                    @error('warehouse_name')
                                    <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="warehouse_desc">Địa chỉ</label>
                                    <textarea
                                        style="resize: none;"
                                        rows="5"
                                        class="form-control"
                                        name="warehouse_address"
                                        id="warehouse_address"
                                        required
                                    >{{ old('warehouse_address', $edit_value->warehouse_address) }}</textarea>
                                    <!-- Hiển thị lỗi nếu có -->
                                    @error('warehouse_address')
                                    <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" name="update_warehouse" class="btn btn-info">Cập nhật kho</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
