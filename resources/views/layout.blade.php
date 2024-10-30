<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SIÊU THỊ ĐIỆN NGŨ PHÚC</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <!--<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">-->
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="icon" type="image/x-icon" href="{{ asset('public/frontend/images/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/yourcode.js"></script>
</head><!--/head-->

<body> 
    <header id="header">
    <header class="main-header">

    <!-- Header Middle với logo và main menu -->
    <div class="header-middle">
        <div class="container">
            <div class="header-flex">
                <!-- Logo -->
                <div class="logo">
                    <a href="{{ url('/trangchu') }}"><img src="{{ asset('public/frontend/images/logo1.png') }}" alt="Logo" /></a>
                </div>

                <!-- Main Menu -->
                <div class="mainmenu">
    <ul class="nav navbar-nav" style="margin-left: 50px;">
        <li><a href="{{ url('/trangchu') }}" class="active"><i class="fa fa-home"></i> Trang chủ</a></li>
        
        <li class="dropdown"><a href="#"><i class="fa fa-th-large"></i>Nhóm sản phẩm<i class="fa fa-angle-down"></i></a>
                            <ul class="sub-menu">
                                @foreach($category as $key => $cate)
                                <div class="panel-heading">                                       
                                    <h4 class="panel-title"><a href="{{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}">{{$cate->category_name}}</a></h4>   
                            </div>
                            @endforeach
                            </ul>
                        </li> 
        
        <li class="dropdown"><a href="#"><i class="fa fa-industry"></i> Thương hiệu <i class="fa fa-angle-down"></i></a>
            <ul class="sub-menu">
                <li><a href="blog.html">PANASONIC</a></li>
                <li><a href="blog-single.html">MITSUBISHI</a></li>
            </ul>
        </li>
        
        <li><a href="{{ URL::to('/gio-hang') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
        
        <li class="dropdown"><a href="#"><i class="fa fa-user"></i> Cá nhân <i class="fa fa-angle-down"></i></a>
    <ul class="sub-menu">
        <li><a href="wishlish.html"><i class="fa fa-heart"></i> Bảo hành</a></li>
        <?php
            $customer_id = Session::get('customer_id');
            $shipping_id = Session::get('shipping_id');
            if($customer_id != NULL && $shipping_id == NULL) { 
        ?>
            <li><a href="{{ URL::to('/checkout') }}"><i class="fa fa-credit-card"></i> Thanh toán</a></li>
        <?php
            } elseif ($customer_id != NULL && $shipping_id != NULL) {  // Đã sửa lỗi cú pháp tại đây
        ?>
            <li><a href="{{ URL::to('/payment') }}"><i class="fa fa-credit-card"></i> Thanh toán</a></li>
        <?php 
            } else { 
        ?>
            <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
        <?php } ?>
        
        <li><a href="{{ URL::to('/gio-hang') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
        
        <?php
            $customer_id = Session::get('customer_id');
            if($customer_id != NULL) { 
        ?>
            <li><a href="{{ URL::to('/logout-checkout') }}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
        <?php } else { ?>
            <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
        <?php } ?>
    </ul>
</li>

    </ul>
</div>


                <!-- Thanh tìm kiếm -->
                <div class="col-sm-4">
                <form action="{{URL::to('/tim-kiem')}}" method="post">
                    @csrf
                <div class="">
                    <i class="fa fa-search"></i>
                    <input type="text" name="keywords_submit" placeholder="Tìm kiếm sản phẩm" />
                    <input type="submit" style="margin-top: 0; color: white; background: #546472" name="search_items" class="btn btn-primary btn-small" value="Tìm kiếm">
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</header>
    <section id="slider" style="margin-top: 20px;"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-12">
                                    <img src="{{ asset('public/frontend/images/banner1.jpg') }}" class="girl img-responsive" alt="" 
                                    style="margin-left: -50px" />
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-12">
                                    <img src="{{ asset('public/frontend/images/slider-NguPhuc-1.jpg')}}" class="girl img-responsive" alt="" style="margin-left: -50px"/>
                                    
                                </div>
                            </div>
                            
                            <div class="item">
                                <div class="col-sm-12">
                                    <img src="{{ asset('public/frontend/images/banner2.jpg')}}" class="girl img-responsive" alt=""  style="margin-left: -50px"/>
                                    
                                </div>
                            </div>
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Nhóm sản phẩm</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @foreach($category as $key => $cate)
                            <div class="panel panel-default">
                                <div class="panel-heading">                                       
                                    <h4 class="panel-title"><a href="{{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}">{{$cate->category_name}}</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach($brand as $key => $brand)
                                    <li><a href="{{ URL::to('/thuong-hieu-san-pham/' . $brand->brand_id) }}">{{$brand->brand_name}}</a></li> 
                                    @endforeach               
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                    
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">

                @yield('content')     
                                                        
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        <div class="footer-top" style="background-color: #ffffff;">
    <div class="container text-center">
        <div class="row justify-content-center">
            <!-- Logo công ty -->
            <div class="col-12">
                <div class="companyinfo">
                    <a href="{{ url('/trangchu') }}">
                        <img src="{{ asset('public/frontend/images/logo2.png') }}" alt="logo footer" class="footer-logo">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="footer-widget" style="background: linear-gradient(to right, #5468ff, #87CEEB);">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom" style="background: linear-gradient(to right, #5468ff, #87CEEB);">
            <div class="container">
                <div class="row">
                    <p class="pull-left" style="">Copyright © 2024 VMU.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="https://www.facebook.com/trongdat.ng">Trong Dat</a></span></p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
    

  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.js')}}"></script>
    

    <script type="text/javascript">
        $(document).ready(function(){
            $('.send_order').click(function(){
                swal({
                  title: "Xác nhận đặt hàng?",
                  text: "Vui lòng kiểm tra kĩ thông tin cá nhân",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Xác nhận",
                  cancelButtonText: "Hủy",
                  closeOnConfirm: false,
                  closeOnCancel: false
                },
                function(isConfirm){
                if (isConfirm) {
                var shipping_email = $('.shipping_email').val();
                var shipping_name = $('.shipping_name').val();
                var shipping_address = $('.shipping_address').val();
                var shipping_phone = $('.shipping_phone').val();
                var shipping_notes = $('.shipping_notes').val();
                var shipping_method = $('.payment_select').val();
                var _token = $('input[name="_token"]').val();
                
                $.ajax({
                    url: '{{url('/confirm-order')}}', method: 'post', data:{shipping_email:shipping_email, shipping_name:shipping_name, shipping_address:shipping_address, shipping_phone:shipping_phone, shipping_notes:shipping_notes, _token:_token, shipping_method:shipping_method}, 
                    success:function(){
                        swal("Đơn hàng", "Đặt hàng thành công", "success");
                    }
                    });
                window.setTimeout(function(){
                    location.reload();
                } ,3000);
                } else {
                   swal("Đóng", "Đã hủy đơn hàng", "error"); 
                }
            });

        });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.add-to-cart').click(function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                
                $.ajax({
                    url: '{{url('/add-cart-ajax')}}', method: 'post', data:{id:id,cart_product_id:cart_product_id, cart_product_name:cart_product_name, cart_product_image:cart_product_image, cart_product_price:cart_product_price, cart_product_qty:cart_product_qty, _token:_token}, 
                    success:function(){
                        swal({
                            title: "Đã thêm sản phẩm vào giỏ hàng",
                            text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                            showCancelButton: true,
                            cancelButtonText: "Xem tiếp",
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Đi đến giỏ hàng",
                            closeOnConfirm: false
                            },
                            function() {
                            window.location.href = "{{url('/gio-hang')}}";
                            });
                    }
                });
            });
        });
    </script>
</body>
</html>