@extends('admin_layout')
@section('admin_content')       
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Cập nhật thiết bị điện
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
                            @foreach($edit_product as $key => $pro)
                            <!-- Form chính -->
                            <form role="form" action="{{ URL::to('/update-product/' . $pro->product_id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <!-- Tên sản phẩm -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thiết bị điện</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$pro->product_name}}">                                   
                                </div>
                                <!-- SL sản phẩm -->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng</label>
                                <input type="text" name="product_quantity" class="form-control" id="exampleInputEmail1" value="{{$pro->product_quantity}}">
                            </div>
                                <!-- Giá sản phẩm -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá thiết bị điện</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" value="{{$pro->product_price}}">
                                </div>
                                <!-- Hình ảnh sản phẩm -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh thiết bị điện</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                   <img src="{{ URL::to('public/uploads/product/' . $pro->product_image) }}" height="150" width="100">
                            
                                </div>
                                <!-- Mô tả sản phẩm -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả thiết bị điện</label>
                                    <textarea id="product_desc" style="resize: none; text-align: left;" rows="5" class="form-control" name="product_desc">{{$pro->product_desc}}</textarea>
                                </div>
                                <!-- Thông số kỹ thuật -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thông số kỹ thuật</label>
                                    <textarea id="product_content" style="resize: none; text-align: left;" rows="5" class="form-control" name="product_content">{{$pro->product_content}}></textarea>
                                </div>
                                <!-- Loại sản phẩm -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Loại thiết bị điện</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            @if($cate->category_id==$pro->category_id)
                                            <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>  
                                            @else
                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>  
                                            @endif 
                                        @endforeach   

                                    </select>
                                </div>
                                <!-- Hãng sản phẩm -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hãng thiết bị điện</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                        @if($brand->brand_id==$pro->brand_id)
                                            <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>   
                                        @else
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>  
                                        @endif
                                        @endforeach                                
                                    </select>
                                </div>
                                <!-- Nhà cung cấp sản phẩm -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà cung cấp thiết bị điện</label>
                                    <select name="product_provider" class="form-control input-sm m-bot15">
                                        @foreach($provider_product as $key => $provider)
                                        @if($provider->provider_id==$pro->provider_id)
                                            <option selected value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>   
                                        @else
                                            <option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>  
                                        @endif
                                        @endforeach                            
                                    </select>
                                </div>
                                <!-- Hiển thị sản phẩm -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>                               
                                    </select>
                                </div>
                                <!-- Nút submit -->
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật thiết bị điện</button>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        </div>
@endsection
