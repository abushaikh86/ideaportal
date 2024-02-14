@extends('backend.layouts.app')
@section('title', 'Edit Department')
@php
use Spatie\Permission\Models\Role;
@endphp
@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">Edit Department</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard')}}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.users')}}">DEPARTMENT MANAGEMENT</a>
                    </li>

                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                <a class="btn btn-outline-primary" href="{{ url()->previous() }}">
                <i class="fa-solid fa-angle-left text-light"></i>&nbsp;&nbsp;  Back
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
                        {!! Form::model($department, [
                        'method' => 'POST',
                        'url' => ['admin/updateDepartment'],
                        'class' => 'form'
                        ]) !!}
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('department', 'Department *') }}
                                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Department Name', 'required' => true]) }}
                                        {{ Form::hidden('department_id', $department->department_id, ['class' =>
                                        'form-control']) }}

                                    </div>
                                </div>
                            </div>
                            <div class="col md-12" style="padding-left:0px !important;">
                                {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1 mb-1')) }}
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
