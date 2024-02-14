<?php
use App\Models\frontend\Users;
use App\Models\backend\AdminUsers;
use App\Models\frontend\IdeaStatus;
use App\Models\frontend\Ideas;
?>
@php
$role = Auth::user()->role;
//dd($role);
@endphp
@extends('frontend.layouts.app')
@section('title', 'User Dashboard | View Idea')

@section('content')

{{-- Breadcrumb --}}
<section class="cs-breadcrumb">
    <div class="container-fluid">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <h1>View Idea Certificate</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Rewards and Recognition</li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Back" href="{{ route('rewards') }}">
                        <i style="margin-right:6px;font-size:1.1em;" class="fa fa-angle-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Content --}}
<section class="cs-content">
    <div class="container-fluid">
    @php
        $user = Users::where('user_id',$idea->user_id)->first();
        $idea_status = IdeaStatus::where('idea_id',$idea->idea_id)->where('idea_status','implemented')->first();
        $full_name = '';
        $idea_implemented_date = '';
        if(isset($idea_status)) {
        $idea_implemented_date_arr = explode(' ',$idea_status->created_at);
        $idea_implemented_date = $idea_implemented_date_arr[0];
        }
        if(isset($user)) {
        $full_name = $user->name.' '.$user->last_name;
        }
        @endphp
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="certificate_container" id="DivIdToPrint" style="position: relative;">
                            <img src="{{asset('public/frontend-assets/images/idea_certificate.jpg')}}" alt="Certificate Image" style="position:relative;z-index:1;width:100%">
                            <div class="content_container" style="position: absolute;top:66%;left:40%;z-index:2;transform:translate(-50%,-50%);text-align:center;height:40%;">
                                <p style="font-size:1.2em;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;color:rgb(17, 17, 17);text-align:center;margin-bottom:18px;" class="user_name">{{ $full_name }}</p>
                                <p style="position: relative;top: -10px;">Congratulations for getting your IDEA <b>({{$idea->title}}) </b> Implemented Successfully in our Esteemed Organization</p>
                                <p style="position: relative;top: -30px;">THANK YOU</p>
                                <p class="date" style="font-size:1em;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;color:rgb(17, 17, 17);margin-top:-40px">
                                    {{ $idea_implemented_date }}
                                </p>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type='button' class="btn btn-success mt-4" d='btn' value='Print' onclick='printFunc();'>
                        </div>
                    </div>
                    <div class="note text-center text-danger mt-3">To print the PDF properly select layout : landscape, paper size : A4, and Margins : none while printing</div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
