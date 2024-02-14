@extends('backend.layouts.app')
@section('title', 'Edit Internal User')
@php
use Spatie\Permission\Models\Role;
use App\Models\backend\Company;
use App\Models\frontend\Department;
use App\Models\backend\Designation;
use App\Models\backend\Location;
@endphp
@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">Edit Internal User</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.users') }}">INTERNAL USERsss</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                <a class="btn btn-outline-primary" href="{{ route('admin.users') }}"><svg style="margin-right: 6px;font-size: 1.1em;" class="svg-inline--fa fa-angle-left" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                        <path fill="currentColor" d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"></path>
                    </svg> Back
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
                        @include('backend.includes.errors')
                        {{-- {{ Form::open(['url' => 'admin/user/update']) }} --}}
                        {!! Form::model($userdata, [
                        'method' => 'POST',
                        'url' => ['admin/user/update'],
                        'class' => 'form'
                        ]) !!}
                        {{-- {{dd($userdata)}} --}}
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="forms-group">
                                        {{ Form::label('fullname', 'First Name *') }}
                                        {{ Form::hidden('admin_user_id', $userdata->admin_user_id, ['class' =>
                                        'form-control']) }}
                                        {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' =>
                                        'Enter First Name', 'required' => true]) }}
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('fullname', 'Last Name *') }}
                                        {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' =>
                                        'Enter Last Name', 'required' => true]) }}
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('email', 'Email *') }}
                                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter
                                        Email', 'required' => true]) }}

                                    </div>
                                </div>


                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('mobile_no', 'Mobile No *') }}
                                        {{ Form::text('mobile_no', null, ['class' => 'form-control', 'placeholder' =>
                                        'Enter Mobile No', 'required' => true]) }}

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
                                {{-- <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('last_name', 'Location *') }}
                                {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' =>
                                        'Enter Location', 'required' => true]) }}
                            </div>
                        </div> --}}

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
                            
                            @if (isset(Auth::user()->centralized_decentralized_type) && Auth::user()->centralized_decentralized_type ==1 )
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                {{ Form::label('centralized_decentralized_type', 'Centralized/Decentralized Type *') }}

                                {!! Form::select('centralized_decentralized_type',['1'=>'Centralized', '2'=> 'Decentralized'] ,
                                null, ['class' => 'form-control','id'=>'centralized_decentralized_type_select','placeholder'=>'Select the type']) !!}
                            </div>
                        </div>
                            @endif

                        <div class="col-md-12 center">
                            <br>
                            {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                            <button type="reset" class="btn btn-light mr-1 mb-1">Reset</button>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    </div>


    <div class="col-12">
        <div class="card" style="margin-top: 20px;">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    @include('backend.includes.errors')
                    {{-- {{ Form::open(['url' => 'admin/user/update']) }} --}}
                    {!! Form::model($userdata, [
                    'method' => 'POST',
                    'url' => ['admin/user/statusAndRole'],
                    'class' => 'form'
                    ]) !!}

                    @csrf
                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    {{ Form::label('fullname', 'Status *') }}
                                    {{ Form::hidden('email', null, ['class' => 'form-control', 'placeholder' => 'Enter
                                    Email', 'required' => true]) }}
                                    {{ Form::hidden('admin_user_id', $userdata->admin_user_id, ['class' =>
                                        'form-control']) }}
                                    {!! Form::select('account_status',['0'=>'Inactive', '1'=> 'Active'] ,
                                    $userdata->account_status, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            {{-- input for role --}}
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    {{-- {{dd($role_id)}} --}}
                                    {{ Form::label('role', 'Role *') }}
                                    {!! Form::select('role', $role, null, ['class' => 'form-control']) !!}
                                    
                                </div>
                            </div>   
                             <div class="col-md-6 col-12">
                                {{-- {{dd($cc_mail_data[0]->assign_cc)}} --}}
                                <div class="form-group">
                                    {{-- {{dd($role_id)}} --}}
                                    {{ Form::label('assign_cc', 'Assign As CC ') }}
                                    {!! Form::select('assign_cc',['0'=>'Inactive', '1'=> 'Active'] ,
                                    !empty($cc_mail_data[0]->assign_cc)?$cc_mail_data[0]->assign_cc:0, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-12">
                                <br>
                                {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                                <button type="reset" class="btn btn-light mr-1 mb-1">Reset</button>
                            </div>
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

</section>
@endsection
