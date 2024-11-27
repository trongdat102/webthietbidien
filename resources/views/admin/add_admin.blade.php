<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Trang quản lý Admin Web</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> 
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); 
        function hideURLbar(){ window.scrollTo(0,1); } 
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
    <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<div class="log-w3">
    <div class="w3layouts-main">
        <h2>Đăng ký tài khoản Admin</h2>
        @if(Session::has('message'))
            <span style="color: orangered; font-weight: bold; padding: 10px; border-radius: 5px; width: 100%;">
                {{ Session::get('message') }}
            </span>
            <?php Session::put('message', null); ?>
        @endif

        <form action="{{ url('/add-admin') }}" method="post">
            @csrf
            <label for="admin_name">Họ và tên:</label>
            <input type="text" class="ggg" name="admin_name" id="admin_name" placeholder="Nhập tên" required>

            <label for="admin_email">Email:</label>
            <input type="email" class="ggg" name="admin_email" id="admin_email" placeholder="Nhập email" required>

            <label for="admin_password">Mật khẩu:</label>
            <input type="password" class="ggg" name="admin_password" id="admin_password" placeholder="Nhập mật khẩu" required>

            <label for="admin_phone">Số điện thoại:</label>
            <input type="text" class="ggg" name="admin_phone" id="admin_phone" placeholder="Nhập số điện thoại" required>

            <div class="clearfix"></div>
            <!-- <button type="submit" class="btn btn-default">Đăng ký</button> -->
            <input type="submit" value="Đăng ký" name="register">
        </form>
    </div>
</div>

<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
</body>
</html>
