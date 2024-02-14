<?php
use App\Models\frontend\Department;
use App\Models\backend\Company;
use App\Models\backend\Designation;
use App\Models\backend\Location;
?>

<!DOCTYPE html>
@section('title', 'Sign Up')
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Sign Up</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel=" stylesheet" type="text/css" href="{{ asset('public/frontend-assets/css/toastr.min.css') }}">
    <link rel=" stylesheet" type="text/css" href="{{ asset('public/frontend-assets/static/css/login.css') }}">
</head>

<body>

    {{-- Main Register Page --}}
    <main class="auth-screen" style="background: url({{ asset('/public/frontend-assets/static/images/login-bg.jpg') }});">
        <div class="card shadow border-0">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="image">
                    <img src="{{ asset('/public/frontend-assets/images/logo.png') }}" alt="">
                    <h2>Create an account</h2>
                </div>
                <div class="form">
                    <div class="item">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter Name *" required />
                        @error('name')
                        <div>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="item">
                        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name *" required />
                        @error('last_name')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="item">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email *" required />
                        @error('email')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="item">
                        <input type="text" name="mobile_no" value="{{ old('mobile_no') }}" placeholder="Enter Mobile No. *" required />
                        @error('mobile_no')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="item">
                        <select id="department" name="department" class="" required>
                            <option value="" selected>Select Department *</option>
                            @foreach (Department::all() as $item)
                                @if (!empty(old('department') && old('department') == $item['department_id']))
                                    <option value="{{ old('department') }}" selected>
                                        {{ $item['name'] }}
                                    </option>
                                @else
                                    <option value="{{ $item['department_id'] }}">
                                        {{ $item['name'] }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('department')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="item">
                        <select id="company_id" name="company_id" class="form-select" required>
                            <option value="" selected>Select Company *</option>
                            @foreach (Company::all() as $item)
                                @if (!empty(old('company_id') && old('company_id') == $item['company_id']))
                                    <option value="{{ old('company_id') }}" selected>
                                        {{ $item['company_name'] }}
                                    </option>
                                @else
                                    <option value="{{ $item['company_id'] }}">
                                        {{ $item['company_name'] }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('company_id')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="item">
                        <select id="designation_id" name="designation_id" class="form-select" required>
                            <option value="" selected>Select Designation *</option>
                            @foreach (Designation::all() as $item)
                                @if (!empty(old('designation_id') && old('designation_id') == $item['designation_id']))
                                    <option value="{{ old('designation_id') }}" selected>
                                        {{ $item['designation_name'] }}
                                    </option>
                                @else
                                    <option value="{{ $item['designation_id'] }}">
                                        {{ $item['designation_name'] }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('designation_id')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="item">
                        <select id="location" name="location" class="form-select" required>
                            <option value="" selected>Select Location *</option>
                            @foreach (Location::all() as $item)
                                @if (!empty(old('location') && old('location') == $item['location_id']))
                                    <option value="{{ old('location') }}" selected>
                                        {{ $item['location_name'] }}
                                    </option>
                                @else
                                    <option value="{{ $item['location_id'] }}">
                                        {{ $item['location_name'] }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('location')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="item">
                        <input type="password" onkeypress="return event.charCode != 32" name="password" value="{{ old('password') }}" placeholder="Enter Password *" data-toggle="tooltip" data-placement="top" title="Password Must Contains Atleat 6 Character With One Special Character, Capital Letter And Digit" required />
                        @error('password')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="item">
                        <input id='password' onkeypress="return event.charCode != 32" type="password" name="password_confirmation" placeholder="Confirm Password *" required />
                        @error('confirm_password')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>

                    
                    <span class="helper-text">
                        <b>Note:</b> Password Must Contains Atleat 6 Character With One Special Character, Capital Letter And Digit
                    </span>
                </div>
                <button type="submit">Create Account <i class="fal fa-long-arrow-right"></i></button>
                <p>Already have account? <a href="{{ url('/') }}">Sign In</a></p>
            </form>
        </div>
    </main>

    <script src="{{ asset('public/backend-assets/assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('public/frontend-assets/js/toastr.min.js') }}"></script>

    @include('frontend.includes.alerts')
</body>

</html>
