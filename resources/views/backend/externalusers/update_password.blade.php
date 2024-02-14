@extends('backend.layouts.app')
@section('title', 'External Users Change Password')
<?php
use App\Models\frontend\Department;
?>
@section('content')



    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">External Users Change Password</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.externalusers') }}">EXTERNAL USER</a>
                        </li>

                        <li class="breadcrumb-item active">Change Password</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <a class="btn btn-outline-primary" href="{{ route('admin.externalusers') }}">
                        <i class="fa-solid fa-angle-left text-light"></i>&nbsp;&nbsp;
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>


    <section id="basic-datatable">
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            @include('backend.includes.errors')

                            {!! Form::open([
                                'method' => 'POST',
                                'url' => ['admin/externalusers/changepassword'],
                                'class' => 'form',
                            ]) !!}
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-2">
                                        <div class="form-group">
                                            {{ Form::label('Enter Password', 'New Password *') }}
                                            {{ Form::hidden('user_id', $user->user_id, ['class' => 'form-control']) }}
                                            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter New Password', 'required' => true]) }}
                                            <span>Note</span>
                                            <span class='text-danger'>Password Must Contains Atleat 6 Character With One Special Character, Capital Letter And Digit</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mb-2">
                                        <div class="form-group">
                                            {{ Form::label('Enter Password', 'Confirm Password *') }}
                                            {{ Form::hidden('user_id', $user->user_id, ['class' => 'form-control']) }}
                                            {{ Form::password('password_confirmation',  ['class' => 'form-control', 'placeholder' => 'Enter New Password', 'required' => true]) }}
                                        </div>
                                    </div>


                                    <div class="col-md-12 center">
                                        {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                                        <button type="reset" class="btn btn-light mr-1 mb-1">Reset</button>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>







        </div>

        </div>

        </div>

    </section>

@endsection
