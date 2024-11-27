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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" crossorigin href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&amp;family=Bricolage&#x2B;Grotesque:opsz,wght@12..96,300;12..96,400;12..96,500;12..96,600;12..96,700&amp;family=Material&#x2B;Symbols&#x2B;Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&amp;display=swap&amp;family=Space&#x2B;Grotesk:wght@400;500;700&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                                @foreach($brand as $brand_item)
                            <li><a href="{{ URL::to('/thuong-hieu-san-pham/' . $brand_item->brand_id) }}">{{ $brand_item->brand_name }}</a></li>
                            @endforeach
            </ul>
        </li>
        
        <li><a href="{{ URL::to('/gio-hang') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
        
        <li class="dropdown"><a href="#"><i class="fa fa-user"></i> Cá nhân <i class="fa fa-angle-down"></i></a>
    <ul class="sub-menu">
        {{-- <li><a href="wishlish.html"><i class="fa fa-heart"></i> Bảo hành</a></li> --}}
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
            {{-- <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li> --}}
        <?php } ?>
        
        <li><a href="{{ URL::to('/gio-hang') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
        {{-- lịch sử --}}
        <?php
            $customer_id = Session::get('customer_id');
            if($customer_id != NULL) { 
        ?>
            <li><a href="{{ URL::to('/history') }}"><i class="fa fa-bell"></i> Lịch sử mua hàng</a></li>

        <?php 
    } 

        ?>
        
        {{-- đăng nhập --}}
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
        
    </section>
    
    <footer id="footer"><!--Footer-->
        <div class="order-area box-shadow1 ptb-30 bb bg-fff" >
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-order c-fff home3-bg p-20">
                            <div class="order-icon">
                                <span class="fa fa-plane"></span>
                            </div>
                            <div class="order-content">
                                <h5>Miễn phí vận chuyển</h5>
                                <span>Cho tất cả các đơn hàng</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-order c-fff home3-bg p-20">
                            <div class="order-icon">
                                <span class="fa fa-refresh"></span>
                            </div>
                            <div class="order-content">
                                <h5>Trả hàng trong 7 ngày</h5>
                                <span>Đảm bảo hoàn tiền</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-order c-fff home3-bg p-20">
                            <div class="order-icon">
                                <span class="fa fa-umbrella"></span>
                            </div>
                            <div class="order-content">
                                <h5>Hỗ trợ 24/7</h5>
                                <span>Hotline: 0931590032</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-order c-fff home3-bg p-20">
                            <div class="order-icon">
                                <span class="fa fa-user"></span>
                            </div>
                            <div class="order-content">
                                <h5>Hỗ trợ giảm giá</h5>
                                <span>Giảm 10% cho thành viên</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="social-items">
                                <a href="https://www.facebook.com/sieuthidiennguphuc/" target="" class="fa-brands fa-facebook-f"></a>
                                <a href="https://www.youtube.com/@sieuthidiennguphuc" target="" class="fa-brands fa-youtube"></a>
                                <a href="https://www.tiktok.com/@sieuthidiennguphuc" target="" class="fa-brands fa-tiktok"></a>
                                {{-- <a href="https://zalo.me/1628137845489591149" target=""> <img src="/public/frontend/images/zalo.svg" alt="" /></a> --}}
                    </div>
        <div class="footer-widget" style="background: linear-gradient(90deg, #004b7b 0, #0978be 50%, #49b9ff 100%);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-item">
                        <div class="single-widget">
                            <h4>Trụ Sở Chính</h4>    
                                <p class="address-p"><span class="fa-solid fa-location-dot"></span> Số 7/3B Lê Hồng Phong, Ngô Quyền, HP</p>
                                    <p class="address-p notshowmobile"><span class="fa-solid fa-envelope"></span> Email: info@nguphuc.com.vn</p>
                                    <p class="address-p notshowmobile"><span class="fa-solid fa-fax"></span> Fax: 0931 590 032</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-item">
                        <div class="single-widget">
                            <h4>THÉP NGŨ PHÚC</h4>    
                                <p class="address-p"><span class="fa-solid fa-location-dot"></span> Số 348 đường Hà Nội, Hồng Bàng, Hải Phòng</p>
                                <p class="address-p notshowmobile"><span class="fa-solid fa-envelope"></span> Email: nguphucsteel@gmail.com</p>
                                    <p class="address-p notshowmobile"><span class="fa-solid fa-fax"></span> Fax: 0225.3538.707</p>                   
                        </div>
                    </div>
                    <div class="col-lg-4 col-item">
                        <div class="d-flex flex-column wrapper_button_footer">
                            <a href="tel:0931590032" class="btn-link mb-3">
                                <span class="me-3 fa-solid fa-phone"></span>
                                HOTLINE: 0931 590 032
                                <span class="fa-solid fa-arrow-up-right-from-square"></span>
                            </a>
                            <a href="mailto:pkd@nguphuc.com.vn" class="btn-link">
                                <span class="me-3 fa-solid fa-paper-plane"></span>
                                Liên hệ chúng tôi
                                <span class="fa-solid fa-arrow-up-right-from-square"></span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="navigation-footer">
                <ul class="nav">
                        <li>
                            <a href="https://www.nguphuc.com.vn/chinh-sach-bao-hanh-tt1394.html">Chính sách bảo hành</a>
                        </li>
                        <li>
                            <a href="https://www.nguphuc.com.vn/chinh-sach-doi-tra-hang-hoa-tt1392.html">Chính sách đổi trả</a>
                        </li>
                        <li>
                            <a href="https://www.nguphuc.com.vn/chinh-sach-bao-mat-thong-tin-tt1395.html">Chính sách bảo mật</a>
                        </li>
                </ul>
            </div>
        <div class="text-center">
            <p class="copyright m-0 f-Manrope">Copyright © 2024 VMU. All right reserved.</p>
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
            // Kiểm tra các trường dữ liệu trước khi gửi yêu cầu
            var shipping_email = $('.shipping_email').val();
            var shipping_name = $('.shipping_name').val();
            var shipping_address = $('.shipping_address').val();
            var shipping_phone = $('.shipping_phone').val();
            var shipping_notes = $('.shipping_notes').val() | "";
            var shipping_method = $('.payment_select').val();

            // Kiểm tra nếu có trường nào chưa được điền
            if (!shipping_email || !shipping_name || !shipping_address || !shipping_phone || !shipping_method) {
                swal("Lỗi", "Vui lòng điền đầy đủ thông tin trước khi xác nhận đơn hàng!", "error");
                return false;  // Không tiếp tục nếu thiếu thông tin
            }

            // Nếu tất cả thông tin đã đầy đủ, hiển thị cảnh báo xác nhận
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
                    var _token = $('input[name="_token"]').val();
                    
                    $.ajax({
                        url: '{{url('/confirm-order')}}', 
                        method: 'post', 
                        data: {
                            shipping_email: shipping_email,
                            shipping_name: shipping_name,
                            shipping_address: shipping_address,
                            shipping_phone: shipping_phone,
                            shipping_notes: shipping_notes,
                            _token: _token,
                            shipping_method: shipping_method
                        },
                        success: function(data){
                            swal("Đơn hàng", "Đặt hàng thành công", "success");
                        },
                        error: function() {
                            swal("Lỗi", "Vui lòng thêm sản phẩm vào giỏ hàng", "error");
                        }
                    });
                    
                    // Reload trang sau 3 giây
                    window.setTimeout(function(){
                        location.reload();
                    }, 1000);
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
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                if(parseInt(cart_product_qty) > parseInt(cart_product_quantity)){
                    alert('Làm ơn đặt số lượng nhỏ hơn: ' + cart_product_quantity);
                }else{


                $.ajax({
                    url: '{{url('/add-cart-ajax')}}', method: 'post', data:{id:id,cart_product_id:cart_product_id, cart_product_name:cart_product_name, cart_product_image:cart_product_image, cart_product_price:cart_product_price, cart_product_qty:cart_product_qty, _token:_token,cart_product_quantity:cart_product_quantity}, 
                    success:function(data){
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
                }
            });
        });
    </script>
    <script type="text/javascript">
        function Huydonhang(id){
            var order_code = id;
            var lydo = $('.lydohuydon').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                    url: '{{url('/huy-don-hang')}}', method: 'post', data:{order_code:order_code,lydo:lydo,_token:_token}, 
                    success:function(data){
                        alert('Đơn hàng đã được hủy');
                        location.reload();
                    }
        }) 
        }
    </script>
    <script type="text/javascript">
        function Tradonhang(id){
            var order_code = id;
            var lydo = $('.lydotrahang').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                    url: '{{url('/tra-don-hang')}}', method: 'post', data:{order_code:order_code,lydo:lydo,_token:_token}, 
                    success:function(data){
                        alert('Đơn hàng đã xác nhận trả');
                        location.reload();
                    }
        }) 
        }
    </script>
</body>
</html>