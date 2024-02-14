@extends('frontend.layouts.app')
@section('title', 'Change Password')
@section('content')

{{-- Breadcrumb --}}
<section class="cs-breadcrumb">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('user.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Change Password</li>
        </ol>
    </div>
</section>

{{-- Content --}}
<section class="cs-content">
    <div class="container-fluid">
        <div id="basic-datatable">
            <div class="card">
                <div class="card-header">
                    <h1>Change Password</h1>
                    <a class="btn btn-outline-primary" href="{{ route('ideas.index') }}">
                        <i class="fa fa-angle-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    @include('backend.includes.errors')
                    <form class="form" method="POST" action="{{ route('user.updatePassword') }}" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="row g-4 mb-4">
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-0">
                                    <label>Old Password *</label>
                                    <input type="password" class="form-control" name="old_password" placeholder="Enter Old Password" required>
                                    {{ Form::hidden('user_id', $userdata->user_id, ['class' =>
                                    'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-6 col-12"></div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-0">
                                    {{ Form::label('new_password', 'New Password *') }}
                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password" required>
                                     <span style="font-size: 11px;" class="text-danger"><b>Note: </b>Password Must Contains Atleat 6 Character With One Special Character, Capital Letter And Digit</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-0">
                                    {{ Form::label('password_confirmation', 'Confirm New Password *') }}
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Enter New Password again" required>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-start">
                                {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1')) }}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
