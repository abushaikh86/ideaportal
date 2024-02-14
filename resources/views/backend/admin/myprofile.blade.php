@php
use App\Models\frontend\Department;
use App\Models\backend\Company;
use App\Models\backend\Designation;
use App\Models\backend\Location;
@endphp
@extends('backend.layouts.app')
@section('title', 'Edit Profile')
@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">Edit Profile</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Profile</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                <a class="btn btn-outline-primary" href="{{ route('admin.dashboard') }}">
                    Home
                </a>
            </div>
        </div>
    </div>
</div>

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        @include('backend.includes.errors')
                        {!! Form::model($adminuser, [
                        'method' => 'POST',
                        'url' => ['admin/update_profile'],
                        'class' => 'form'
                        ]) !!}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::hidden('admin_user_id', $adminuser->admin_user_id) }}
                                        {{ Form::label('first_name', 'First Name *') }}
                                        {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' =>
                                        'Enter First Name', 'required' => true]) }}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('last_name', 'Last Name *') }}
                                        {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' =>
                                        'Enter Last Name', 'required' => true]) }}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('email', 'Email *') }}
                                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter
                                        Email', 'readonly' => 'readonly']) }}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('mobile_no', 'Mobile *') }}
                                        {{ Form::text('mobile_no', null, ['class' => 'form-control', 'placeholder' =>
                                        'Enter Mobile Number', 'required' => true]) }}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('company_id', 'Select Company *') }}
                                        {!! Form::select('company_id',
                                        Company::pluck('company_name','company_id')->all(),
                                        null,
                                        ['class' => 'form-control', 'placeholder' => 'Select Company', 'required' =>
                                        true]) !!}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('designation_id', 'Select designation *') }}
                                        {!! Form::select('designation_id',
                                        Designation::pluck('designation_name','designation_id')->all(),
                                        null,
                                        ['class' => 'form-control', 'placeholder' => 'Select designation', 'required' =>
                                        true]) !!}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('location_id', 'Select Location *') }}
                                        {!! Form::select('location_id',
                                        Location::pluck('location_name','location_id')->all(),
                                        null,
                                        ['class' => 'form-control', 'placeholder' => 'Select Location', 'required' =>
                                        true]) !!}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('department', 'Department *') }}
                                        {!! Form::select('department',
                                        Department::pluck('name','department_id')->all(),
                                        null,
                                        ['class' => 'form-control', 'placeholder' => 'Select department', 'required' =>
                                        true]) !!}
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-start">
                                    {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1')) }}
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection