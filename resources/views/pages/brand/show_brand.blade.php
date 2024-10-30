@extends('layout')
@section('content')
                    <div class="features_items"><!--features_items-->
                        @foreach($brand_name as $key => $name)
                       
                        <h2 class="title text-center">{{$name->brand_name}}</h2>
                        @endforeach
                         @foreach($brand_by_id as $key => $product)
                         <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ asset('public/uploads/product/' . $product->product_image) }}" alt="" />
                                            <h2>{{number_format($product->product_price).' '.'đ'}}</h2>
                                            <p>{{$product->product_name}}</p>
                                            <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">Thêm vào giỏ hàng</button>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-heart"></i>Yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        </a>
                        @endforeach 
                    </div>    
@endsection   