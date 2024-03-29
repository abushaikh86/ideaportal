@extends('backend.layouts.app')
@section('title', 'Change Password Internal Users')

@section('content')

<?php
use App\Models\backend\Company;
?>

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">Change Password</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                <a class="btn btn-outline-primary" href="{{ route('admin.users') }}">
                    <i class="feather icon-back"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>


<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="card-body">
                            @include('backend.includes.errors')
                              <form class="form" method="POST" action="{{ url('/') }}/admin/user/update/password" autocomplete="off">

                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                {{ Form::label('new_password', 'New Password *') }}
                                                <input type="password" class="form-control" id="new_password"
                                                name="password" placeholder="Enter New Password"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Password Must Contains Atleat 6 Character With One Special Character, Capital Letter And Digit"
                                                required>
                                                {{ Form::hidden('user_id', $user->admin_user_id, ['class' => 'form-control']) }}
                                                <span style="color:red;font-size: 11px;"><b>Note: </b>Password Must Contains Atleat 6 Character With One Special Character, Capital Letter And Digit</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                {{ Form::label('password_confirmation', 'Confirm New Password *') }}
                                                <input type="password" class="form-control" name="password_confirmation" placeholder="Enter New Password again" required>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-start">
                                            {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1')) }}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('scripts')

@endsection
