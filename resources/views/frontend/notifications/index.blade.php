<?php
use App\Models\backend\AdminUsers;
use App\Models\backend\Category;
use App\Models\frontend\Users;
use App\Models\frontend\IdeaImages;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Models\Rolesexternal;
use App\Models\backend\Company;

?>
@php
    $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
    // $role = Auth::user()->role;
    $role = $roles_external->role_type;

    $buttons = [];

    // dd($roles_external->role_type);

    if (!empty($roles_external)) {
        $buttons = explode(',', $roles_external->button_values);
    }

    // dd($buttons);

@endphp
@extends('frontend.layouts.app')
@if ($role == 'Assessment Team' || $role == 'Approving Authority' || $role == 'Implementation')
    @section('title', 'User Dashboard | Idea Management')
@else
    @section('title', 'User Dashboard | My Ideas')
@endif


@section('content')

    <div class="container-fluid">

        <div class="row breadcrumbs-top mt-3">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.dashboard') }}">Dashboard</a>
                    </li>
                    @if ($roles_external->role_name == 'User')
                        <li class="breadcrumb-item active">My Ideas</li>
                    @elseif(
                        $roles_external->role_name == 'Assessment Team' ||
                            $roles_external->role_name == 'Approving Authority' ||
                            $roles_external->role_name == 'Implementation')
                        <li class="breadcrumb-item active">Submitted Ideas</li>
                    @endif
                </ol>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="content-header row  pt-3 pb-3">
            <div class="content-header-left col-md-6 col-12 mb-2">

                @if ($roles_external->role_name == 'User')
                    <h3 class="content-header-title">My Ideas</h3>
                @elseif(
                    $roles_external->role_name == 'Assessment Team' ||
                        $roles_external->role_name == 'Approving Authority' ||
                        $roles_external->role_name == 'Implementation')
                    <h3 class="content-header-title">Ideas</h3>
                @endif
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
                                        {{-- <input id="daterange"> --}}
                                        <table style="position:relative"
                                            class="table zero-configuration new-configuration-table" id="tbl-datatable">
                                            <thead>
                                                <tr>
                                                    <th>Sr No.</th>
                                                    <th>Title</th>
                                                    <th>Notification</th>
                                                    <th>Status</th>
                                                    <th class="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $srno = 1;
                                                @endphp
                                                @foreach ($notifications as $data)
                                                {{--  {{ dd($data->toArray()) }}  --}}
                                                   <tr>
                                                        <td> {{ $loop->index + 1 }}</td>
                                                        <td> {{  $data->description }}</td>
                                                        <td> {{  $data->title }}</td>
                                                        <td>
                                                            @if (isset($data->notification_read) && $data->notification_read == 1 )
                                                                Seen
                                                            @else
                                                                Not Seen
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @php
                                                                $idea_id = 0;
                                                                if(isset($data->notification_ideas)){
                                                                    $idea_id = $data->notification_ideas->idea_id;
                                                                }
                                                            @endphp
                                                            <a href="{{ url('/') }}/ideas/ajax_update_notification/{{ $data->notification_id }}/{{ $idea_id }}" class="btn btn-primary">View</a>
                                                        </td>
                                                   </tr>
                                                @endforeach
                                            @else
                                                <h1>Ideas not posted yet!</h1>
                                    @endif
                                    </tbody>

                                    </table>
                                </div>
                            </div>
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
