<!DOCTYPE html>
@section('title', 'Reset Password')
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Reset Password</title>
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
                <h2>Email Sent</h2>
                <p>Please click on the link which is shared on your email.</p>
            </div>
        </div>
    </main>

<script src="{{ asset('public/backend-assets/assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('public/frontend-assets/js/toastr.min.js') }}"></script>

@include('frontend.includes.alerts')
</body>

</html>