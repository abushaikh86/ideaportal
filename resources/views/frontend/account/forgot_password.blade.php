<!DOCTYPE html>
@section('title', 'Sign in')
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel=" stylesheet" type="text/css" href="{{ asset('public/frontend-assets/css/toastr.min.css') }}">
    <link rel=" stylesheet" type="text/css" href="{{ asset('public/frontend-assets/static/css/login.css') }}">
</head>
<body>
    {{-- Main Login Page --}}
    <main class="login-screen" style="background: url({{ asset('/public/frontend-assets/static/images/login-bg.jpg') }});">
        <div class="card">
            <div class="image">
                <img src="{{ asset('/public/frontend-assets/images/jm-baxi.jpg') }}" alt="">
            </div>
            <div class="form">
                <img src="{{ asset('/public/frontend-assets/images/logo.png') }}" alt="" class="logo">
                <h2>Forgot Password</h2>
                <p>Authentication is necessary in order to change password</p>
                <form action="{{ url('/sendotp') }}" method="POST">
                    {{ csrf_field() }}
                    
                    {{-- Fields --}}
                    <input name="email" type="email" value="{{ old('email') }}" required class="input" placeholder="Enter Email Id." />
                    @include('frontend.includes.errors')
                    <p>OTP will be sent to your email</p>
                    
                    <button type="submit">Request an OTP <i class="fal fa-long-arrow-right"></i></button>
                    <p>Already a member? <a href="{{ url('/') }}">Login</a></p>
                </form>
            </div>
        </div>
    </main>

<script src="{{ asset('public/backend-assets/assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('public/frontend-assets/js/toastr.min.js') }}"></script>

@include('frontend.includes.alerts')
</body>

</html>
