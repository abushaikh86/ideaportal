@extends('backend.layouts.app')
@section('title', 'Import External Users')
@php
use Spatie\Permission\Models\Role;
@endphp
@section('content')


<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">Importred External Users</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard')}}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.users')}}">Users</a>
                    </li>

                    <li class="breadcrumb-item active">Imported Users</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                <a class="btn btn-outline-primary" href="{{ url()->previous() }}"><svg style="margin-right: 6px;font-size: 1.1em;" class="svg-inline--fa fa-angle-left" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"></path></svg>
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
                        <div class="row mb-2 mt-2">
                            <div class="col md-5"></div>
                        </div>
                        <div class="table-responsive">
                        <table class="table zero-configuration " id="tbl-datatable" style="text-align:center">
                        <thead>
                        <tr>
                            <th>Sr No</th>
                                <th>Employee ID</th>
                                <th>User Full Name</th>
                                <th>Email</th>
                                <th>Mobile No</th>
                                <th>User Role</th>
                                <th>User Type</th>
                                <th>Location</th>
                                <th>Department</th>
                                <th>Company</th>
                                <th>Designation</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($data) && count($data)>0)
                                @foreach ($data as $dt)

                                @if (isset($dt['status']) && $dt['status'] != '')
                                    <tr style='background-color:rgb(247, 113, 113); color:white; '>
                                        @else
                                    <tr>
                                @endif
                                    <td>{{ $loop->index+1 }}</td>

                                    <td>{{ $dt['emp_id'] }}</td>

                                    <td>
                                        @if (isset($dt['name']))
                                            {{ $dt['name'] }}
                                        @endif

                                        @if (isset($dt['last_name']))
                                            {{ $dt['last_name'] }}
                                        @endif
                                    </td>

                                    <td>
                                        @if (isset($dt['email']))
                                            {{ $dt['email'] }}
                                        @endif
                                    </td>

                                    <td>
                                        @if (isset($dt['mobile_no']))
                                            {{ $dt['mobile_no'] }}
                                        @endif
                                    </td>

                                    <td>
                                        @if (isset($dt['role']))
                                        {{ $dt['role'] }}
                                        @endif
                                    </td>

                                    <td>
                                        @if (isset($dt['centralized_decentralized_type']) && $dt['centralized_decentralized_type'] == 1)
                                            Centralised
                                            @else
                                            Decentralised
                                        @endif
                                    </td>

                                    <td>
                                        @if (isset($dt['location']) && $dt['location'] != '' && isset($dt['location_name']))
                                            {{ $dt['location_name'] }}
                                        @endif
                                    </td>

                                    <td>
                                        @if (isset($dt['department']) && $dt['department'] != '' && isset($dt['department_name']))
                                        {{ $dt['department_name'] }}
                                        @endif
                                    </td>

                                    <td>
                                        @if (isset($dt['company_id']) && $dt['company_id'] != '' && isset($dt['company_name']))
                                        {{ $dt['company_name'] }}
                                        @endif
                                    </td>

                                    <td>
                                        @if (isset($dt['designation_id']) && $dt['designation_id'] != '' && isset($dt['designation_name']))
                                            {{ $dt['designation_name'] }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $dt['status'] }}</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                       </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
@section('scripts')
    <script src="{{ asset('public/backend-assets/vendors/js/datatables.min.js') }}">
    </script>
    <script src="{{ asset('public/backend-assets/vendors/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script>
        $('#tbl-datatable').DataTable({
            responsive: true
        });


</script>

@endsection
