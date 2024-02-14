<!DOCTYPE html>
@section('title', 'Sign in')
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Sign in</title>
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
                <h2>Login to your account</h2>
                <form action="{{ route('user.auth') }}" method="POST">
                    @if (isset($errors) && count($errors) > 0)
                    <ul class="error">
                        @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                        @endforeach
                    </ul>
                    @endif

                    {{-- Fields --}}
                    @csrf
                    <input type="email" name="email" placeholder="Enter Email" class="input" />
                    @error('email')
                    <p class="helper-text">{{ $message }}</p>
                    @enderror
                    
                    <input type="password" name="password" placeholder="Password" class="input" />
                    @error('password')
                    <p class="helper-text">{{ $message }}</p>
                    @enderror
                    
                    @if (request()->input('status') == 'error')
                    <div>Incorrect Password or Username</div>
                    @elseif(request()->input('status') == 'errorNA')
                    <div>Account under verification please contact admin</div>
                    @elseif(request()->input('status') == 'errorRA')
                    <div>Account is not assigned with any role please contact admin</div>
                    @endif
                    
                    <button type="submit">Login <i class="fal fa-long-arrow-right"></i></button>
                    <p>
                        Not registered? <a href="{{ url('/user/register') }}">Create an account</a>
                    </p>
                    <p>
                        Forgot Password? <a href="{{ route('user.forgot_password') }}">Reset Password</a>
                    </p>
                </form>
            </div>
        </div>
    </main>

    <script src="{{ asset('public/backend-assets/assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('public/frontend-assets/js/toastr.min.js') }}"></script>
    
    @include('frontend.includes.alerts')
</body>

</html>
