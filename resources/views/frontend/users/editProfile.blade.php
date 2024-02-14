@php
use App\Models\frontend\Department;
@endphp
@extends('frontend.layouts.app')
@section('title', 'User Dashboard | Edit Profile')

@section('content')

{{-- Breadcrumb --}}
<section class="cs-breadcrumb">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('user.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Edit Profile</li>
        </ol>
    </div>
</section>

{{-- Content --}}
<section class="cs-content">
    <div class="container-fluid">
        <div id="basic-datatable">
            <div class="card">
                <div class="card-header">
                    <h1>Edit Profile</h1>
                    <a class="btn btn-outline-primary" href="{{ route('ideas.index') }}">
                        <i class="fa fa-angle-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($userdata, [
                    'method' => 'POST',
                    'url' => ['/user/updateProfile'],
                    'class' => 'form'
                    ]) !!}
                    @csrf
                    <div class="row g-4 mb-4">
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-0">
                                {{ Form::label('first_name', 'First Name *') }}
                                {{ Form::hidden('user_id', $userdata->user_id, ['class' =>
                                'form-control']) }}
                                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' =>
                                'Enter First Name', 'required' => true]) }}
                            </div>
                        </div>
    
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-0">
                                {{ Form::label('last_name', 'Last Name *') }}
                                {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder'
                                =>
                                'Enter Last Name', 'required' => true]) }}
                            </div>
                        </div>
    
    
                        <div class="col-md-6 col-12">
                            <div class="form-label-group">
                                {{ Form::label('email', 'Email *') }}
                                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' =>
                                'Enter
                                Email', 'required' => true, 'readonly'=>true]) }}
    
                            </div>
                        </div>
    
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-0">
                                {{ Form::label('mobile_no', 'Mobile No. *') }}
                                {{ Form::text('mobile_no', null, ['class' => 'form-control', 'placeholder'
                                =>
                                'Enter Last Name', 'required' => true]) }}
                            </div>
                        </div>
    
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-0">
                                {{ Form::label('department', 'Department *') }}
                                {!! Form::select('department',
                                $department,
                                null,
                                ['class' => 'form-select', 'placeholder' => 'Select department', 'required'
                                => true]) !!}
                            </div>
                        </div>
    
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-0">
                                {{ Form::label('company_id', 'Company *') }}
                                {!! Form::select('company_id', $company,
                                null,
                                ['class' => 'form-select', 'placeholder' => 'Select Company', 'required' =>
                                true]) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-0">
                                {{ Form::label('designation_id', 'Designation *') }}
                                {!! Form::select('designation_id',
                                $designation,
                                null,
                                ['class' => 'form-select', 'placeholder' => 'Select Designation',
                                'required' => true]) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-0">
                                {{ Form::label('location', 'Location *') }}
                                {!! Form::select('location',
                                $location,
                                null,
                                ['class' => 'form-select', 'placeholder' => 'Select Location', 'required'
                                => true]) !!}
                            </div>
                        </div>
                    </div>
                    {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                    <button type="reset" class="btn btn-secondary mr-1 mb-1">Reset</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>


@endsection