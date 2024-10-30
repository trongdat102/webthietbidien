@extends('admin_layout')
@section('admin_content')       
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Thương hiệu sản phẩm
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
                        <form role="form" action="{{URL::to('/save-brand-product')}}" method='post'>
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Thương hiệu</label>
                            <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder=" Tên thương hiệu">
                            <!-- Hiển thị lỗi -->
                            @error('brand_product_name')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Thương hiệu</label>
                            <textarea id="brand_product_desc" style="resize: none; text-align: left;" rows="5" class="form-control" name="brand_product_desc" placeholder="Mô tả thương hiệu"></textarea>
                            <!-- Hiển thị lỗi -->
                            @error('brand_product_desc')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="brand_product_status" class="form-control input-sm m-bot15">
                                <option value="">Chọn trạng thái</option>
                                <option value="1">Ẩn</option>
                                <option value="0">Hiển thị</option>
                            </select>
                            <!-- Hiển thị lỗi -->
                            @error('brand_product_status')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" name="add_brand_product" class="btn btn-info">Thêm thương hiệu</button>
                    </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
