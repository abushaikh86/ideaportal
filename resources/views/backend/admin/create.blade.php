@extends('backend.layouts.app')
@section('title', 'Internal Users')
@php
use Spatie\Permission\Models\Role;
use App\Models\frontend\Department;
use App\Models\backend\Company;
use App\Models\backend\Designation;
use App\Models\backend\Location;
@endphp
@section('content')




<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">Add Internal User</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard')}}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.users')}}">Internal user</a>
                    </li>

                    <li class="breadcrumb-item active">add</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                <a class="btn btn-outline-primary" href="{{ route('admin.users') }}"><svg style="margin-right: 6px;font-size: 1.1em;" class="svg-inline--fa fa-angle-left" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"></path></svg>
                    Back
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
                        @php
                        $role = Role::get(['id','name'])->toArray();
                        @endphp
                        @include('backend.includes.errors')
                        {{ Form::open(array('url' => 'admin/user/store')) }}
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
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
                                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter  Email', 'required' => true]) }}
                                        {{-- Hidden PassWord field --}}
                                        {{ Form::hidden('password', 'Pass@123', ['class' => 'form-control',
                                        'placeholder' => 'Enter First Name', 'required' => true]) }}
                                        {{ Form::hidden('account_status', 1, ['class' => 'form-control', 'placeholder'
                                        => 'Enter First Name', 'required' => true]) }}
                                    </div>
                                </div>

                                {{-- input for role --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('role', 'Role *') }}
                                        <select name="role" id="role" class='form-control'>
                                            @foreach ($role as $index => $value )
                                            <option value="{{ $value['id'] }}"> {{ $value['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('mobile_no', 'Mobile No *') }}
                                        {{ Form::text('mobile_no', null, ['class' => 'form-control', 'placeholder' =>
                                        'Enter Mobile No', 'required' => true]) }}
                                    </div>
                                </div>

                                {{-- <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('last_name', 'Location *') }}
                                        {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' =>
                                        'Enter Location', 'required' => true]) }}
                                    </div>
                                </div> --}}
                                {{-- {{dd(Company::pluck('company_name','company_id')->all())}} --}}
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
                                        {{ Form::label('last_name', 'Department *') }}
                                        {!! Form::select('department',
                                        Department::pluck('name','department_id')->all(),
                                        null,
                                        ['class' => 'form-control', 'placeholder' => 'Select department', 'required' =>
                                        true]) !!}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('centralized_decentralized_type', 'Centralized/Decentralized Type *') }}

                                        {!! Form::select('centralized_decentralized_type',['1'=>'Centralized', '2'=> 'Decentralized'] ,
                                        null, ['class' => 'form-control','id'=>'centralized_decentralized_type_select','placeholder'=>'Select the type']) !!}
                                    </div>
                                </div>

                                {{-- <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('passowrd', 'Passowrd *') }}
                                        {{ Form::text('dob', null, ['class' => 'form-control', 'placeholder' => 'Enter
                                        date of birth', 'id'=>'dob' , 'required' => true]) }}
                                    </div>
                                </div> --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('password', 'Password *') }}
                                  
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter Password"  
                                            data-toggle="tooltip" data-placement="top"
                                            title="Password Must Contains Atleat 6 Character With One Special Character, Capital Letter And Digit" 
                                            required>
                                            <span style="color:red;font-size: 11px;"><b>Note: </b>Password Must Contains Atleat 6 Character With One Special Character, Capital Letter And Digit</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('password_confirmation', 'Confirm Password *') }}
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Enter Confirm Password" required>
                                    </div>
                                </div>
                                <div class="col-12 mt-1">
                                    {{ Form::submit('Create', array('class' => 'btn btn-primary mr-1 mb-1')) }}
                                    <button type="reset" class="btn btn-dark mr-1 mb-1">Reset</button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>

</section>

<script>
    $(document).ready(function() {
        $(function() {
            $("#dob").datepicker();
        });


    });



</script>

@endsection