<?php

use App\Models\frontend\Users;
use App\Models\backend\AdminUsers;
use App\Models\frontend\IdeaStatus;
use App\Models\frontend\IdeaImages;
use App\Models\Rolesexternal;
$ALL_VIDEO_EXTENSIONS = ['flv','webm','avchd','mkv','3gpp','mpeg','mpeg-4','mts','hevc','ogg','proress','mp4'];
?>
@php
$role = Auth::user()->role;
$show_mode = 0;

$status_buttons = [];

$roles_external = Rolesexternal::where(['id'=>Auth::user()->sub_role])->first();
if(!empty($roles_external)){
    $status_buttons = explode(',',$roles_external->status_values);
}
$idea_status = IdeaStatus::where('idea_id',$idea->idea_id)->get();
@endphp
@extends('frontend.layouts.app')
@section('title', 'User Dashboard | View Idea')

@section('content')

{{-- Breadcrumb --}}
<section class="cs-breadcrumb">
    <div class="container-fluid">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <h1>View Idea</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">View Idea</li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Back" @if ( URL::previous() != '') href="{{ URL::previous() }}" @else href="{{ route('myideas.index') }}" @endif>
                        <i style="margin-right:6px;font-size:1.1em;" class="fa fa-angle-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Timeline Modal -->
<div class="modal fade timeline-modal show" id="statusTimelineModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="statusTimelineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-times"></i>
            </button>
            <div class="modal-body">
                <h6 class="heading mb-4" id="statusTimelineModalLabel">Status Timeline</h1>
                    <ul class="time-line">
                        {{--  <li class="item">
                            <p>
                                <span class=" d-block mb-3">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum incidunt
                                    corporis at aperiam error accusamus corrupti praesentium hic veniam fugiat fuga
                                    asperiores itaque, illo ullam similique, minus odit quae laboriosam alias dolorum
                                    repellat! Porro ratione molestias reprehenderit reiciendis nobis distinctio esse
                                    praesentium odit, a soluta perferendis quia ducimus. Quibusdam, nostrum.
                                </span>
                                Idea has been approved by <b>naresh dhumal <i class="text-assessment">(Assessment
                                        Team)</i></span>
                                    <i>on 2023-12-05 at 12:51:35</i>
                            </p>
                        </li>  --}}

                        @foreach ($idea_status as $is)

                            @if ($is->idea_status == 'rejected')
                                @if (isset($is['user_id']))
                                    @php
                                        $user_name = Users::where('user_id', $is['user_id'])->first();
                                        $date = explode(' ', $is['created_at']);
                                    @endphp
                                    <li class="item">
                                        <p>Idea has been rejected by
                                            <span>
                                                @if (isset($user_name['name']))
                                                    {{ $user_name['name'] }}
                                                    {{ $user_name['last_name'] }}
                                                @endif


                                                @if (isset($is->user_role))
                                                    &#40;
                                                    <i class="text-assessment">{{ $is->user_role }}</i>
                                                    &#41;
                                                @endif
                                            </span>

                                            <i> on {{ $date[0] }} at
                                                {{ $date[1] }}</i>
                                        </p>
                                    </li>
                                    @if (isset($is['user_id']))
                                        @php

                                            $user_name = Users::where('user_id', $is['user_id'])->first();
                                            $date = explode(' ', $is['created_at']);
                                        @endphp
                                        <li class="item">
                                            <p>Idea send for Revision by
                                                <span>
                                                    @if (isset($user_name['name']))
                                                        {{ $user_name['name'] }}
                                                        {{ $user_name['last_name'] }}
                                                    @endif


                                                    @if (isset($is->user_role))
                                                        &#40;
                                                        <i class="text-assessment">{{ $is->user_role }}</i>
                                                        &#41;
                                                    @endif
                                                </span>

                                                <i> on {{ $date[0] }} at
                                                    {{ $date[1] }}</i>
                                            </p>
                                        </li>

                                        {{-- resubmit --}}
                                    @endif
                                @endif
                            @elseif($is->idea_status == 'assessment_team_approved')
                                @if (isset($is['user_id']))
                                    @php
                                        $user_name = Users::where('user_id', $is['user_id'])->first();
                                        $date = explode(' ', $is['created_at']);
                                    @endphp
                                    <li class="item">
                                        <p>
                                            {{--  Idea has been submitted for the approval by  --}}
                                            Idea has been approved by
                                            <span>
                                                @if (isset($user_name['name']))
                                                    {{ $user_name['name'] }}
                                                    {{ $user_name['last_name'] }}
                                                @endif


                                                @if (isset($is->user_role))
                                                    &#40;
                                                    <i class="text-assessment">{{ $is->user_role }}</i>
                                                    &#41;
                                                @endif
                                            </span>

                                            <i> on {{ $date[0] }} at
                                                {{ $date[1] }}</i>
                                        </p>
                                    </li>
                                @endif
                            @elseif($is->idea_status == 'approving_authority_approved')
                                @if (isset($is['user_id']))
                                    @php
                                        $user_name = Users::where('user_id', $is['user_id'])->first();
                                        $date = explode(' ', $is['created_at']);
                                    @endphp
                                    <li class="item">
                                        <p>Idea has been approved by
                                            <span>
                                                @if (isset($user_name['name']))
                                                    {{ $user_name['name'] }}
                                                    {{ $user_name['last_name'] }}
                                                @endif


                                                @if (isset($is->user_role))
                                                    &#40;
                                                    <i class="text-assessment">{{ $is->user_role }}</i>
                                                    &#41;
                                                @endif
                                            </span>

                                            <i> on {{ $date[0] }} at
                                                {{ $date[1] }}</i>
                                        </p>
                                    </li>
                                @endif
                            @elseif($is->idea_status == 'implemented')
                                @if (isset($is['user_id']))
                                    @php
                                        $user_name = Users::where('user_id', $is['user_id'])->first();
                                        $date = explode(' ', $is['created_at']);
                                    @endphp
                                    <li class="item">
                                        <p>Idea has been Implemented by
                                            <span>
                                                @if (isset($user_name['name']))
                                                    {{ $user_name['name'] }}
                                                    {{ $user_name['last_name'] }}
                                                @endif


                                                @if (isset($is->user_role))
                                                    &#40;
                                                    <i class="text-assessment">{{ $is->user_role }}</i>
                                                    &#41;
                                                @endif
                                            </span>

                                            <i> on {{ $date[0] }} at
                                                {{ $date[1] }}</i>
                                        </p>
                                    </li>
                                @endif
                                {{--  for onhold  --}}
                            @elseif($is->idea_status == 'on_hold')
                                @if (isset($is['user_id']))
                                    @php
                                        $user_name = Users::where('user_id', $is['user_id'])->first();
                                        $date = explode(' ', $is['created_at']);
                                    @endphp
                                    <li class="item">
                                        <p>Idea Kept On Hold by
                                            <span>
                                                @if (isset($user_name['name']))
                                                    {{ $user_name['name'] }}
                                                    {{ $user_name['last_name'] }}
                                                @endif


                                                @if (isset($is->user_role))
                                                    &#40;
                                                    <i class="text-assessment">{{ $is->user_role }}</i>
                                                    &#41;
                                                @endif
                                            </span>

                                            <i> on {{ $date[0] }} at
                                                {{ $date[1] }}</i>
                                        </p>
                                    </li>


                                    {{-- onhold end --}}
                                @endif
                                {{-- reSubmit --}}
                            @elseif($is->idea_status == 'resubmit')
                            @endif

                        @endforeach
                    </ul>
            </div>
        </div>
    </div>
</div>

{{-- Content --}}
<section class="cs-content">
    <div class="container-fluid">
        <div id="basic-datatable">
            <div class="card">
                @php
                $image_path = $idea['image_path'];
                $full_image_path = 'storage/app/public/'.$image_path;
                $extArr = explode('.',$image_path);
                $ext = end($extArr);
                @endphp
                <div class="card-body">
                    @php
                    $user = Users::where('user_id',$idea->user_id)->first();
                    if(isset($idea['created_at'])){
                    $created_at_arr = explode(' ',$idea['created_at']);
                    $created_at ='| Submitted on : '.$created_at_arr[0];
                    } else {
                    $created_at ='';
                    }
                    @endphp
                    <div class="row">
                        <div class="col-md-5 col-12">
                            <div class="position-sticky top-0">
                                <div id="idea_title">
                                    <h2 class="mb-3 heading">
                                        <strong>{{ $idea->title }} </strong>
                                    </h2>
                                    <h3 class="mb-2">Idea Number: {{ $idea->idea_id }}</h3>
                                    <h5>
                                        <b>
                                            Author : <span class="text-primary text-capitalize">{{ $user['name'] }} {{ $user['last_name'] }}</span>
                                            <span>{{ $created_at }}</span>
                                        </b>
                                    </h5>
                                </div>

                                <!-- New Status Card -->
                                <div class="card status-card mt-4">
                                    <div class="card-header">
                                        @php $status = ''; @endphp
                                        @if($idea->active_status == 'implementation')
                                     @php $status = 'implementation';  @endphp
                                        @elseif($idea->active_status == 'under_approving_authority')
                                        @php $status = 'under approving authority';  @endphp
                                        @elseif($idea->active_status == 'pending')
                                        @php $status = 'pending' ; @endphp
                                        @elseif($idea->active_status == 'on_hold')
                                        @php $status = 'on hold';  @endphp
                                        @elseif($idea->active_status == 'in_assessment')
                                        @php $status = 'in assessment';  @endphp
                                        @elseif($idea->active_status == 'reject')
                                        //Status : Rejected {{('(Reason : '.$idea['reject_reason'].')')}}
                                        @php $status = 'reject';  @endphp
                                        @elseif($idea->active_status == 'implemented')
                                        @php $status = 'implemented';  @endphp

                                        @endif
                                        <h5>Status</h5>
                                        <!-- <i class="pending">Pending</i> -->
                                        <!-- <i class="assessment">In Assessment</i> -->
                                        <!-- <i class="approved">Approved</i> -->
                                        <i class="{{ strtolower($status) }}">{{ $status }}</i>
                                    </div>
                                    <div class="card-body">
                                        <ul class="time-line">
                                            {{--  <li class="item">
                                                <p>
                                                    Idea has been approved by <span>naresh dhumal <i class="text-assessment">(Assessment Team)</i></span>
                                                    <i>on 2023-12-05 at 12:51:35</i>
                                                </p>
                                            </li>  --}}
                                            @php

                                                    $last_status = count($idea_status) - 1;
                                                    if ($last_status <= 0) {
                                                        $last_status = 0;
                                                    }
                                                @endphp
                                                {{--  <ul class="timeline">  --}}
                                                @foreach ($idea_status as $is)
                                                    @if ($loop->index == 0 || $loop->index == $last_status)
                                                        @if ($is->idea_status == 'rejected')
                                                            @if (isset($is['user_id']))
                                                                @php
                                                                    $user_name = Users::where('user_id', $is['user_id'])->first();
                                                                    $date = explode(' ', $is['created_at']);
                                                                @endphp
                                                                <li class="item">
                                                                    <p>Idea has been rejected by
                                                                        <span>
                                                                            @if (isset($user_name['name']))
                                                                                {{ $user_name['name'] }}
                                                                                {{ $user_name['last_name'] }}
                                                                            @endif


                                                                            @if (isset($is->user_role))
                                                                                &#40;
                                                                                <i
                                                                                    class="text-assessment">{{ $is->user_role }}</i>
                                                                                &#41;
                                                                            @endif
                                                                        </span>

                                                                        <i> on {{ $date[0] }} at
                                                                            {{ $date[1] }}</i>
                                                                    </p>
                                                                </li>
                                                                @if (isset($is['user_id']))
                                                                    @php

                                                                        $user_name = Users::where('user_id', $is['user_id'])->first();
                                                                        $date = explode(' ', $is['created_at']);
                                                                    @endphp
                                                                    <li class="item">
                                                                        <p>Idea send for Revision by
                                                                            <span>
                                                                                @if (isset($user_name['name']))
                                                                                    {{ $user_name['name'] }}
                                                                                    {{ $user_name['last_name'] }}
                                                                                @endif


                                                                                @if (isset($is->user_role))
                                                                                    &#40;
                                                                                    <i
                                                                                        class="text-assessment">{{ $is->user_role }}</i>
                                                                                    &#41;
                                                                                @endif
                                                                            </span>

                                                                            <i> on {{ $date[0] }} at
                                                                                {{ $date[1] }}</i>
                                                                        </p>
                                                                    </li>

                                                                    {{-- resubmit --}}
                                                                @endif
                                                            @endif
                                                        @elseif($is->idea_status == 'assessment_team_approved')
                                                            @if (isset($is['user_id']))
                                                                @php
                                                                    $user_name = Users::where('user_id', $is['user_id'])->first();
                                                                    $date = explode(' ', $is['created_at']);
                                                                @endphp
                                                                <li class="item">
                                                                    <p>
                                                                        {{--  Idea has been submitted for the approval by  --}}
                                                                        Idea has been approved by
                                                                        <span>
                                                                            @if (isset($user_name['name']))
                                                                                {{ $user_name['name'] }}
                                                                                {{ $user_name['last_name'] }}
                                                                            @endif


                                                                            @if (isset($is->user_role))
                                                                                &#40;
                                                                                <i
                                                                                    class="text-assessment">{{ $is->user_role }}</i>
                                                                                &#41;
                                                                            @endif
                                                                        </span>

                                                                        <i> on {{ $date[0] }} at
                                                                            {{ $date[1] }}</i>
                                                                    </p>
                                                                </li>
                                                            @endif
                                                        @elseif($is->idea_status == 'approving_authority_approved')
                                                            @if (isset($is['user_id']))
                                                                @php
                                                                    $user_name = Users::where('user_id', $is['user_id'])->first();
                                                                    $date = explode(' ', $is['created_at']);
                                                                @endphp
                                                                <li class="item">
                                                                    <p>Idea has been approved by
                                                                        <span>
                                                                            @if (isset($user_name['name']))
                                                                                {{ $user_name['name'] }}
                                                                                {{ $user_name['last_name'] }}
                                                                            @endif


                                                                            @if (isset($is->user_role))
                                                                                &#40;
                                                                                <i
                                                                                    class="text-assessment">{{ $is->user_role }}</i>
                                                                                &#41;
                                                                            @endif
                                                                        </span>

                                                                        <i> on {{ $date[0] }} at
                                                                            {{ $date[1] }}</i>
                                                                    </p>
                                                                </li>
                                                            @endif
                                                        @elseif($is->idea_status == 'implemented')
                                                            @if (isset($is['user_id']))
                                                                @php
                                                                    $user_name = Users::where('user_id', $is['user_id'])->first();
                                                                    $date = explode(' ', $is['created_at']);
                                                                @endphp
                                                                <li class="item">
                                                                    <p>Idea has been Implemented by
                                                                        <span>
                                                                            @if (isset($user_name['name']))
                                                                                {{ $user_name['name'] }}
                                                                                {{ $user_name['last_name'] }}
                                                                            @endif


                                                                            @if (isset($is->user_role))
                                                                                &#40;
                                                                                <i
                                                                                    class="text-assessment">{{ $is->user_role }}</i>
                                                                                &#41;
                                                                            @endif
                                                                        </span>

                                                                        <i> on {{ $date[0] }} at
                                                                            {{ $date[1] }}</i>
                                                                    </p>
                                                                </li>
                                                            @endif
                                                            {{--  for onhold  --}}
                                                        @elseif($is->idea_status == 'on_hold')
                                                            @if (isset($is['user_id']))
                                                                @php
                                                                    $user_name = Users::where('user_id', $is['user_id'])->first();
                                                                    $date = explode(' ', $is['created_at']);
                                                                @endphp
                                                                <li class="item">
                                                                    <p>Idea Kept On Hold by
                                                                        <span>
                                                                            @if (isset($user_name['name']))
                                                                                {{ $user_name['name'] }}
                                                                                {{ $user_name['last_name'] }}
                                                                            @endif


                                                                            @if (isset($is->user_role))
                                                                                &#40;
                                                                                <i
                                                                                    class="text-assessment">{{ $is->user_role }}</i>
                                                                                &#41;
                                                                            @endif
                                                                        </span>

                                                                        <i> on {{ $date[0] }} at
                                                                            {{ $date[1] }}</i>
                                                                    </p>
                                                                </li>


                                                                {{-- onhold end --}}
                                                            @endif
                                                            {{-- reSubmit --}}
                                                        @elseif($is->idea_status == 'resubmit')
                                                        @endif
                                                    @endif
                                                @endforeach
                                            {{--  <li class="item">
                                                <p>
                                                    Idea has been approved by <span>naresh dhumal <i class="text-assessment">(Assessment Team)</i></span>
                                                    <i>on 2023-12-05 at 12:51:35</i>
                                                </p>
                                            </li>  --}}
                                        </ul>
                                    </div>
                                </div>
                                <!-- New Status Card -->

                                <div class="bg-back d-none">
                                    <div class="status-heading">
                                        <h4 class="mb-4"><strong>Status</strong></h4>
                                    </div>
                                    <div id="idea_status">

                                        {{-- {{Form::open(['method'=>'POST',
                                        'route'=>['ideas.updateIdeaStatus'],
                                        'class'=>'form']) }}
                                        @csrf
                                        <div class="idea-status-box mb-2">
                                            <select class="form-control me-2" id="idea_status" name="idea_status">
                                                @foreach($idea_active_status as $key => $status_option)
                                                <option {{$idea['active_status']==$key?'selected':''}}
                                                    {{$key=='under_approving_authority' ? 'disabled' :'' }} value="{{$key}}">
                                                    {{$status_option}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" value="{{$role}}" name="role"> --}}
                                            {{-- {{$idea->idea_id}} --}}
                                            {{-- <input type="hidden" value="{{$idea->idea_id}}" name="idea_id">

                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to change the Idea Status?\nYou will not be able to change the Idea Status again!')"
                                                class="btn btn-primary">Submit</button>
                                        </div>
                                        {{Form::close()}} --}}

                                    </div>

                                    <ul class="timeline">
                                        @php
                                        //  $idea_status = IdeaStatus::where('idea_id',$idea->idea_id)->get();
                                        // dump($idea_status);
                                        @endphp
                                        @foreach ($idea_status as $is)
                                        @if($is->idea_status == 'rejected')
                                        @php
                                        if(isset($is['user_id'])) {
                                        $user_name = Users::where('user_id',$is['user_id'])->first();
                                        $date = explode(' ',$is['created_at']);
                                        @endphp
                                        <li>
                                            <p>Idea has been rejected by
                                                <strong>{{$user_name['name']}}
                                                    {{$user_name['last_name']}}</strong>
                                                    <br> @if (isset($is->user_role))
                                                    &#40;
                                                    {{ $is->user_role }}
                                                    &#41;
                                                    @endif
                                                    on <strong> {{$date[0]}}</strong> at
                                                <strong>{{$date[1]}}</strong>
                                            </p>
                                        </li>
                                        @php
                                        }
                                        @endphp
                                        @elseif($is->idea_status == 'assessment_team_approved')

                                        @php
                                        if(isset($is['user_id'])) {
                                        $user_name = Users::where('user_id',$is['user_id'])->first();
                                        $date = explode(' ',$is['created_at']);
                                        @endphp
                                        <li>
                                            <p>Idea has been approved by
                                                <strong>{{$user_name['name']}}
                                                    {{$user_name['last_name']}}</strong>
                                                    <br> @if (isset($is->user_role))
                                                    &#40;
                                                    {{ $is->user_role }}
                                                    &#41;
                                                    @endif
                                                    on <strong> {{$date[0]}}</strong> at
                                                <strong>{{$date[1]}}</strong>
                                            </p>
                                        </li>
                                        @php
                                        }
                                        @endphp
                                        @elseif($is->idea_status== 'approving_authority_approved')
                                        @php
                                        if(isset($is['user_id'])) {
                                        $user_name = Users::where('user_id',$is['user_id'])->first();
                                        $date = explode(' ',$is['created_at']);
                                        @endphp
                                        <li>
                                            <p>Idea has been approved by
                                                <strong>{{$user_name['name']}}
                                                    {{$user_name['last_name']}}</strong>
                                                    <br>  @if (isset($is->user_role))
                                                    &#40;
                                                    {{ $is->user_role }}
                                                    &#41;
                                                    @endif
                                                    on <strong> {{$date[0]}}</strong> at
                                                <strong>{{$date[1]}}</strong>
                                            </p>
                                        </li>
                                        @php
                                        }
                                        @endphp
                                        @elseif($is->idea_status== 'implemented')
                                        @php
                                        if(isset($is['user_id'])) {
                                        $user_name = Users::where('user_id',$is['user_id'])->first();
                                        $date = explode(' ',$is['created_at']);
                                        @endphp
                                        <li>
                                            <p>Idea has been Implemented by
                                                <strong>{{$user_name['name']}}
                                                    {{$user_name['last_name']}}</strong>
                                                    <br>
                                                    @if (isset($is->user_role))
                                                &#40;
                                                {{ $is->user_role }}
                                                &#41;
                                                @endif
                                                    on <strong> {{$date[0]}}</strong> at
                                                <strong>{{$date[1]}}</strong>
                                            </p>
                                        </li>
                                        @php
                                        }
                                        @endphp



                                        {{--  for onhold  --}}
                                        @elseif($is->idea_status== 'on_hold')
                                        @php
                                        if(isset($is['user_id'])) {
                                        $user_name = Users::where('user_id',$is['user_id'])->first();
                                        $date = explode(' ',$is['created_at']);
                                        @endphp
                                        <li>
                                            <p>Idea Kept On Hold  by {{ isset($is->role_name)?$is->role_name:'' }}
                                                <strong>
                                                    @if (isset($user_name['name']))
                                                    {{$user_name['name']}}
                                                    {{$user_name['last_name']}}
                                                    @endif
                                                </strong> @if (isset($is->user_role))
                                                &#40;
                                                {{ $is->user_role }}
                                                &#41;
                                                @endif
                                                    <br> on <strong> {{$date[0]}}</strong> at
                                                <strong>{{$date[1]}}</strong>
                                            </p>
                                        </li>
                                        @php
                                        }
                                        @endphp

                                        {{-- onhold end --}}

                                        {{-- reSubmit --}}
                                        @elseif($is->idea_status== 'resubmit')
                                        @php

                                        if(isset($is['user_id'])) {
                                        $user_name = Users::where('user_id',$is['user_id'])->first();
                                        $date = explode(' ',$is['created_at']);
                                        @endphp
                                        <li>
                                            <p>Idea send for Revision by {{ isset($is->role_name)?$is->role_name:'' }}
                                                <strong>
                                                    @if (isset($user_name['name']))
                                                    {{$user_name['name']}}
                                                    {{$user_name['last_name']}}
                                                    @endif
                                                </strong> @if (isset($is->user_role))
                                                &#40;
                                                {{ $is->user_role }}
                                                &#41;
                                                @endif
                                                    <br> on <strong> {{$date[0]}}</strong> at
                                                <strong>{{$date[1]}}</strong>
                                            </p>
                                        </li>
                                        @php
                                        }
                                        @endphp
                                        {{-- resubmit --}}


                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7 col-12">
                            <div class="list">
                                <div class="item">
                                    <div class="heading">
                                        <h5>Idea Description</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3">
                                            {{ (isset($idea->desription)?$idea->desription:null) }}
                                        </p>


                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>Outcome of Idea</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3">{{ isset($idea->idea_outcome) ? $idea->idea_outcome : '' }}</p>

                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>Describe why the idea should to be implemented/What makes your idea unique?</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3">{{ isset($idea->why_implemented) ? $idea->why_implemented : '' }}</p>

                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>The idea presented has no risks or challenges to the Business</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3">{{ isset($idea->challeges) ? $idea->challeges : '' }}</p>

                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>This idea is new and not implemented anywhere in JMB Group</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3">{{ isset($idea->already_implemented_or_no) ? $idea->already_implemented_or_no : '' }}</p>

                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>This idea has no other alternative</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3">{{ isset($idea->alternatives) ? $idea->alternatives : '' }}</p>

                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>Is the cost of implementing the idea is less than the benefit</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3">{{ isset($idea->cost_and_benifits) ? $idea->cost_and_benifits : '' }}</p>

                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>Benefits of Implementing the Idea1</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3">{{ isset($idea->benifits) ? $idea->benifits : '' }}</p>

                                    </div>
                                </div>

                                @if (strtolower($roles_external->role_type) == 'assessment team')
                                    <div class="item">
                                        <div class="heading">
                                            <h5>Remarks</h5>
                                        </div>

                                    </div>
                                @endif
                            </div>

                            @if (isset($disabled) && $disabled != 'disabled')
                                <button class="btn btn-primary mt-3" id="update_details_assesment">Update Details</button>
                            @endif

                            @php
                            $idea_uni_id = $idea->idea_uni_id;
                            $idea_images = IdeaImages::where(['is_supporting' => 0, 'idea_uni_id' => $idea_uni_id])
                                ->whereNotNull('idea_uni_id')
                                ->get();

                            @endphp

                            @if (count($idea_images) > 0)
                            <div class="full-img-boxin">
                                <h3 class="heading mb-3">Attachment</h3>
                                <div class="row">
                                    @foreach ($idea_images as $idea_image)
                                        @php
                                            $fileNameParts = explode('.', $idea_image->file_name);
                                            $ext = end($fileNameParts);
                                            // dd($ext);
                                            $img_path = '';
                                            $label_text = '';
                                            $file_path = asset('storage/app/public/' . $idea_image->image_path);
                                            if ($ext == 'doc') {
                                                $label_text = 'Download DOC';
                                                $img_path = asset('storage/app/public/uploads/asset/doc.png');
                                            } elseif ($ext == 'pdf') {
                                                $label_text = 'View PDF';
                                                $img_path = asset('storage/app/public/uploads/asset/pdf.png');
                                            }
                                            elseif(in_array(strtolower($ext),$ALL_VIDEO_EXTENSIONS )){
                                                $label_text = 'View Video';
                                                $img_path = asset('storage/app/public/uploads/'. $idea_image->image_path);
                                            }
                                            else {
                                                $label_text = 'View Image';
                                                $img_path = asset('storage/app/public/' . $idea_image->image_path);
                                            }
                                        @endphp
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <a style="margin-top:10px;"
                                                class="card card-body shadow {{ $ext == 'pdf' || $ext == 'doc' || $ext == 'docx' ? '' : 'test-popup-link' }}"
                                                href="{{ $file_path }}" target="_blank">

                                                @if(in_array(strtolower($ext),$ALL_VIDEO_EXTENSIONS ))
                                                <video style="width:100%;height:50px; object-fit:contain" controls>
                                                    <source src="{{ $img_path }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>

                                                <a class="card card-body mt-1" style='border:none !important'
                                                href="{{ $file_path }}" target="_blank">Download</a>

                                                @else
                                                <img style="width:100%;height:100px; object-fit:contain"
                                                    src="{{ $img_path }}"
                                                    alt="{{ $image_path == 'null' ? 'Image not available' : 'Idea Image' }} ">
                                                <p class="h5 text-center mt-2">{{ $label_text }}</p>
                                                @endif
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            {{-- supproting attachements --}}
                            @if(is_null($show_mode))
                            @if ($role != 'User')
                            <div class="form_container chat-form" style="position: relative;">
                                <form method="POST" action="{{ route('ideas.storeSupportingdocs') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row align-items-end">
                                        <div class="col-lg-8">
                                            <div class="dropzone-container">
                                                <label for="files">Upload your Supproting Attachments here</label>
                                                <div class="drop-zone mb-0">
                                                    <input type="file" class="form-control image-file" multiple="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="hidden" name="idea_id" value="{{ $idea->idea_id }}">
                                            <button type="submit" class="btn btn-secondary" id="submit">Upload</button>
                                        </div>
                                    </div>

                                    <div id="selected-images" class="mt-4 row g-2 idea_imgaes_container">
                                    </div>

                                </form>

                                <fieldset style="border-color: #12c712;display:none;padding:2.3em;margin:1em 0px;">
                                    <legend style="font-size:1.3em">Preview</legend>
                                    <div id="selected-images" class="row g-2">
                                    </div>
                                </fieldset>
                                @php
                                    $images = IdeaImages::where(['is_supporting' => 1, 'idea_uni_id' => $idea->idea_uni_id])->get();
                                    // dd($images);
                                @endphp
                                @if (count($images) > 0)
                                    <div>
                                        <h5 class="sub-heading mb-3">Uploaded Files</h5>
                                        <div id="uploaded_images" class="row g-3">
                                            @foreach ($images as $image)
                                                @php
                                                    // dd($image);
                                                    $img_path = '';
                                                    $label_text = '';
                                                    $file_path = asset('storage/app/public/' . $image->image_path);
                                                    $fileNameParts = explode('.', $image->file_name);
                                                    $ext = end($fileNameParts);
                                                    // dd($ext);
                                                    if ($ext == 'doc' || $ext == 'docx' || $ext == 'xlsx' || $ext == 'txt') {
                                                        $img_path = asset('storage/app/public/uploads/asset/doc.png');
                                                    } elseif ($ext == 'pdf') {
                                                        $img_path = asset('storage/app/public/uploads/asset/pdf.png');
                                                    } elseif ($ext === 'mp4' || $ext === 'mov' || $ext === 'avi') {
                                                        $img_path = asset('storage/app/public/uploads/asset/vid.png');
                                                    } else {
                                                        $img_path = asset('storage/app/public/' . $image->image_path);
                                                    }
                                                @endphp
                                                <div class="col-lg-4 col-md-4 col-sm-6">
                                                    <div class="card border-0 shadow">
                                                        <img class="card-img-top" src="{{ $img_path }}" alt="Card image cap">
                                                        <div class="card-body">
                                                            <p class="card-text mb-2">{{ $image->file_name }}</p>
                                                            <a href="{{ route('ideas.delete_image', ['id' => $image->image_id]) }}" class="btn btn-sm btn-danger cross-image remove" onclick="return confirm('Are you sure you want to delete this File')">Remove</a>
                                                            @if ($ext == 'doc' || $ext == 'pdf' || $ext == 'docx' || $ext == 'xlsx' || $ext == 'txt')
                                                                <a href="{{ $file_path }}" class="btn btn-sm btn-primary {{ $ext == 'pdf' || $ext == 'doc' || $ext == 'xlsx' || $ext == 'txt' || $ext == 'docx' ? '' : 'test-popup-link' }}" target="_blank">View</a>
                                                            @elseif($ext === 'mp4' || $ext === 'mov' || $ext === 'avi')
                                                                <a href="{{ $file_path }}" class="btn btn-sm btn-primary {{ $ext === 'mp4' || $ext === 'mov' || $ext === 'avi' ? '' : 'test-popup-link' }}" target="_blank">View</a>
                                                            @else
                                                                <a href="{{ $img_path }}" class="btn btn-sm btn-primary test-popup-link">View</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div>
                                        <h2 class=" mt-4">Supporting attachments not uploaded yet</h2>
                                    </div>
                                @endif
                                    </div>
                            </div>
                            @endif
                            @endif

                            {{-- Files --}}
                            @php
                            $idea_uni_id = $idea->idea_uni_id;
                            $idea_images = IdeaImages::where('idea_uni_id',$idea_uni_id)->whereNotNull('idea_uni_id')->get();
                            @endphp
                            @if(count($idea_images) > 0)

                            @endif

                            {{-- Implemented the Idea button --}}
                            @if($idea->active_status == 'implementation')
                                @if($idea->implemented == 0)
                                <div class="d-flex justify-content-end mt-3">
                                    @if(in_array('implemented',$status_buttons))
                                    <button type="button" title="click here to change the status of the idea to Implemented" class="btn btn-success" data-toggle="modal" data-target="#implementationModal">Idea Successfully Implemented</button>
                                    @endif
                                </div>
                                @endif
                            @endif

                            {{-- Generate Certificate code --}}
                            @if($idea->implemented == 1 && $idea->active_status == 'implemented')
                                @if($idea->certificate != 1)
                                <div class="d-flex justify-content-end mt-3">
                                    @if(in_array('certificate',$status_buttons))
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveForCertificateModal">Generate Certificate</button>
                                    @endif
                                </div>
                                @else
                                <div class="d-flex flex-column align-items-end mt-3">
                                    <p>Certificate has already been Generated</p>
                                    <a class="btn btn-primary" href="{{ route('rewards.view',['id'=>$idea->idea_id]) }}">View Certificate</a>
                                </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Idea Discussion --}}
            <div class="card mt-4">
                <div class="card-body">
                    <h3 class="heading mb-4">Idea Discussion</h3>
                    <div class="chat-section">
                        @if(count($feedback) > 0)
                        @foreach($feedback as $fb)
                        @php
                        $flag_c = '';
                        $class_idea_discussion = 'idea-discussion-box-right';
                        $style = 'flex-direction:row-reverse';
                        $style2 = 'align-items:flex-end';
                        $style3 = '';
                        if($fb['user_role'] == 'admin') {
                        $flag_c = 'true';
                        $user = AdminUsers::where('admin_user_id',$fb['user_id'])->first();
                        } else {
                        $flag_c = 'false';
                        $user = Users::where('user_id',$fb['user_id'])->first();
                        }
                        @endphp
                        @if(Auth::id() == $fb['user_id'] && $fb['user_role'] !== 'admin')
                        @php
                        $flag_c = 'false';
                        $class_idea_discussion = 'idea-discussion-box';
                        $style = '';
                        $style2 = '';
                        @endphp
                        @endif
                        <div class="users-img mb-3"
                            style="display:flex !important;justify-content: flex-start;align-items:center; {{$style}}">
                            {{-- <i class="fa fa-user" aria-hidden="true">
                            </i> --}}
                            <div class="{{$class_idea_discussion}}"
                                style="display:flex;flex-direction:column;justify-content:space-between;{{$style2}}">
                                <h4>
                                    <strong>
                                        {{ $flag_c == 'true' ? $user['first_name']:$user['name'] }} {{ $user['last_name'] }}
                                    </strong>
                                     
                                    <em>&#40; {{$fb['user_role']}} &#41;</em>
                                </h4>

                                @if($fb['media_file'])
                                @php
                                    $url = url('/').'/storage/app/public/'.$fb['media_file'];
                                    $fileExtension = pathinfo($fb['media_file'], PATHINFO_EXTENSION);

                                @endphp
                                <a href="{{$url}}" target="_blank">

                                @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{$url}}" alt="Click To View" width="80px" height="80px">
                                @elseif(in_array($fileExtension, ['mp4', 'avi', 'mov', 'wmv']))
                                    <i class="fa fa-file-video-o" aria-hidden="true"  style="font-size: 40px;"></i>
                                @elseif(in_array($fileExtension, ['pdf', 'doc', 'docx']))
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"  style="font-size: 40px;"></i>
                                @else
                                    <i class="fa fa-file" aria-hidden="true"  style="font-size: 40px;"></i>
                                @endif
                                </a>
                                @endif


                                <p class="feedback-text">{{ $fb['feedback'] }}</p>
                                <p lass="datein">{{ $fb['created_at'] }}</p>
                            </div>

                        </div>
                        @endforeach
                        @else
                        {{-- {{dd('hello')}} --}}
                        <div>
                            <h4>No Discussion yet</h4>
                        </div>
                        @endif
                    </div>

                    <div class="form_container chat-form" style="position: relative;">
                        <form method="POST" action="{{ route('ideas.storeFeedback') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- File preview container -->
                            <div id="file-preview" style="top: -150px; right: 0; max-width: 20%; max-height: 10%; overflow: hidden;  padding: 5px; border-radius: 5px;">
                                <div id="preview-content" style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%;"></div>
                            </div>

                            <div class="users-img feedback_container" style="display: flex; align-items: center;">

                                <div class="form-group" style="width: 100%; flex-grow: 1; margin-right: 10px;">
                                    <input type="text" name="feedback" class="form-control" id="feedback" placeholder="Enter your comments here..." />
                                </div>

                                <label for="file-input" style="cursor: pointer;position: relative;top: 4px;">
                                    <i class="fa fa-paperclip attachment" aria-hidden="true" style="font-size: 20px; margin-right: 10px;"></i>
                                </label>
                                <input id="file-input" type="file" name="attachment" style="display: none;">


                                <input type="hidden" name="idea_id" value="{{ $idea->idea_id }}">

                                <button type="submit" style="background: none; border: none; cursor: pointer;">
                                    <i class="fa fa-paper-plane" aria-hidden="true" style="font-size: 20px;"></i>
                                </button>
                            </div>
                        </form>

                        <script>
                            document.getElementById('file-input').addEventListener('change', function (event) {
                                const fileInput = event.target;
                                const filePreview = document.getElementById('preview-content');

                                if (fileInput.files && fileInput.files[0]) {
                                    const file = fileInput.files[0];
                                    const fileType = file.type.split('/')[0];

                                    const reader = new FileReader();

                                    reader.onload = function (e) {
                                        if (fileType === 'image') {
                                            // For images, display image with name
                                            filePreview.innerHTML = `<img src="${e.target.result}" alt="File Preview" style="max-width: 100%; max-height: 70%; border-radius: 5px;">
                                                                    <p style="margin: 5px 0; font-size: 14px;">${file.name}</p>`;
                                        } else if (fileType === 'video') {
                                            // For videos, display video thumbnail with icon and name
                                            filePreview.innerHTML = `<i class="fa fa-file-video-o" aria-hidden="true" style="font-size: 40px; color: #ff6600;"></i>
                                                                    <p style="margin: 5px 0; font-size: 14px;">${file.name}</p>`;
                                        } else {
                                            // For other file types, display a generic icon with name
                                            filePreview.innerHTML = `<i class="fa fa-file" aria-hidden="true" style="font-size: 40px;"></i>
                                                                    <p style="margin: 5px 0; font-size: 14px;">${file.name}</p>`;
                                        }
                                    };

                                    reader.readAsDataURL(fileInput.files[0]);
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Not Needed -->
<!-- Modal -->
<div class="modal fade" id="implementationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Implemented</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Do you really want to change the Idea status to Implemented ?<br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{route('myideas.idea_implemented',['id'=>$idea->idea_id,'role'=>$role])}}"
                    class="btn btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="approveForCertificateModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generate Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to Generate Certificate for this Idea
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{route('myideas.approve_certificate',['id'=>$idea->idea_id])}}"
                    class="btn btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>
@endsection
