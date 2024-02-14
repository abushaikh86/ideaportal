@php
    use App\Models\frontend\Department;
    use App\Models\backend\Company;
    use App\Models\backend\Location;
@endphp
@extends('backend.layouts.app')
@section('title', 'External Users')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">External User</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">External User</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <a class="btn btn-outline-primary" href="{{ route('admin.externalusers.create') }}">
                        <i class="feather icon-plus"></i> Add
                    </a>
                </div>

                <div class="btn-group mx-1" role="group">
                    <a class="btn btn-outline-primary" href="{{ route('sheet.import') }}">
                        <i class="feather icon-upload"></i> Import Sheet
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
                            <div class="table-responsive ">
                                <table class="table zero-configuration " id="tbl-datatable">
                                    <thead>
                                        <tr>
                                            <th>Sr. No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                            <th>Company</th>
                                            <th>Department</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @if (isset($users) && count($users) > 0)
                                    @php
                                    $srno = 1;
                                    @endphp
                                    @foreach ($users as $data)
                                    @php
                                    if (isset($data->location)){
                                        $location = Location::where('location_id',$data->location)->first()->location_name;
                                    }else{
                                        $location = '--';
                                    }
                                  
                                    @endphp
                                    <tr>
                                        <td>{{ $srno }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $location }}</td>

                                        <td>{{ isset(Company::where('company_id',$data->company_id)->first()['company_name'])?Company::where('company_id',$data->company_id)->first()['company_name']:'' }}</td>
                                        <td>
                                            @php
                                               $dname = Department::where('department_id',$data->department)->first();
                                            @endphp
                                        @if (isset($name->name))
                                      {{  $dname->name }}
                                      @endif
                                        </td>
                                        <td>

                                            @if ($data->active_status == 1)
                                            <span class='badge badge-outline-success'> Active</span>
                                            @else
                                            <span class='badge badge-outline-danger'> Not Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- @can('Update') -->
                                            <!-- @endcan -->
                                            <a href="{{ url('admin/externalusers/edit/'.$data->user_id) }}" class="btn btn-darkblue"><i class="feather icon-edit-2"></i></a>
                                            <!-- @can('Delete') -->
                                            <!-- @endcan -->
              
                                            <a href="{{ url('admin/externalusers/delete/'.$data->user_id) }}"
                                            class="btn btn-danger" onclick="return confirm('Are you sure you want to Delete this Entry ?')"><i class="feather icon-trash"></i></a>

                                            <a href="{{ url('admin/externalusers/changepassword/'.$data->user_id) }}"
                                                class="btn btn-primary" >Password</a>
                                        </td>
                                    </tr>
                                    @php
                                    $srno++;
                                    @endphp
                                    @endforeach
                                    @endif --}}
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

    <script src="{{ asset('public/backend-assets/vendors/js/datatables.min.js') }}"></script>
    <script src="{{ asset('public/backend-assets/vendors/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        // $('#tbl-datatable').DataTable({
        //     responsive: true
        // });




        $(document).ready(function() {

            fetch();


            function fetch() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#tbl-datatable').DataTable({

                    processing: true,

                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.externalusers') }}",
                        type: "GET",

                    },

                    columns: [

                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {

                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'location',
                            name: 'location'
                        },
                        {
                            data: 'company_name',
                            name: 'company_name'
                        },
                        {
                            data: 'department',
                            name: 'department'
                        },
                        {
                            data: 'active_status',
                            name: 'active_status'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: true
                        },


                    ]

                });

            }




        });
    </script>
@endsection
