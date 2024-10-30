@extends('admin_layout')
@section('admin_content')       
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thiết bị điện
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
                        <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <!-- Tên sản phẩm -->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên thiết bị điện</label>
                                <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thiết bị điện">
                                @error('product_name')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- SL sản phẩm -->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng</label>
                                <input type="text" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Số lượng">
                                @error('product_quantity')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Giá sản phẩm -->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá thiết bị điện</label>
                                <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Giá thiết bị điện">
                                @error('product_price')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Hình ảnh sản phẩm -->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh thiết bị điện</label>
                                <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                @error('product_image')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Mô tả sản phẩm -->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả thiết bị điện</label>
                                <textarea id="product_desc" style="resize: none; text-align: left;" rows="5" class="form-control" name="product_desc" placeholder="Mô tả thiết bị điện"></textarea>
                                @error('product_desc')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Thông số kỹ thuật -->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thông số kỹ thuật</label>
                                <textarea id="product_content" style="resize: none; text-align: left;" rows="5" class="form-control" name="product_content" placeholder="Thông số kỹ thuật"></textarea>
                                @error('product_content')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Loại sản phẩm -->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Loại thiết bị điện</label>
                                <select name="product_cate" class="form-control input-sm m-bot15">
                                    @foreach($cate_product as $key => $cate)
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>   
                                    @endforeach
                                </select>
                                @error('product_cate')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Hãng sản phẩm -->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hãng thiết bị điện</label>
                                <select name="product_brand" class="form-control input-sm m-bot15">
                                    @foreach($brand_product as $key => $brand)
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>   
                                    @endforeach
                                </select>
                                @error('product_brand')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Nhà cung cấp sản phẩm -->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nhà cung cấp thiết bị điện</label>
                                <select name="product_provider" class="form-control input-sm m-bot15">
                                    @foreach($provider_product as $key => $provider)
                                        <option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>   
                                    @endforeach
                                </select>
                                @error('product_provider')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Hiển thị sản phẩm -->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="product_status" class="form-control input-sm m-bot15">
                                    <option value="1">Ẩn</option>
                                    <option value="0">Hiển thị</option>
                                </select>
                                @error('product_status')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" name="add_product" class="btn btn-info">Thêm thiết bị điện</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
