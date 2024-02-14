@extends('backend.layouts.app')
@section('title', 'Internal Users')

@section('content')

<?php
use App\Models\backend\Company;
?>

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">Internal User</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Internal User</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                <a class="btn btn-outline-primary" href="{{ route('admin.create') }}">
                    <i class="feather icon-plus"></i> Add
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
                            <table class="table zero-configuration " id="tbl-datatable">
                                <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Company</th>
                                        <th style="width:20% !important;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($adminusers) && count($adminusers)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($adminusers as $users)

                                    @php
                                    $company = Company::where('company_id',$users->company_id)->pluck('company_name');
                                    @endphp
                                    <tr>
                                        <td>{{ $srno }}</td>
                                        <td>{{ $users->first_name }}</td>
                                        <td>{{ $users->email }}</td>
                                       <td>{{$company[0] ?? ''}}</td>
                                        <td>
                                            <!-- @can('Update') -->
                                            <!-- @endcan -->
                                            <a href="{{ url('admin/user/edit/'.$users->admin_user_id) }}" class="btn btn-darkblue"><i class="feather icon-edit-2"></i></a>
                                            <!-- @can('Delete') -->
                                            <!-- @endcan -->
                                            {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['admin/user/delete',$users->admin_user_id],
                                            'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="feather icon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-red','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
                                            {!! Form::close() !!}
                                            <a href="{{ url('admin/user/change/password/'.$users->admin_user_id) }}" class="btn btn-darkblue">Password</a>
                                        </td>
                                    </tr>
                                    @php $srno++; @endphp
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
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
