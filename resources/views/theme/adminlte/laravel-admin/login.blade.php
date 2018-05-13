<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{config('admin.title')}} | {{ trans('admin.login') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/AdminLTE/bootstrap/css/bootstrap.min.css") }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/font-awesome/css/font-awesome.min.css") }}">
  <!-- Theme style -->
  <link rel="stylesheet" type="text/css" href="{{ admin_asset('/vendor/animate/animate.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ admin_asset('/vendor/css-hamburgers/hamburgers.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ admin_asset('/css/login-util.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ admin_asset('/css/login-main.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Merriweather" rel="stylesheet">
  
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/AdminLTE/plugins/iCheck/square/blue.css") }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
        <div class="title">
          <a href="{{ admin_base_path('/') }}"><b>{{config('admin.name')}}</b></a>
        </div>
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{ admin_asset('/images/img-01.png') }}" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="{{ admin_base_path('auth/login') }}" method="post">
					<span class="login100-form-title">
						Đăng nhập Hệ thống
          </span>
          
          @if($errors->any())
          <div class="has-error">
            @foreach($errors->all() as $message)
              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label></br>
            @endforeach
          </div>
          @endif

					<div class="wrap-input100 validate-input {!! !$errors->has('username') ?: 'has-error' !!}" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username" value="{{ old('username') }}" placeholder="{{ trans('admin.username') }}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input {!! !$errors->has('password') ?: 'has-error' !!}"  data-validate = "Password is required">
						<input class="input100" type="password" placeholder="" name="password" value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button class="login100-form-btn">
            {{ trans('admin.login') }}
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Quên
						</span>
						<a class="txt2" href="#">
							Tài khoản hay Mật khẩu?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Đăng ký Tài khoản
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
</div>

<!-- jQuery 2.1.4 -->
<script src="{{ admin_asset("/vendor/laravel-admin/AdminLTE/plugins/jQuery/jquery.min.js")}} "></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ admin_asset("/vendor/laravel-admin/AdminLTE/bootstrap/js/popper.min.js")}}"></script>
<script src="{{ admin_asset("/vendor/laravel-admin/AdminLTE/bootstrap/js/bootstrap.min.js")}}"></script>
<!-- iCheck -->
<script src="{{ admin_asset("/vendor/laravel-admin/AdminLTE/plugins/iCheck/icheck.min.js")}}"></script>
<script src="{{ admin_asset('/vendor/tilt/tilt.jquery.min.js') }}"></script>
<script >
  $('.js-tilt').tilt({
    scale: 1.1
  })
</script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<script src="{{ admin_asset('/js/login-main.js') }}"></script>
</body>
</html>
