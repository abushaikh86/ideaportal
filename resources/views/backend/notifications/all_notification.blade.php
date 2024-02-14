<?php

use App\Models\backend\AdminUsers;
use App\Models\frontend\Users;
use App\Models\backend\Category;
use App\Models\frontend\IdeaImages;
?>
@extends('backend.layouts.app')
@section('title', 'Notifications')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">Notification</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Notifications</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <a class="btn btn-outline-primary" href="{{ route('admin.dashboard') }}">
                    <i class="feather icon-arrow-left"></i> Back
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
                            <div class="table-responsive">
                                @if (isset($notifications) && count($notifications) > 0)
                                    <div class="input-group my-2 daterange-inn"
                                        style="display:flex;justify-content:flex-end;">
                                        <div style="display:flex;justify-content:center;align-items:center;" class=" mx-2">
                                            <i class="fa fa-calendar" style="margin-right:8px;" aria-hidden="true"></i>
                                            <input class="form-control form-control-sm" id="daterange"
                                                placeholder="Search by date range..">
                                        </div>
                                    </div>
                                    <table style="position:relative" class="table zero-configuration " id="tbl-datatable">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Title</th>
                                                <th>Notification</th>
                                                <th>Read Status</th>
                                                <th class="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $srno = 1;
                                            @endphp
                                            @foreach ($notifications as $data)
                                            <tr>
                                                <td> {{ $loop->index+1 }}</td>
                                                <td>
                                                    @if (isset($data->description))
                                                        {{ $data->description }}
                                                    @endif
                                                </td>

                                                <td>
                                                    @if (isset($data->title))
                                                        {{ $data->title }}
                                                    @endif
                                                </td>

                                                <td>
                                                    @if (isset($data->notification_read) && $data->notification_read == 1)
                                                        Seen
                                                        @else
                                                        Not Seen
                                                    @endif
                                                </td>
                                                <td>


                                                    @php
                                                    $idea_id = 0;
                                                        if(isset($data->notification_ideas->idea_id)){
                                                            $idea_id = $data->notification_ideas->idea_id;
                                                        }
                                                    @endphp

                                                    <a href="{{ url('/') }}/admin/ideas/ajax_update_notification/{{ $data->notification_id }}/{{ $idea_id }}" class="btn btn-primary m-1">View</a>

                                                </td>
                                                {{--  {{ dd($data->toArray()) }}  --}}
                                            </tr>
                                            @endforeach
                                        @else
                                            <h1>Notification Not Found</h1>
                                @endif
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="imagesModal" tabindex="-1" role="dialog" aria-labelledby="imagesModallLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title w-100" id="imagesModallLabel">
                            Idea Images
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x
                            </span>
                        </button>
                    </div>
                    <!--Modal body with image-->
                    <div class="modal-body">
                        <div style="display:grid;grid-template-columns: auto auto auto auto;grid-gap:10px">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('public/backend-assets/vendors/js/datatables.min.js') }}"></script>
    <script src="{{ asset('public/backend-assets/vendors/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tbl-datatable').DataTable();
        });
    </script>
@endsection
