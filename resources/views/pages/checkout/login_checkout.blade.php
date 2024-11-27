@extends('layout')
@section('content')
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
					    <h2>Đăng nhập</h2>
					    <!-- Hiển thị thông báo lỗi từ session -->
					    @if(Session::has('login_error'))
					        <div class="alert alert-danger">
					            {{ Session::get('login_error') }}
					        </div>
					    @endif
					    <form action="{{URL::to('/login-customer')}}" method="post">
					        @csrf
					        <input type="text" name="email_account" placeholder="Tài khoản" />
					        <input type="password" name="password_account" placeholder="Mật khẩu" />
					        <span>
					            <input type="checkbox" class="checkbox"> 
					            Ghi nhớ đăng nhập
					        </span>
					        <button type="submit" class="btn btn-default">Đăng nhập</button>
					    </form>
					</div>

				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
									<div class="col-sm-4">
					    <div class="signup-form"><!--sign up form-->
							    <h2>Đăng ký ngay</h2>
							    <!-- Hiển thị lỗi xác thực -->
							    @if ($errors->any())
							        <div class="alert alert-danger">
							            <ul>
							                @foreach ($errors->all() as $error)
							                    <li>{{ $error }}</li>
							                @endforeach
							            </ul>
							        </div>
							    @endif
							    <!-- Hiển thị thông báo từ session -->
							    @if (Session::has('error'))
							        <div class="alert alert-danger">
							            {{ Session::get('error') }}
							        </div>
							    @endif

							    @if (Session::has('success'))
							        <div class="alert alert-success">
							            {{ Session::get('success') }}
							        </div>
							    @endif
							    <form action="{{ URL::to('/add-customer') }}" method="post">
							        @csrf
							        <input type="text" name="customer_name" placeholder="Họ và tên" value="{{ old('customer_name') }}" />
							        <input type="email" name="customer_email" placeholder="Địa chỉ email" value="{{ old('customer_email') }}" />
							        <input type="password" name="customer_password" placeholder="Mật khẩu" />
							        <input type="text" name="customer_phone" placeholder="Số điện thoại" value="{{ old('customer_phone') }}" />
							        <button type="submit" class="btn btn-default">Đăng ký</button>
							    </form>
							</div>

					</div>

			</div>
		</div>
	</section><!--/form-->
@endsection