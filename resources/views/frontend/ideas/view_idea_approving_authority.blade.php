<?php

use App\Models\frontend\Users;
use App\Models\backend\AdminUsers;
use App\Models\frontend\IdeaStatus;
use App\Models\frontend\Feedback;
use App\Models\frontend\IdeaImages;
use App\Models\Rolesexternal;

// usama_14-02-2024- available users to chat
$other_users = Feedback::where('idea_id', $idea->idea_id)
->orWhere('user_id', $idea->user_id)
->pluck('user_id')
->toArray();
$get_users = Users::whereIn('user_id', $other_users)->where('user_id', '!=', Auth::id())->get();

?>
@php
// $role = Auth::user()->role;
$roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
$role = $roles_external->role_type;
//dd($roles_external);
//dd($roles_external->role_type);

$idea_status = IdeaStatus::where('idea_id', $idea->idea_id)->get();

$last_status = count($idea_status) - 1;
if ($last_status <= 0) { $last_status=0; }
    $ALL_VIDEO_EXTENSIONS=['flv','webm','avchd','mkv','3gpp','mpeg','mpeg-4','mts','hevc','ogg','proress','mp4'];
    @endphp @extends('frontend.layouts.app') @section('title', 'User Dashboard | View Idea' ) @section('content') {{--
    Breadcrumb --}} <section class="cs-breadcrumb">
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
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Back"
                        @if(session()->has('main_page')) href="{{ session('main_page') }}" @else href="{{
                        route('ideas.index') }}"> @endif>
                        <i style="margin-right:6px;font-size:1.1em;" class="fa fa-angle-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
    </section>

    <!-- Timeline Modal -->
    <div class="modal fade timeline-modal show" id="statusTimelineModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="statusTimelineModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
                <div class="modal-body">
                    <h6 class="heading mb-4" id="statusTimelineModalLabel">Status Timeline</h1>
                        <ul class="time-line">
                            {{-- <li class="item">
                                <p>
                                    <span class=" d-block mb-3">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum incidunt
                                        corporis at aperiam error accusamus corrupti praesentium hic veniam fugiat fuga
                                        asperiores itaque, illo ullam similique, minus odit quae laboriosam alias
                                        dolorum
                                        repellat! Porro ratione molestias reprehenderit reiciendis nobis distinctio esse
                                        praesentium odit, a soluta perferendis quia ducimus. Quibusdam, nostrum.
                                    </span>
                                    Idea has been approved by <b>naresh dhumal <i class="text-assessment">(Assessment
                                            Team)</i></span>
                                        <i>on 2023-12-05 at 12:51:35</i>
                                </p>
                            </li> --}}

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
                                    {{-- Idea has been submitted for the approval by --}}
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
                            {{-- for onhold --}}
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
                    $full_image_path = 'storage/app/public/' . $image_path;
                    $extArr = explode('.', $image_path);
                    $ext = end($extArr);

                    $disabled = '';
                    if (isset($idea->approving_authority_approval) && $idea->approving_authority_approval == 1) {
                    $disabled = 'disabled';
                    }
                    @endphp
                    <div class="card-body">
                        @php
                        $user = Users::where('user_id', $idea->user_id)->first();
                        if (isset($idea['created_at'])) {
                        $created_at_arr = explode(' ', $idea['created_at']);
                        $created_at = '| Submitted on : ' . $created_at_arr[0];
                        } else {
                        $created_at = '';
                        }
                        @endphp
                        <div class="row g-4">
                            <div class="col-lg-5 col-12">
                                <div class="position-sticky top-0">
                                    <div id="idea_title">
                                        <h2 class="mb-3 heading">
                                            <strong>{{ $idea->title }} </strong>
                                        </h2>
                                        <h3 class="mb-2">Idea Number: {{ $idea->idea_id }}</h3>
                                        <h5>
                                            <b>
                                                Author : <span class="text-primary text-capitalize">{{ $user['name'] }}
                                                    {{ $user['last_name'] }}</span>
                                                <span>{{ $created_at }}</span>
                                            </b>
                                        </h5>
                                    </div>

                                    <!-- New Status Card -->
                                    <div class="card status-card mt-4">
                                        <div class="card-header">
                                            @php $status =''; @endphp
                                            @if ($idea->active_status == 'under_approving_authority')
                                            {{-- Status : Under Approval --}}
                                            @php
                                            $status = 'Under Approval';
                                            @endphp
                                            @elseif($idea->active_status == 'resubmit')
                                            @php
                                            $reason = $idea->resubmit_reason == null ? '' : '(Reason : ' .
                                            $idea->resubmit_reason . ')';
                                            @endphp
                                            {{-- Status : Revise Request {{ $reason }} --}}
                                            @php
                                            $status = 'Revise Request';
                                            @endphp
                                            @elseif($idea->active_status == 'reject')
                                            Status : Rejected {{ '(Reason : ' . $idea['reject_reason'] . ')' }}
                                            php
                                            $status = 'reject';
                                            @endphp
                                            @elseif($idea->approving_authority_approval == 1)
                                            @if ($idea->active_status == 'implementation')
                                            {{-- Status : Implementation --}}
                                            @php
                                            $status = 'Implementation';
                                            @endphp
                                            @elseif($idea->active_status == 'implemented')
                                            @php
                                            $status = 'implemented';
                                            @endphp
                                            @endif
                                            @else
                                            @php
                                            $status = 'Approved By Assessment Team';
                                            @endphp
                                            @endif
                                            <h5>Status</h5>
                                            <!-- <i class="pending">Pending</i> -->
                                            <!-- <i class="assessment">In Assessment</i> -->
                                            <!-- <i class="approved">Approved</i> -->
                                            <i class="{{ strtolower($status) }}">{{ $status }}</i>
                                        </div>
                                        <div class="card-body">
                                            <!-- Form -->
                                            <div id="idea_status">
                                                @if ($idea->active_status == 'under_approving_authority')
                                                Status : Under Approval
                                                @elseif($idea->active_status == 'resubmit')
                                                @php
                                                $reason = $idea->resubmit_reason == null ? '' : '(Reason : ' .
                                                $idea->resubmit_reason . ')';
                                                @endphp
                                                Status : Revise Request {{ $reason }}
                                                @elseif($idea->active_status == 'reject')
                                                Status : Rejected {{ '(Reason : ' . $idea['reject_reason'] . ')' }}
                                                @elseif($idea->approving_authority_approval == 1)
                                                @if ($idea->active_status == 'implementation')
                                                Status : Implementation
                                                @elseif($idea->active_status == 'implemented')
                                                Status : Implemented
                                                @endif
                                                @else

                                                @endif
                                            </div>

                                            <!-- Timeline -->
                                            <ul class="time-line mt-4">

                                                {{-- <ul class="timeline"> --}}
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
                                                            {{-- Idea has been submitted for the approval by --}}
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
                                                    {{-- for onhold --}}
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
                                                    @endif
                                                    @endforeach
                                                </ul>
                                        </div>
                                    </div>
                                    <!-- New Status Card -->

                                    @if(!in_array($idea->active_status,['under_approving_authority','resubmit','reject','implementation','implemented']))

                                    <div class="card status-card mt-4">
                                        <div class="card-header">
                                            <h5>Update Status</h5>
                                        </div>
                                        <div class="card-body">
                                            {{ Form::open(['method' => 'POST', 'route' => ['ideas.updateIdeaStatus'],
                                            'class' => 'form']) }}
                                            @csrf
                                            <div class="idea-status-box mb-2">
                                                <select class="form-select me-2" id="idea_status" name="idea_status">
                                                    <option selected="" disabled="" value="in_assessment">Under
                                                        Assessment</option>
                                                    @foreach ($idea_active_status as $key => $status_option)
                                                    @php
                                                    $reason = '';
                                                    if ($key == 'resubmit' && $idea['active_status'] == 'resubmit') {
                                                    $reason = $idea->resubmit_reason == '' ? '' : '(' .
                                                    $idea->resubmit_reason . ')';
                                                    } elseif ($key == 'reject' && $idea['active_status'] == 'reject') {
                                                    $reason = $idea->reject_reason == '' ? '' : '(' .
                                                    $idea->reject_reason . ')';
                                                    }
                                                    @endphp
                                                    <option {{ $idea['active_status']==$key ? 'selected' : '' }} {{
                                                        $key=='in_assessment' ? 'disabled' : '' }} value="{{ $key }}">{{
                                                        $status_option }} {{ $reason }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" value="{{ $roles_external->role_type }}"
                                                    name="role">
                                                {{-- {{$idea->idea_id}} --}}
                                                <input type="hidden" value="{{ $idea->idea_id }}" name="idea_id">
                                                <button type="submit" class="btn btn-primary"
                                                    onclick="return confirm('Are you sure you want to change the Idea Status?\nYou will not be able to change the Idea Status again!')">Submit</button>
                                            </div>
                                            <div id="content">
                                                <input type="text" id="reason_resubmit" name="resubmit_reason"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter you reason here">
                                                <input type="text" id="reason_reject" name="reject_reason"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter you reason here">
                                            </div>
                                            <div id="content">
                                                <input type="text" id="reason_sla" name="sla_reason"
                                                    class="form-control w-100 mb-1 mt-1"
                                                    placeholder="Enter you reason for SLA not meet"
                                                    @if(isset($idea->sla_reason_approver) &&
                                                !is_null($idea->sla_reason_approver))
                                                value="{{ $idea->sla_reason_approver }}"
                                                @endif
                                                >
                                            </div>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                    @endif


                                    {{-- <div class="d-flex justify-content-end mt-3"> --}}
                                        @if (in_array($idea->active_status, ['under_approving_authority']) ||
                                        isset($idea->approving_authority_approval) &&
                                        $idea->approving_authority_approval == 1)
                                        <div class="card status-card mt-4">
                                            <div class="card-header">
                                                <h5> Expense Details</h5>

                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('ideaApproveWithbudget') }}" method="post"
                                                    id='approveWithBudgetForm' class="row g-4">
                                                    @csrf
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-0">
                                                            <label for="">Expenses Estimation </label>
                                                            <input type="hidden" value="{{ $idea->idea_id }}"
                                                                name="idea_id" id="budgetForm_idea_id">
                                                            <input type="text" name="estimate_budget"
                                                                id="estimate_budget"
                                                                value="{{ (isset($idea->estimate_budget)?$idea->estimate_budget:0) }}"
                                                                class='form-control'
                                                                placeholder='Enter Estimate Amount'>
                                                            <span class="text-danger" id="error_estimate_budget"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group mb-0">
                                                            <label for="">Expenses Approved</label>
                                                            <input type="text" name="expenses_approved"
                                                                id="expenses_approved" class='form-control'
                                                                placeholder="Enter Approved Amount"
                                                                value="{{ (isset($idea->expenses_approved)?$idea->expenses_approved:'') }}">
                                                            <span class="text-danger"
                                                                id="error_expenses_approved"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group mb-0">
                                                            <label for=""> Expenses Incurred </label>
                                                            <input type="text" name="expenses_incurred"
                                                                id="expenses_incurred" class='form-control'
                                                                placeholder="Enter Incurred Amount"
                                                                value="{{ (isset($idea->expenses_incurred)?$idea->expenses_incurred:'') }}">
                                                            <span class="text-danger"
                                                                id="error_expenses_incurred"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group mb-0">
                                                            <label for=""> Expenses By Company Details </label>
                                                            {{ Form::select('expenses_approved_company',$company,
                                                            $idea->expenses_approved_company,
                                                            ['class'=>'form-select','id'=>'expenses_approved_company','Placeholder'=>'Expenses
                                                            By Company Details']) }}
                                                            <span class="text-danger"
                                                                id="error_expenses_approved_company"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group mb-0">
                                                            <label for=""> Expenses By SPOC Details </label>
                                                            <select name="spoc_details" id="spoc_details"
                                                                class='form-select'>
                                                                <option value="">Select</option>
                                                            </select>
                                                            <span class="text-danger" id="error_spoc_details"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col col-md-12 text-center">
                                                        @if ($idea->active_status == 'under_approving_authority')
                                                        @if ($idea->approving_authority_approval == 0)
                                                        <button type="button"
                                                            title="click here to change the status of the idea to Implemented"
                                                            class="btn btn-success" onclick="showConfirm_model()">
                                                            Submit for Implementation
                                                        </button>
                                                        @endif
                                                        @else
                                                        @if (isset($idea->approving_authority_approval) &&
                                                        $idea->approving_authority_approval == 1)
                                                        <button type="button"
                                                            title="click here to change the status of the idea to Implemented"
                                                            class="btn btn-success"
                                                            onclick="update_budget_details()">Update Expense
                                                            Details</button>
                                                        @endif
                                                        @endif
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endif




                                        {{--
                                    </div> --}}

                                    <div class="bg-back d-none">
                                        <div class="status-heading">
                                            <h4 class="mb-4"><strong>Status</strong></h4>
                                        </div>


                                        {{-- //set variable to find dwadline missed status --}}
                                        @php
                                        $deadline_missed = 0;
                                        $idea_status_last = IdeaStatus::where('idea_id',
                                        $idea->idea_id)->where('idea_status','assessment_team_approved')->orderBy('idea_status_id','desc')->first();
                                        // dd($idea_status_last->toArray());
                                        @endphp


                                        @if (strtolower($roles_external->role_type) == 'approving authority')
                                        {{-- @if ( $idea->active_status == 'pending') --}}
                                        @php $days = 0; @endphp
                                        @if(isset($sla->deadline_days))
                                        @php
                                        $days = $sla->deadline_days;
                                        @endphp
                                        @endif
                                        @if($days > 0 )
                                        @php
                                        $today = date('Y-m-d');
                                        $uploaded_on =
                                        (isset($idea_status_last->updated_at)?$idea_status_last->updated_at:date('Y-m-d'));
                                        $days_ago = date('Y-m-d', mktime(0, 0, 0, date("m",
                                        strtotime(str_replace('/','-',$idea_status_last->updated_at))) ,
                                        date("d",strtotime(str_replace('/','-',$idea_status_last->updated_at))) + $days,
                                        date("Y",strtotime(str_replace('/','-',$idea_status_last->updated_at)))));

                                        $diff = strtotime($today ) - strtotime($days_ago);
                                        $diff = $diff/86400;
                                        if($diff > 0){
                                        $deadline_missed = 1;
                                        }
                                        @endphp
                                        @endif
                                        {{-- @endif --}}
                                        @endif

                                        {{-- //set result in hidden field --}}
                                        <div class="_deadline_missed_form_div d-none">
                                            {{
                                            Form::hidden('deadline_status',$deadline_missed,['class'=>'form-control','id'=>'deadline_status'])
                                            }}
                                        </div>



                                        <ul class="timeline d-none">
                                            @php
                                            // $idea_status = IdeaStatus::where('idea_id', $idea->idea_id)->get();
                                            // dump($idea_status);
                                            @endphp
                                            @foreach ($idea_status as $is)
                                            @if ($is->idea_status == 'rejected')
                                            @if (isset($is['user_id']))
                                            @php
                                            $user_name = Users::where('user_id', $is['user_id'])->first();
                                            $date = explode(' ', $is['created_at']);
                                            @endphp
                                            <li>
                                                <p>Idea has been rejected by
                                                    <strong>{{ $user_name['name'] }}
                                                        {{ $user_name['last_name'] }}</strong>

                                                    @if (isset($is->user_role))
                                                    &#40;
                                                    {{ $is->user_role }}
                                                    &#41;
                                                    @endif
                                                    <br> on <strong> {{ $date[0] }}</strong> at
                                                    <strong>{{ $date[1] }}</strong>
                                                </p>
                                            </li>
                                            @endif
                                            @elseif($is->idea_status == 'assessment_team_approved')
                                            @if (isset($is['user_id']))
                                            @php
                                            $user_name = Users::where('user_id', $is['user_id'])->first();
                                            $date = explode(' ', $is['created_at']);
                                            @endphp
                                            <li>
                                                <p>Idea has been approved by
                                                    <strong>{{ $user_name['name'] }}
                                                        {{ $user_name['last_name'] }}</strong>
                                                    @if (isset($is->user_role))
                                                    &#40;
                                                    {{ $is->user_role }}
                                                    &#41;
                                                    @endif
                                                    <br>on <strong> {{ $date[0] }}</strong> at
                                                    <strong>{{ $date[1] }}</strong>
                                                </p>
                                            </li>
                                            @endif
                                            @elseif($is->idea_status == 'approving_authority_approved')
                                            @if (isset($is['user_id']))
                                            @php
                                            $user_name = Users::where('user_id', $is['user_id'])->first();
                                            $date = explode(' ', $is['created_at']);
                                            @endphp
                                            <li>
                                                <p>Idea has been approved by
                                                    <strong>{{ $user_name['name'] }}
                                                        {{ $user_name['last_name'] }}</strong>
                                                    <br>
                                                    @if (isset($is->user_role))
                                                    &#40;
                                                    {{ $is->user_role }}
                                                    &#41;
                                                    @endif
                                                    on <strong> {{ $date[0] }}</strong> at
                                                    <strong>{{ $date[1] }}</strong>
                                                </p>
                                            </li>
                                            @endif
                                            @elseif($is->idea_status == 'implemented')
                                            @if (isset($is['user_id']))
                                            @php
                                            $user_name = Users::where('user_id', $is['user_id'])->first();
                                            $date = explode(' ', $is['created_at']);
                                            @endphp
                                            <li>
                                                <p>Idea has been Implemented by
                                                    <strong>{{ $user_name['name'] }}
                                                        {{ $user_name['last_name'] }}</strong>
                                                    <br>
                                                    @if (isset($is->user_role))
                                                    &#40;
                                                    {{ $is->user_role }}
                                                    &#41;
                                                    @endif
                                                    on <strong> {{ $date[0] }}</strong> at
                                                    <strong>{{ $date[1] }}</strong>
                                                </p>
                                            </li>
                                            @endif

                                            {{-- for onhold --}}
                                            @elseif($is->idea_status == 'on_hold')
                                            @if (isset($is['user_id']))
                                            @php
                                            $user_name = Users::where('user_id', $is['user_id'])->first();
                                            $date = explode(' ', $is['created_at']);
                                            @endphp
                                            <li>
                                                <p>Idea Kept On Hold by {{ isset($is->role_name) ? $is->role_name : ''
                                                    }}
                                                    <strong>
                                                        @if (isset($user_name['name']))
                                                        {{ $user_name['name'] }}
                                                        {{ $user_name['last_name'] }}
                                                        @endif
                                                    </strong>
                                                    @if (isset($is->user_role))
                                                    &#40;
                                                    {{ $is->user_role }}
                                                    &#41;
                                                    @endif
                                                    <br> on <strong> {{ $date[0] }}</strong> at
                                                    <strong>{{ $date[1] }}</strong>
                                                </p>
                                            </li>
                                            @endif

                                            {{-- onhold end --}}

                                            {{-- reSubmit --}}
                                            @elseif($is->idea_status == 'resubmit')
                                            @if (isset($is['user_id']))
                                            @php

                                            $user_name = Users::where('user_id', $is['user_id'])->first();
                                            $date = explode(' ', $is['created_at']);
                                            @endphp
                                            <li>
                                                <p>Idea send for Revision by {{ isset($is->role_name) ? $is->role_name :
                                                    '' }}
                                                    <strong>
                                                        @if (isset($user_name['name']))
                                                        {{ $user_name['name'] }}
                                                        {{ $user_name['last_name'] }}
                                                        @endif
                                                    </strong>
                                                    @if (isset($is->user_role))
                                                    &#40;
                                                    {{ $is->user_role }}
                                                    &#41;
                                                    @endif
                                                    <br> on <strong> {{ $date[0] }}</strong> at
                                                    <strong>{{ $date[1] }}</strong>
                                                </p>
                                            </li>
                                            @endif
                                            {{-- resubmit --}}
                                            @endif
                                            @endforeach
                                            {{-- <li>
                                                <p>Idea has been submitted for the approval by <br /><strong>Eminem
                                                        Yadav</strong>
                                                    <br /><span> at 12:28:02</span>
                                                </p>
                                            </li>
                                            <li>
                                                <p>Idea has been submitted for the approval by <br /><strong>Eminem
                                                        Yadav</strong>
                                                    <br /><span>2022-11-17 at 12:28:02</span>
                                                </p>
                                            </li>
                                            <li>
                                                <p>Idea has been submitted for the approval by <br /><strong>Eminem
                                                        Yadav</strong>
                                                    <br /><span>2022-11-17 at 12:28:02</span>
                                                </p>
                                            </li> --}}
                                        </ul>

                                        {{-- approved by message ends --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-7 col-12">
                                {{-- Implemented the Idea button --}}
                                {{-- {{dd('ASFs')}} --}}


                                <hr class="my-4">

                                <div class="list">
                                    <div class="item">
                                        <div class="heading">
                                            <h5>Idea Description</h5>
                                        </div>
                                        {{-- {{dd($assessment_journey)}} --}}
                                        <div class="content">
                                            <p class="mb-3">{{ isset($idea->description) ? $idea->description : '' }}
                                            </p>
                                            {{-- Select box for assesment User --}}
                                            @if (isset($assessment_journey->idea_description))
                                            <p class="mb-3">Assessment User Response : <b class="text-primary">{{
                                                    $assessment_journey->idea_description }}</b></p>
                                            @endif

                                            {{-- Select Box for approving authority --}}
                                            @if (strtolower($roles_external->role_type) == 'approving authority')
                                            {{ Form::select('assessment_idea_clarity', ['yes' => 'Yes', 'no' => 'No'],
                                            isset($journey_approver->idea_description) ?
                                            $journey_approver->idea_description : null, ['class' => 'form-select
                                            d-none', 'rows' => '4', 'required' => true, 'id' =>
                                            'assessment_idea_clarity', 'placeholder' => 'Select Value']) }}
                                            @endif
                                            {{-- assesment User select box end --}}

                                            <div class="action-btn">
                                                <p>Was the idea description presented clearly?</p>
                                                <!-- Add active class to button for selection -->
                                                <button
                                                    class="like-btn {{ isset($journey_approver->idea_description) && $journey_approver->idea_description == 'like' ? 'active' : '' }}"
                                                    data-idea-id="{{ $idea->idea_id }}" data-user-id={{ $idea->user_id
                                                    }}
                                                    data-user-id={{ $idea->user_id }}
                                                    data-name='assessment_idea_clarity' data-btn-name='like'>
                                                    <i class="fa fa-thumbs-up"></i>
                                                </button>
                                                <button
                                                    class="dislike-btn {{ isset($journey_approver->idea_description) && $journey_approver->idea_description == 'dislike' ? 'active' : '' }}"
                                                    data-idea-id="{{ $idea->idea_id }}" data-user-id={{ $idea->user_id
                                                    }}
                                                    data-name='assessment_idea_clarity' data-btn-name='dislike'>
                                                    <i class="fa fa-thumbs-down"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <div class="heading">
                                            <h5>Outcome of Idea</h5>
                                        </div>
                                        <div class="content">
                                            <p class="mb-3">{{ isset($idea->idea_outcome) ? $idea->idea_outcome : '' }}
                                            </p>
                                            @if (isset($assessment_journey->outcome))
                                            <p class="mb-3">Assessment User Response : <b class="text-primary">{{
                                                    $assessment_journey->outcome }}</b></p>
                                            @endif

                                            {{-- Select box for Assesment User --}}
                                            @if (strtolower($roles_external->role_type) == 'approving authority')
                                            {{ Form::select('assessment_outcome', ['yes' => 'Yes', 'no' => 'No'],
                                            isset($journey_approver->outcome) ? $journey_approver->outcome : null,
                                            ['class' => 'form-select d-none', 'rows' => '4', 'required' => true, 'id' =>
                                            'assessment_outcome', 'placeholder' => 'Select Value']) }}
                                            @endif

                                            <div class="action-btn">
                                                <p>Was the outcome of the idea clear ?</p>
                                                <!-- Add active class to button for selection -->
                                                <button
                                                    class="like-btn {{ isset($journey_approver->outcome) && $journey_approver->outcome == 'like' ? 'active' : '' }}"
                                                    data-idea-id="{{ $idea->idea_id }}" data-user-id={{ $idea->user_id
                                                    }}
                                                    data-name='assessment_outcome'
                                                    data-btn-name='like'>
                                                    <i class="fa fa-thumbs-up"></i>
                                                </button>
                                                <button
                                                    class="dislike-btn {{ isset($journey_approver->outcome) && $journey_approver->outcome == 'dislike' ? 'active' : '' }}"
                                                    data-idea-id="{{ $idea->idea_id }}" data-user-id={{ $idea->user_id
                                                    }}
                                                    data-name='assessment_outcome'
                                                    data-btn-name='dislike'>
                                                    <i class="fa fa-thumbs-down"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <div class="heading">
                                            <h5>Describe why the idea should to be implemented/What makes your idea
                                                unique?</h5>
                                        </div>
                                        <div class="content">
                                            <p class="mb-3">{{ isset($idea->why_implemented) ? $idea->why_implemented :
                                                '' }}</p>

                                            @if (isset($assessment_journey->why_implemented))
                                            <p class="mb-3">Assessment User Response : <b class="text-primary">{{
                                                    $assessment_journey->why_implemented }}</b></p>
                                            @endif

                                            @if (strtolower($roles_external->role_type) == 'approving authority')
                                            {{ Form::select('assessment_why_implemented', ['yes' => 'Yes', 'no' =>
                                            'No'], isset($journey_approver->why_implemented) ?
                                            $journey_approver->why_implemented : null, ['class' => 'form-select d-none',
                                            'rows' => '4', 'required' => true, 'id' => 'assessment_why_implemented',
                                            'placeholder' => 'Select Value']) }}
                                            @endif

                                            <div class="action-btn">
                                                <p>Did you understand why the idea should be implemented and what makes
                                                    it unique?</p>
                                                <!-- Add active class to button for selection -->
                                                <button
                                                    class="like-btn {{ isset($journey_approver->why_implemented) && $journey_approver->why_implemented == 'like' ? 'active' : '' }}"
                                                    data-idea-id="{{ $idea->idea_id }}" data-user-id={{ $idea->user_id
                                                    }}
                                                    data-name='assessment_why_implemented' data-btn-name='like'>
                                                    <i class="fa fa-thumbs-up"></i>
                                                </button>
                                                <button
                                                    class="dislike-btn {{ isset($journey_approver->why_implemented) && $journey_approver->why_implemented == 'dislike' ? 'active' : '' }}"
                                                    data-idea-id="{{ $idea->idea_id }}" data-user-id={{ $idea->user_id
                                                    }}
                                                    data-name='assessment_why_implemented' data-btn-name='dislike'>
                                                    <i class="fa fa-thumbs-down"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <div class="heading">
                                            <h5>The idea presented has no risks or challenges to the Business</h5>
                                        </div>
                                        <div class="content">
                                            <p class="mb-3">{{ isset($idea->challeges) ? $idea->challeges : '' }}</p>

                                            @if (isset($assessment_journey->challenges))
                                            <p class="mb-3">Assessment User Response : <b class="text-primary">{{
                                                    $assessment_journey->challenges }}</b></p>
                                            @endif

                                            @if (strtolower($roles_external->role_type) == 'approving authority')
                                            {{ Form::select('assessment_challenges', ['yes' => 'Yes', 'no' => 'No'],
                                            isset($journey_approver->challenges) ? $journey_approver->challenges : null,
                                            ['class' => 'form-select d-none', 'rows' => '4', 'required' => true, 'id' =>
                                            'assessment_challenges', 'placeholder' => 'Select Value']) }}
                                            @endif

                                            <div class="action-btn">
                                                <p>Are there any risks or challenges to the business that were not
                                                    addressed in the presented idea?</p>
                                                <!-- Add active class to button for selection -->
                                                <button
                                                    class="like-btn {{ isset($journey_approver->challenges) && $journey_approver->challenges == 'like' ? 'active' : '' }}"
                                                    data-idea-id="{{ $idea->idea_id }}" data-user-id={{ $idea->user_id
                                                    }}
                                                    data-name='assessment_challenges' data-btn-name='like'>
                                                    <i class="fa fa-thumbs-up"></i>
                                                </button>
                                                <button
                                                    class="dislike-btn {{ isset($journey_approver->challenges) && $journey_approver->challenges == 'dislike' ? 'active' : '' }}"
                                                    data-idea-id="{{ $idea->idea_id }}" data-user-id={{ $idea->user_id
                                                    }}
                                                    data-name='assessment_challenges' data-btn-name='dislike'>
                                                    <i class="fa fa-thumbs-down"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <div class="heading">
                                            <h5>This idea has no other alternative</h5>
                                        </div>
                                        <div class="content">
                                            <p class="mb-3">{{ isset($idea->alternatives) ? $idea->alternatives : '' }}
                                            </p>

                                            @if (isset($assessment_journey->has_alternatives))
                                            <p class="mb-3">
                                                Assessment User Response : <b class="text-primary">{{
                                                    $assessment_journey->has_alternatives }}</b>
                                            </p>
                                            @endif

                                            @if (strtolower($roles_external->role_type) == 'approving authority')
                                            {{ Form::select('assessment_has_alternatives', ['yes' => 'Yes', 'no' =>
                                            'No'], isset($journey_approver->has_alternatives) ?
                                            $journey_approver->has_alternatives : null, ['class' => 'form-select
                                            d-none', 'rows' => '4', 'required' => true, 'id' =>
                                            'assessment_has_alternatives', 'placeholder' => 'Select Value']) }}
                                            @endif

                                            <div class="action-btn">
                                                <p>Was the idea description presented clearly?</p>
                                                <!-- Add active class to button for selection -->
                                                <button
                                                    class="like-btn {{ isset($journey_approver->has_alternatives) && $journey_approver->has_alternatives == 'like' ? 'active' : '' }}"
                                                    data-idea-id="{{ $idea->idea_id }}" data-user-id={{ $idea->user_id
                                                    }}
                                                    data-name='assessment_has_alternatives' data-btn-name='like'>
                                                    <i class="fa fa-thumbs-up"></i>
                                                </button>
                                                <button
                                                    class="dislike-btn {{ isset($journey_approver->has_alternatives) && $journey_approver->has_alternatives == 'dislike' ? 'active' : '' }}"
                                                    data-idea-id="{{ $idea->idea_id }}" data-user-id={{ $idea->user_id
                                                    }}
                                                    data-name='assessment_has_alternatives' data-btn-name='dislike'>
                                                    <i class="fa fa-thumbs-down"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <div class="heading">
                                            <h5>Is the cost of implementing the idea is less than the benefit</h5>
                                        </div>
                                        <div class="content">
                                            <p class="mb-3">{{ isset($idea->cost_and_benifits) ?
                                                $idea->cost_and_benifits : '' }}</p>

                                            {{-- {{ dd($assessment_journey->toArray()) }} --}}
                                            @if (isset($assessment_journey->has_less_benifits))
                                            <p class="mb-3">
                                                Assessment User Response : <b class="text-primary">{{
                                                    $assessment_journey->has_less_benifits }}</b>
                                            </p>
                                            @endif

                                            @if (strtolower($roles_external->role_type) == 'approving authority')
                                            {{ Form::select('assessment_has_less_benifits', ['yes' => 'Yes', 'no' =>
                                            'No'], isset($journey_approver->has_less_benifits) ?
                                            $journey_approver->has_less_benifits : null, ['class' => 'form-select
                                            d-none', 'rows' => '4', 'required' => true, 'id' =>
                                            'assessment_has_less_benifits', 'placeholder' => 'Select Value']) }}
                                            @endif
                                            {{-- assesment block end --}}

                                            <div class="action-btn">
                                                <p>Was the idea description presented clearly?</p>
                                                <!-- Add active class to button for selection -->
                                                <button
                                                    class="like-btn {{ isset($journey_approver->has_less_benifits) && $journey_approver->has_less_benifits == 'like' ? 'active' : '' }}"
                                                    data-idea-id="{{ $idea->idea_id }}" data-user-id={{ $idea->user_id
                                                    }}
                                                    data-name='assessment_has_less_benifits' data-btn-name='like'>
                                                    <i class="fa fa-thumbs-up"></i>
                                                </button>
                                                <button
                                                    class="dislike-btn {{ isset($journey_approver->has_less_benifits) && $journey_approver->has_less_benifits == 'dislike' ? 'active' : '' }}"
                                                    data-idea-id="{{ $idea->idea_id }}" data-user-id={{ $idea->user_id
                                                    }}
                                                    data-name='assessment_has_less_benifits' data-btn-name='dislike'>
                                                    <i class="fa fa-thumbs-down"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <div class="heading">
                                            <h5>Benefits of Implementing the Idea</h5>
                                        </div>
                                        <div class="content">
                                            <p class="mb-3">{{ isset($idea->benifits) ? $idea->benifits : '' }}</p>

                                            {{-- {{ dd($assessment_journey->toArray()) }} --}}
                                            @if (isset($assessment_journey->benifits))
                                            <p class="mb-3">
                                                Assessment User Response : <b class="text-primary">{{
                                                    $assessment_journey->benifits }}</b>
                                            </p>
                                            @endif

                                            @if (strtolower($roles_external->role_type) == 'approving authority')
                                            {{ Form::select('benifits', ['yes' => 'Yes', 'no' => 'No'],
                                            isset($journey_approver->benifits) ? $journey_approver->benifits : null,
                                            ['class' => 'form-select d-none', 'rows' => '4', 'required' => true, 'id' =>
                                            'benifits', 'placeholder' => 'Select Value']) }}
                                            @endif
                                            {{-- assesment block end --}}

                                            <div class="action-btn">
                                                <p>Was the idea description presented clearly?</p>
                                                <!-- Add active class to button for selection -->
                                                <button
                                                    class="like-btn {{ isset($journey_approver->benifits) && $journey_approver->benifits == 'like' ? 'active' : '' }}"
                                                    data-idea-id="{{ $idea->idea_id }}" data-user-id={{ $idea->user_id
                                                    }}
                                                    data-name='benifits'
                                                    data-btn-name='like'>
                                                    <i class="fa fa-thumbs-up"></i>
                                                </button>
                                                <button
                                                    class="dislike-btn {{ isset($journey_approver->benifits) && $journey_approver->benifits == 'dislike' ? 'active' : '' }}"
                                                    data-idea-id="{{ $idea->idea_id }}" data-user-id={{ $idea->user_id
                                                    }}
                                                    data-name='benifits'
                                                    data-btn-name='dislike'>
                                                    <i class="fa fa-thumbs-down"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    @if (strtolower($roles_external->role_type) == 'approving authority')
                                    <div class="item">
                                        <div class="heading">
                                            <h5>Remarks</h5>
                                        </div>
                                        <div class="content">
                                            @if (isset($assessment_journey->remarks) &&
                                            !is_null($assessment_journey->remarks))
                                            <p class="mb-3">Assessment User Response {{ $assessment_journey->remarks }}
                                            </p>
                                            @endif

                                            {{
                                            Form::text('remarks',(isset($journey_approver->remarks)?$journey_approver->remarks:null),
                                            ['class'=>'form-control','id'=>'remarks','placeholder'=>'Enter Remarks']) }}
                                        </div>
                                    </div>
                                    @endif

                                    <div class="item">
                                        <div class="heading">
                                            <h5>Idea Description</h5>
                                        </div>
                                        <div class="content">
                                            <p class="mb-3">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam magni
                                                voluptates iure quo, dolores rem beatae corporis aliquam soluta
                                                inventore in doloremque expedita? Sed amet praesentium ipsa modi
                                                blanditiis dolores, adipisci quia libero soluta, voluptatibus quasi
                                                provident vitae, tenetur totam? Tempora quo modi a rerum possimus
                                                corporis similique maxime doloremque.
                                            </p>

                                            <div class="action-btn">
                                                <p>Was the idea description presented clearly?</p>
                                                <!-- Add active class to button for selection -->

                                                <button
                                                    class="like-btn {{ isset($journey_approver->idea_description) && $journey_approver->idea_description == 'like' ? 'active' : '' }}"
                                                    data-idea-id="{{ $idea->idea_id }}" data-user-id={{ $idea->user_id
                                                    }}
                                                    data-user-id={{ $idea->user_id }}
                                                    data-name='assessment_idea_clarity' data-btn-name='like'>
                                                    <i class="fa fa-thumbs-up"></i>
                                                </button>
                                                <button
                                                    class="dislike-btn {{ isset($journey_approver->idea_description) && $journey_approver->idea_description == 'dislike' ? 'active' : '' }}"
                                                    data-idea-id="{{ $idea->idea_id }}" data-user-id={{ $idea->user_id
                                                    }}
                                                    data-name='assessment_idea_clarity' data-btn-name='dislike'>
                                                    <i class="fa fa-thumbs-down"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    @if (isset($disabled) && $disabled != 'disabled')
                                    <buitton class="btn btn-primary" id="update_details_assesment">Update Details
                                    </buitton>
                                    @endif

                                    {{-- Files --}}
                                    @php
                                    $idea_uni_id = $idea->idea_uni_id;
                                    $idea_images = IdeaImages::where(['is_supporting' => 0, 'idea_uni_id' =>
                                    $idea_uni_id])
                                    ->whereNotNull('idea_uni_id')
                                    ->get();
                                    @endphp
                                    @if (count($idea_images) > 0)
                                    <div class="full-img-boxin">
                                        <h3 class="attachment-heading mb-3">Attachment</h3>
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
                                            } else {
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
                                    @if ($role != 'User')
                                    <div class="form_container chat-form" style="position: relative;">
                                        <form method="POST" action="{{ route('ideas.storeSupportingdocs') }}"
                                            enctype="multipart/form-data" class="row align-items-end">
                                            @csrf
                                            <div class="col-lg-6">
                                                <div class="dropzone-container">
                                                    <label for="files">Upload your Supproting Attachments here</label>
                                                    <div class="drop-zone mb-0">
                                                        <input type="file" class="form-control image-file" multiple="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="hidden" name="idea_id" value="{{ $idea->idea_id }}"
                                                    id='idea_id'>
                                                <button type="submit" class="btn btn-secondary"
                                                    id="submit">Upload</button>
                                            </div>
                                        </form>

                                        <div id="selected-images" class="mt-2 row g-2 idea_imgaes_container">
                                        </div>

                                        <fieldset
                                            style="border-color: #12c712;display:none;padding:2.3em;margin:1em 0px;">
                                            <legend style="font-size:1.3em">Preview</legend>
                                            <div id="selected-images" class="row g-2">
                                            </div>
                                        </fieldset>

                                        @php
                                        $images = IdeaImages::where(['is_supporting' => 1, 'idea_uni_id' =>
                                        $idea->idea_uni_id])->get();
                                        // dd($images);
                                        @endphp
                                        @if (count($images) > 0)
                                        <div style="border:none;">
                                            <legend style="font-size:1.3em">Uploaded Files</legend>
                                            <hr>
                                            <div id="uploaded_images" class="row g-2">
                                                @foreach ($images as $image)
                                                @php
                                                // dd($image);
                                                $img_path = '';
                                                $label_text = '';
                                                $file_path = asset('storage/app/public/' . $image->image_path);
                                                $fileNameParts = explode('.', $image->file_name);
                                                $ext = end($fileNameParts);
                                                // dd($ext);
                                                if ($ext == 'doc' || $ext == 'docx' || $ext == 'xlsx' || $ext == 'txt')
                                                {
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
                                                        <div
                                                            style="width:100%;height:150px;overflow:hidden;padding:15px 0px;">
                                                            <img class="card-img-top" src="{{ $img_path }}"
                                                                alt="Card image cap"
                                                                style="width:100%;height:100%;object-position:center;object-fit:contain">
                                                        </div>
                                                        <div class="card-body">
                                                            <p style="text-overflow: ellipsis;overflow: hidden;width: 100%;white-space: nowrap;"
                                                                class="card-text">{{ $image->file_name }}</p>
                                                            <a href="{{ route('ideas.delete_image', ['id' => $image->image_id]) }}"
                                                                class="btn btn-sm btn-danger cross-image
                                                                                    remove"
                                                                style="margin:5px 8px 5px 0px;"
                                                                onclick="return confirm('Are you sure you want to delete this File')">Remove</a>
                                                            @if ($ext == 'doc' || $ext == 'pdf' || $ext == 'docx' ||
                                                            $ext == 'xlsx' || $ext == 'txt')
                                                            <a style="margin:5px 5px 5px 0px;" href="{{ $file_path }}"
                                                                class="btn btn-sm btn-primary {{ $ext == 'pdf' || $ext == 'doc' || $ext == 'xlsx' || $ext == 'txt' || $ext == 'docx' ? '' : 'test-popup-link' }}"
                                                                target="_blank">View</a>
                                                            @elseif($ext === 'mp4' || $ext === 'mov' || $ext === 'avi')
                                                            <a style="margin:5px 5px 5px 0px;" href="{{ $file_path }}"
                                                                class="btn btn-sm btn-primary {{ $ext === 'mp4' || $ext === 'mov' || $ext === 'avi' ? '' : 'test-popup-link' }}"
                                                                target="_blank">View</a>
                                                            @else
                                                            <a style="margin:5px 5px 5px 0px;" href="{{ $img_path }}"
                                                                class="btn btn-sm btn-primary test-popup-link">View</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @else
                                        <h2 class=" mt-4">Supporting attachments not uploaded yet</h2>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Idea Descussion --}}
                {{-- if not user available for chat then dont show this section --}}
                @if(!$get_users->isEmpty())
                <div class="card mt-4">

                    {{-- chat body section --}}
                    <div class="card-body">
                        <h3 class="heading mb-4">Idea Discussion</h3>
                        {{-- populate chats dynamically --}}
                        <div class="chat-section">
                        </div>
                    </div>


                    {{-- form section to submit chat --}}
                    <div class="form_container chat-form">
                        <form method="POST" action="{{ route('ideas.storeFeedback') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="col-md-3">
                                    <select name="receiver_id" id="receiver_id" class="form-control" required>
                                        <option value="">Select User To Chat With</option>
                                        @if ($get_users)
                                        @foreach ($get_users as $row)
                                        @if(request('receiver_id') && request('receiver_id') == $row->user_id)
                                        <option value="{{ request('receiver_id') }}" selected>
                                            {{ $row->name . ' ' . $row->last_name }}
                                        </option>
                                        @else
                                        <option value="{{ $row->user_id }}">
                                            {{ $row->name . ' ' . $row->last_name }}
                                        </option>
                                        @endif
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <!-- File preview container -->
                            <div id="file-preview"
                                style="top: -150px; right: 0; max-width: 20%; max-height: 10%; overflow: hidden;  padding: 5px; border-radius: 5px;">
                                <div id="preview-content"
                                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%;">
                                </div>
                            </div>

                            <div class="users-img feedback_container" style="display: flex; align-items: center;">

                                <div class="form-group" style="width: 100%; flex-grow: 1; margin-right: 10px;">
                                    <input type="text" name="feedback" class="form-control" id="feedback"
                                        placeholder="Enter your comments here..." />
                                </div>

                                <label for="file-input" style="cursor: pointer;position: relative;top: 4px;">
                                    <i class="fa fa-paperclip attachment" aria-hidden="true"
                                        style="font-size: 20px; margin-right: 10px;"></i>
                                </label>
                                <input id="file-input" type="file" name="attachment" style="display: none;">

                                <input type="hidden" name="idea_id" value="{{ $idea->idea_id }}">

                                <button type="submit" style="background: none; border: none; cursor: pointer;">
                                    <i class="fa fa-paper-plane" aria-hidden="true" style="font-size: 20px;"></i>
                                </button>
                            </div>
                        </form>

                        <script>
                            document.getElementById('file-input').addEventListener('change', function(event) {
                            const fileInput = event.target;
                            const filePreview = document.getElementById('preview-content');

                            if (fileInput.files && fileInput.files[0]) {
                                const file = fileInput.files[0];
                                const fileType = file.type.split('/')[0];

                                const reader = new FileReader();

                                reader.onload = function(e) {
                                    if (fileType === 'image') {
                                        // For images, display image with name
                                        filePreview.innerHTML =
                                            `<img src="${e.target.result}" alt="File Preview" style="max-width: 100%; max-height: 70%; border-radius: 5px;">
                                                                <p style="margin: 5px 0; font-size: 14px;">${file.name}</p>`;
                                    } else if (fileType === 'video') {
                                        // For videos, display video thumbnail with icon and name
                                        filePreview.innerHTML =
                                            `<i class="fa fa-file-video-o" aria-hidden="true" style="font-size: 40px; color: #ff6600;"></i>
                                                                <p style="margin: 5px 0; font-size: 14px;">${file.name}</p>`;
                                    } else {
                                        // For other file types, display a generic icon with name
                                        filePreview.innerHTML =
                                            `<i class="fa fa-file" aria-hidden="true" style="font-size: 40px;"></i>
                                                                <p style="margin: 5px 0; font-size: 14px;">${file.name}</p>`;
                                    }
                                };

                                reader.readAsDataURL(fileInput.files[0]);
                            }
                        });
                        </script>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="app_by_app_auth" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Approve Idea</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to Approve the Idea ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button onclick="Submit_budget_form()" class='btn btn-primary'> Yes </button>
                    {{-- <a
                        href="{{ route('ideas.approveIdeaBAA', ['id' => $idea->idea_id, 'role' => $roles_external->role_type]) }}"
                        class="btn btn-primary"></a> --}}
                </div>
            </div>
        </div>
    </div>


    {{-- modal for update details --}}
    <!-- Modal -->
    <div class="modal fade" id="update_details_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to Update Expense Details ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button onclick="update_budget_form()" class='btn btn-primary'> Yes </button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal for Update Details --}}

    @endsection
    @section('scripts')


    
{{-- usama _14-02-2024 --}}
{{-- get chats dynamically --}}
<script>
    $(document).ready(function () {
        // Function to update chat messages
        async function updateChatMessages(userId, ideaId) {
            // Make an Ajax request to get chat messages for the selected user and idea
            const response = await $.ajax({
                url: '{{ route("getChatMessages") }}',
                type: 'POST',
                data: { user_id: userId, idea_id: ideaId, _token: '{{ csrf_token() }}' },
            });

            // Update the chat section with the received messages
            var chatSection = $('.chat-section');
            chatSection.empty();

            if (response.chats.length > 0) {
                // Loop through the messages and append them to the chat section
                for (const chat of response.chats) {
                    await getUserDetailsAndAppendChat(chat);
                }
            } else {
                chatSection.append('<div><h4>No Discussion yet</h4></div>');
            }
        }

        async function getUserDetailsAndAppendChat(chat) {
            const userResponse = await $.ajax({
                url: '{{ route("getUserDetails") }}',
                type: 'POST',
                data: { user_id: chat.user_id, _token: '{{ csrf_token() }}' },
            });

            var flag_c = '';
            var class_idea_discussion = 'idea-discussion-box-right';
            var style = 'flex-direction:row-reverse';
            var style2 = 'align-items:flex-end';

            if (chat.user_role == 'admin') {
                flag_c = 'true';
            } else {
                flag_c = 'false';
            }

            if ({{Auth::id()}} == chat.user_id && chat.user_role !== 'admin') {
                flag_c = 'false';
                class_idea_discussion = 'idea-discussion-box';
                style = '';
                style2 = '';
            }

            var chatHtml = '<div class="users-img mb-3" style="' + style + '">';
            chatHtml += '<div class="' + class_idea_discussion + '">';
            chatHtml += '<h4>';
            chatHtml += '<strong>' + (userResponse.user.name + ' ' + userResponse.user.last_name) + '</strong>';
            chatHtml += '<em>&#40; ' + chat.user_role + ' &#41;</em>';
            chatHtml += '</h4>';

            if (chat.media_file) {
                var url = '{{ url('/') }}/storage/app/public/' + chat.media_file;
                var fileExtension = chat.file_extension;

                chatHtml += '<a href="' + url + '" target="_blank">';
                if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                    chatHtml += '<img src="' + url + '" alt="Click To View">';
                } else if (['mp4', 'avi', 'mov', 'wmv'].includes(fileExtension)) {
                    chatHtml += '<i class="fa fa-file-video-o" aria-hidden="true" style="font-size: 40px;"></i>';
                } else if (['pdf', 'doc', 'docx'].includes(fileExtension)) {
                    chatHtml += '<i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 40px;"></i>';
                } else {
                    chatHtml += '<i class="fa fa-file" aria-hidden="true" style="font-size: 40px;"></i>';
                }
                chatHtml += '</a>';
            }

            chatHtml += '<p class="feedback-text">' + chat.feedback + '</p>';
            chatHtml += '<p class="datein">' + chat.created_at + '</p>';
            chatHtml += '</div>';
            chatHtml += '</div>';

            var chatSection = $('.chat-section');
            chatSection.prepend(chatHtml);
        }

        // Initial load of chat messages based on the default selected user
        var initialUserId = $('#receiver_id').val();
        var ideaId = '{{ request("id") }}';
        // updateChatMessages(initialUserId, ideaId);

        // Event handler for user selection change
        $('#receiver_id').on('change', function () {
            var userId = $(this).val();
            updateChatMessages(userId, ideaId);
        });
    });
</script>


    <script type="text/javascript">
        $(document).ready(function() {

        //seelect 2
        $('#benifits').select2();
        getSOPC();


        $('#error_message').hide();
        if (window.File && window.FileList && window.FileReader) {

            $(".image-file").on("change", function(e) {
                $('#error_message').hide();
                var file = e.target.files,
                    imagefiles = $(".image-file")[0].files;
                var i = 0;

                $.each(imagefiles, function(index, value) {
                    var f = file[i];
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var img_src;
                        fn_ext = f.name;
                        // Regular expression for file extension.
                        var patternFileExtension = /\.([0-9a-z]+)(?:[\?#]|$)/i;

                        //Get the file Extension
                        var fn_ext = (fn_ext).match(patternFileExtension);
                        var fileSize = value.size / (1024 * 1024);

                        // alert(fileSize);

                        if (fileSize > 50) {
                            $('#error_message li').empty();
                            $('.image-file').val('');
                            $("#error_message li").append(
                                `File size exceeds the limit of 50 MB`);
                            $("#error_message").show();
                            return;
                        }

                        if (fn_ext[1] == 'doc' || fn_ext[1] == 'docx' || fn_ext[1] ==
                            'xlsx' || fn_ext[1] == 'txt') {
                            img_src =
                                '{{ asset('storage/app/public/uploads/asset/doc.png') }}';
                        } else if (fn_ext[1] == 'pdf') {
                            img_src =
                                '{{ asset('storage/app/public/uploads/asset/pdf.png') }}';
                        } else if (fn_ext[1] == 'png' || fn_ext[1] == 'jpeg' || fn_ext[
                                1] == 'jpg') {
                            img_src = e.target.result
                        } else if (fn_ext[1] === 'mp4' || fn_ext[1] === 'mov' || fn_ext[
                                1] === 'avi') {
                            img_src =
                                '{{ asset('storage/app/public/uploads/asset/vid.png') }}';
                        } else {
                            $('#error_message li').empty();
                            $('.image-file').val('');
                            $("#error_message li").append(
                                `Select the specified type of files`);
                            $("#error_message").show();
                            return;
                        }
                        $("#selected-images").parent('fieldset').addClass('d-block');

                        $("#selected-images").append(`
                    <div class="pip boxDiv col-lg-2 col-md-4 col-sm-6">
                        <div class="card border-0 shadow">
                            <div style="width:100%;height:150px;overflow:hidden;padding:15px 0px;">
                                <img class="card-img-top prescriptions" src="${img_src}" alt="Image to upload" style="width:100%;height:100%;object-position:center;object-fit:contain">
                            </div>
                            <div class="card-body">
                                <p style="text-overflow: ellipsis;overflow: hidden;width: 100%;white-space: nowrap;" class="card-text">${value.name}</p>
                                <a style="margin:5px 5px 5px 0px;" class="btn btn-sm btn-danger cross-image remove">Remove</a>
                            </div>
                        </div>
                        <input type="hidden" name="file[]" value="${e.target.result}">
                        <input type="hidden" name="fileName[]" value="${value.name}">
                    </div>`);
                        $(".remove").click(function() {
                            $(this).parent().parent().parent(".pip").remove();
                        });
                    });
                    fileReader.readAsDataURL(f);
                    i++;
                });
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
    });
    </script>

    <script>
        $(document).ready(function() {
        //update status of drop downs

        $('#update_details_assesment').click(function() {
            var token = "{{ csrf_token() }}";
            let assessment_idea_clarity = $('#assessment_idea_clarity').val();
            let assessment_outcome = $('#assessment_outcome').val();
            let assessment_why_implemented = $('#assessment_why_implemented').val();
            let assessment_challenges = $('#assessment_challenges').val();
            let assessment_is_no_implemented = $('#assessment_is_no_implemented').val();
            let assessment_has_alternatives = $('#assessment_has_alternatives').val();
            let assessment_has_less_benifits = $('#assessment_has_less_benifits').val();
            let benifits = $('#benifits').val();
            let idea_id = $('#idea_id').val();
            let remarks = $('#remarks').val();

            var data_array = {
                'assessment_idea_clarity': assessment_idea_clarity,
                'assessment_outcome': assessment_outcome,
                'assessment_why_implemented': assessment_why_implemented,
                'assessment_challenges': assessment_challenges,
                'assessment_is_no_implemented': assessment_is_no_implemented,
                'assessment_has_alternatives': assessment_has_alternatives,
                'assessment_has_less_benifits': assessment_has_less_benifits,
                'benifits': benifits,
                'remarks': remarks,
                'idea_id': idea_id,
                '_token': token
            };

            $.ajax({
                url: "{{ url('/') }}/ideas/updateidea/approver/confirmations",
                type: "POST",
                data: data_array,
                success: function(resp) {
                    console.log(resp);
                    toastr.success("Your Response has been Saved");
                },
                error: function() {
                    toastr.error("failed to store response");
                }
            });

        });

        
        $('.like-btn').click(function() {
                obj = $(this);
                LikeDislike(obj);
            });

            $('.dislike-btn').click(function() {
                obj = $(this);
                LikeDislike(obj);
            });
    });

    function LikeDislike(obj) {
            var idea_id = $(obj).attr('data-idea-id');
            var user_id = $(obj).attr('data-user-id');
            // var role_id = $(obj).attr('data-role-id');
            var col_name = $(obj).attr('data-name');
            var btn_name = $(obj).attr('data-btn-name');
            var token = "{{ csrf_token() }}";
            var send_data = {
                'idea_id': idea_id,
                'user_id': user_id,
                'col_name': col_name,
                'btn_name': btn_name,
                '_token': token
            };
            $.ajax({
                url: "{{ url('/') }}/ideas/updateidea/assessment/likedislike",
                type: "POST",
                data: send_data,
                success: function(resp) {
                    resp = JSON.parse(resp);
                    const elem = obj[0];

                    if (resp) {
                        // Get the parent node
                        const parentNode = elem.parentNode;
                        const btns = parentNode.querySelectorAll('button');

                        // remove active class initially 
                        btns.forEach((btn) => {
                            btn.classList.remove('active');
                        })
                        //add active class to that particular element only
                        elem.classList.add('active');
                    }
                    //    toastr.success("Your Response has been Saved");
                },
                error: function() {
                    //    toastr.error("failed to store response");
                }
            });
        }


    //if idea sended for approval then set select box as disabled
    </script>

    @if (isset($disabled) && $disabled == 'disabled')
    <script>
        $(document).ready(function() {
            //  $('#assessment_idea_clarity','#assessment_outcome','#assessment_why_implemented','#assessment_challenges','#assessment_is_no_implemented','#assessment_has_alternatives','#assessment_has_less_benifits','#benifits').prop('disabled':'true');
            $('#assessment_idea_clarity , #assessment_outcome , #assessment_why_implemented , #assessment_challenges , #assessment_is_no_implemented , #assessment_has_alternatives , #assessment_has_less_benifits , #benifits')
                .prop('disabled', 'disabled');
        });
    </script>
    @endif

    <script>
        $(document).ready(function(){
    //    $('#app_by_app_auth').modal('show');
        $('#expenses_approved_company').change(function(){
            getSOPC();
        });
    });
    function getSOPC(){
        var company_id = $('#expenses_approved_company').val();
        if(company_id != '' ){
            var token = "{{ csrf_token() }}";
            var send_data = {'_token':token, 'company_id':company_id};
            var surl = "{{ url('/') }}/ajax/get/employees";
            $.ajax({
                url:surl,
                type:"post",
                data:send_data,

                success:function(resp){
                    // $('#spoc_details').html(resp);
                    var db_selected_name = "{{ $idea->spoc_details }}";
                    var htm = "<optio value=''>Select option</option>";
                    if(resp){
                        var resp_array = JSON.parse(resp);
                        console.log(resp);
                        if(resp_array.length > 0){
                            $(resp_array).each(function(key,value){
                                var sts = null;
                                if(value.user_id == db_selected_name){
                                    sts = 'selected';
                                }
                                htm += `<option value=${value.user_id} ${sts}>${value.name} ${value.last_name} </option>`;

                            });
                        }
                        // console.log(htm);
                        $('#spoc_details').html(htm);
                    }
                }
            });
        }
    }

    function showConfirm_model(){
        var est_budget = $('#estimate_budget').val();
        var budget_Approved = $('#expenses_approved').val();
        var budget_incured = $('#expenses_incurred').val();
        var company_id = $('#expenses_approved_company').val();
        var user_id = $('#spoc_details').val();
        var error =  true;
            if(est_budget == ""){
            $('#error_estimate_budget').html("Please Enter Budget");
            error = false;
            }

        // if(budget_Approved == ""){
        //    $('#expenses_approved').html("Please Enter Budget");
        // }

        // if(budget_incured == ""){
        //    $('#').html("");
        // }

            if(company_id == ""){
            $('#error_expenses_approved_company').html("Please Select Company");
            error = false;
            }

            if(user_id == ""){
            $('#error_spoc_details').html("Please Select Employee");
            error = false;
            }


            //if error is true then show modal
            if(error == true){
            $('#app_by_app_auth').modal('show');
            }
    }

    function Submit_budget_form(){
        $('#approveWithBudgetForm').submit();
    }

    function update_budget_details(){
        $('#update_details_modal').modal('show');
    }

    function update_budget_form(){
            var idea_id = $('#budgetForm_idea_id').val();
            var estimate_budget = $('#estimate_budget').val();
            var expenses_approved = $('#expenses_approved').val();
            var expenses_incurred = $('#expenses_incurred').val();
            var expenses_approved_company = $('#expenses_approved_company').val();
            var spoc_details = $('#spoc_details').val();
            var token = "{{ csrf_token() }}";

            var data_arr ={'_token':token, 'idea_id':idea_id, 'estimate_budget':estimate_budget, 'expenses_approved':expenses_approved, 'expenses_approved_company':expenses_approved_company, 'spoc_details':spoc_details  };
        $.ajax({
            url :"{{ route('ideaupdatebudgetdetails') }}",
            type:'POST',
            data : data_arr,
            success:function(resp){
                if(resp){
                    toastr.success('Details has been Updated');
                }else{
                    toastr.error('Failed to update Details');
                }
                $('#update_details_modal').modal('hide');
            },
            error:function(){
                toastr.error('Failed to update Details');
                $('#update_details_modal').modal('hide');
            }
        });

    }

    </script>

    @endsection