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
                <h2>Reset Password</h2>
                <p>Authentication is necessary in order to change password</p>
                <form action="{{ route('changeforgotpassword.store') }}" method="POST">
                    {{ csrf_field() }}

                    <input type="hidden" name="id" value="{{$user[0]['user_id']}}">
                    
                    {{-- Fields --}}
                    <input class="input" id="password" data-toggle="tooltip" data-placement="top" title="Password Must Contains Atleat 6 Character With One Special Character, Capital Letter And Digit" name="password" type="password" required placeholder="New Password">
                    <input class="input" id="password_conformation" name="password_conformation" type="password" required placeholder="Confirm Password">

                    <br>
                    
                    <p><b>Note: </b>Password Must Contains Atleat 6 Character With One Special Character, Capital Letter And Digit</p>

                    @include('frontend.includes.errors')
                    
                    <button type="submit" value="reset-password">Change Password <i class="fal fa-long-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </main>

<script src="{{ asset('public/backend-assets/assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('public/frontend-assets/js/toastr.min.js') }}"></script>

@include('frontend.includes.alerts')
</body>

</html>