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

$buttons = [];
$roles_external = Rolesexternal::where(['id'=>Auth::user()->sub_role_final])->first();
$role = $roles_external->role_type;

if(!empty($roles_external)){
$buttons = explode(',',$roles_external->button_values);
}

@endphp
@extends('frontend.layouts.app')
@if($role == 'Assessment Team' || $role == 'Approving Authority' || $role == 'Implementation')
@section('title', 'User Dashboard | Idea Management')
@else
@section('title', 'User Dashboard | My Ideas')
@endif

@section('content')

{{-- Breadcrumb --}}
<section class="cs-breadcrumb">
    <div class="container-fluid">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <h1>My Ideas</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.dashboard') }}">Dashboard</a>
                    </li>
                    @if (isset($_GET['st']))
                    @if ($_GET['st'] == 'revise_req')
                    <li class="breadcrumb-item active"> / Revise Request</li>
                    @elseif ($_GET['st'] == 'under_asset')
                    <li class="breadcrumb-item active">Ideas Under Assessment</li>
                    @elseif ($_GET['st'] == 'under_approv')
                    <li class="breadcrumb-item active">Ideas Under Approval</li>
                    @elseif ($_GET['st'] == 'approved_ideas')
                    <li class="breadcrumb-item active">Approved Ideas</li>
                    @elseif ($_GET['st'] == 'implemented')
                    <li class="breadcrumb-item active">Implemented Ideas</li>
                    @elseif ($_GET['st'] == 'rejected')
                    <li class="breadcrumb-item active">Rejected Ideas</li>
                    @elseif ($_GET['st'] == 'implementation')
                    <li class="breadcrumb-item active">Ideas Under Implementation</li>
                    @else
                    <li class="breadcrumb-item active">Total Ideas</li>
                    @endif
                    @else
                    <li class="breadcrumb-item active">Total Ideas</li>
                    @endif
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-end gap-2">
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Back" href="{{ route('rewards') }}">
                        <i style="margin-right:6px;font-size:1.1em;" class="fa fa-angle-left"></i> Back
                    </a>
                    @if (in_array('Add', $buttons))
                    <a class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Add New Idea" href="{{ route('myideas.addIdea') }}">
                        <i class="feather icon-plus"></i>  Add New Idea
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


{{-- Content --}}
<section class="cs-content">
    <div class="container-fluid">
        <div id="basic-datatable">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @if(isset($ideas) && count($ideas) > 0)
                        <div class="element-group">
                            <div class="input-group">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <input class="form-control" id="daterange" placeholder="Search by date range..">
                            </div>
                        </div>
                        <table class="table zero-configuration new-configuration-table" id="tbl-datatable">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>ID</th>
                                    @if($role == 'Assessment Team' || $role == 'Approving Authority' || $role ==
                                    'Implementation')
                                    <th>Submitted By</th>
                                    @endif
                                    <th>Title</th>
                                    <th class="file_uploaded">File Uploaded</th>
                                    <th>Submitted On</th>
                                    <th>Company</th>
                                    <th>Status</th>
                                    <th>Timeline</th>
                                    <th>Category</th>
                                    <th class="action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $srno = 1;
                                @endphp
                                @foreach($ideas as $idea)
                                @php
                                $company_id = $idea->company_data->company_id ?? '';
                                $company = Company::where('company_id',$company_id)->pluck('company_name');
                                $image_path = $idea->image_path;
                                $full_image_path = 'storage/app/public/'.$image_path;
                                $extArr = explode('.',$image_path);
                                $ext = end($extArr);
                                // dump($ext);
                                $user = Users::where('user_id',$idea->user_id)->first();
                                $idea_status = $idea->active_status;
                                // dd($idea_status);
                                $status = '';
                                $status_color = '';
                                if($idea_status == 'in_assessment') {
                                $status = "Under Assessment";
                                $status_color = 'badge bg-assessment me-1';
                                } elseif($idea_status == 'pending') {
                                $status = "Pending";
                                $status_color = 'badge bg-pending me-1';
                                } elseif($idea_status == 'under_approving_authority') {
                                $status = "Under Approval";
                                $status_color = 'badge bg-approved me-1';
                                } elseif($idea_status == 'implementation') {
                                $status = "Implementation";
                                $status_color = 'badge bg-implemented me-1';
                                } elseif($idea_status == 'reject') {
                                $reason = $idea->reject_reason == null ? '' : '(Reason :
                                '.$idea->reject_reason.')';
                                $status = "Rejected ".$reason;
                                $status_color = 'badge bg-danger me-1';
                                }elseif($idea_status == 'on_hold') {
                                $status = "On-hold";
                                $status_color = 'badge bg-secondary me-1';
                                }elseif($idea_status == 'resubmit') {
                                $data=
                                FacadesDB::table('ideas')->where(['idea_id'=>$idea->idea_id,'asstmnt_rev_status'=>1])->where('user_id','=',Auth::id())->get();
                                // dd($data);
                                if($data->isEmpty()){
                                $status = "Under Assessment";
                                $status_color = 'badge bg-assessment me-1';
                                }else{
                                $reason = $idea->resubmit_reason == null ? '' : '(Reason :
                                '.$idea->resubmit_reason.')';
                                $status = "Revise Request ".$reason;
                                $status_color = 'badge bg-warning me-1';
                                }

                                }elseif($idea_status == 'implemented') {
                                $status = "Implemented";
                                $status_color = 'badge bg-implemented me-1';
                                }
                                $category = $idea->category_id == '' || !isset($idea->category_id) ? 'Not
                                Assigned':
                                Category::where('category_id',$idea->category_id)->first()['category_name'];
                                @endphp

                                <tr class="idea">
                                    <td>
                                        <span class="sr-no">
                                            {{ $srno }}
                                        </span>
                                    </td>
                                    
                                    <td>
                                        <span class="id">
                                            {{ '000' . $idea->idea_id }}
                                        </span>
                                    </td>
                                    
                                    @if($role == 'Assessment Team' || $role == 'Approving Authority' || $role ==
                                    'Implementation')
                                    <td>
                                        <span class="name">
                                            @if (isset($user['name']))
                                            {{ $user['name'] }}
                                            @endif
                                            
                                            @if (isset($user['last_name']))
                                            {{ $user['last_name'] }}
                                            @endif
                                        </span>
                                    </td>
                                    @endif

                                    <td>
                                        <span class="title">
                                            {{ $idea->title }}
                                        </span>
                                    </td>

                                    <td>
                                        @php
                                        $files =
                                        IdeaImages::where('idea_uni_id',$idea->idea_uni_id)->whereNotNull('idea_uni_id')->get();
                                        @endphp
                                        @if(count($files) > 0)
                                        <a href="#" class="images_modal_class" data-id="{{ $idea->idea_uni_id }}">{{count($files).' files'}}</a>
                                        @else
                                        <span class="files">No files yet</span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="submitted">
                                            {{ explode(' ', $idea->created_at)[0] }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="company">
                                            {{ $company[0] ?? '' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="status">
                                            <i class="{{ $status_color }}"></i>
                                            {{ $status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="timeline">
                                            @if($status == 'Implemented')
                                            <p>Implemented</p>
                                            <div class="group">
                                                <span>
                                                    <img src="{{ asset('/public/frontend-assets/static/images/icon/pending.png') }}" alt="" class="icon active">
                                                </span>
                                                <span>
                                                    <img src="{{ asset('/public/frontend-assets/static/images/icon/assessment.png') }}" alt="" class="icon active">
                                                </span>
                                                <span>
                                                    <img src="{{ asset('/public/frontend-assets/static/images/icon/approved.png') }}" alt="" class="icon active">
                                                </span>
                                                <span>
                                                    <img src="{{ asset('/public/frontend-assets/static/images/icon/implemented.png') }}" alt="" class="icon active">
                                                </span>
                                            </div>
                                            @elseif($status == 'Pending')
                                            <p>Pending</p>
                                            <div class="group">
                                                <span>
                                                    <img src="{{ asset('/public/frontend-assets/static/images/icon/pending.png') }}" alt="" class="icon active">
                                                </span>
                                                <span>
                                                    <img src="{{ asset('/public/frontend-assets/static/images/icon/assessment.png') }}" alt="" class="icon">
                                                </span>
                                                <span>
                                                    <img src="{{ asset('/public/frontend-assets/static/images/icon/approved.png') }}" alt="" class="icon">
                                                </span>
                                                <span>
                                                    <img src="{{ asset('/public/frontend-assets/static/images/icon/implemented.png') }}" alt="" class="icon">
                                                </span>
                                            </div>
                                            @elseif(in_array($status, [ 'Under Approval', 'Processed for Implementation', 'Implementation', 'Kept On Hold- by Approver']))
                                            <p>Approved</p>
                                            <div class="group">
                                                <span>
                                                    <img src="{{ asset('/public/frontend-assets/static/images/icon/pending.png') }}" alt="" class="icon active">
                                                </span>
                                                <span>
                                                    <img src="{{ asset('/public/frontend-assets/static/images/icon/assessment.png') }}" alt="" class="icon active">
                                                </span>
                                                <span>
                                                    <img src="{{ asset('/public/frontend-assets/static/images/icon/approved.png') }}" alt="" class="icon active">
                                                </span>
                                                <span>
                                                    <img src="{{ asset('/public/frontend-assets/static/images/icon/implemented.png') }}" alt="" class="icon">
                                                </span>
                                            </div>
                                            @elseif(in_array($status, ['Under Assessment', 'Processed for Approval', 'Kept On Hold- by Assessment','Approved by Assessment']))
                                            <p>In-Assessment</p>
                                            <div class="group">
                                                <span>
                                                    <img src="{{ asset('/public/frontend-assets/static/images/icon/pending.png') }}" alt="" class="icon active">
                                                </span>
                                                <span>
                                                    <img src="{{ asset('/public/frontend-assets/static/images/icon/assessment.png') }}" alt="" class="icon active">
                                                </span>
                                                <span>
                                                    <img src="{{ asset('/public/frontend-assets/static/images/icon/approved.png') }}" alt="" class="icon">
                                                </span>
                                                <span>
                                                    <img src="{{ asset('/public/frontend-assets/static/images/icon/implemented.png') }}" alt="" class="icon">
                                                </span>
                                            </div>
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        <span class="category">
                                            {{ $category }}
                                        </span>
                                    </td>

                                    <td>
                                        @if(in_array('button_values',$buttons))
                                        <div class="btn-group">
                                            @if(in_array('View',$buttons))
                                            @if($role == 'Implementation')
                                            {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['/myideas/view_idea_implementation_team',$idea->idea_id],
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-eye"></i>',
                                            ['type' => 'submit',
                                            'class' => 'btn btn-sm btn-info btn-orange',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'title' => 'View Idea'
                                            ]) !!}
                                            {!! Form::close() !!}
                                            @elseif($role == 'Approving Authority')
                                            {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['/myideas/view_idea_approving_authority',$idea->idea_id],
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-eye"></i>',
                                            ['type' => 'submit',
                                            'class' => 'btn btn-sm btn-info btn-orange',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'title' => 'View Idea'
                                            ]) !!}
                                            {!! Form::close() !!}
                                            @else
                                            {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['/myideas/view',$idea->idea_id],
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-eye"></i>',
                                            ['type' => 'submit',
                                            'class' => 'btn btn-sm btn-info btn-orange',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'title' => 'View Idea'
                                            ]) !!}
                                            {!! Form::close() !!}
                                            @endif
                                            @endif
                                            
                                            @if(($idea->active_status == 'resubmit' || $idea->active_status ==
                                            'pending') && in_array('Edit',$buttons))

                                            <a href="{{ url('/myideas/edit',$idea->idea_id) }}" class="btn btn-sm btn-primary btn-green" data-toggle="tooltip" data-placement="top" title="Edit Idea">
                                                <i class="feather icon-edit-2"></i>
                                            </a>
                                            @endif

                                            @if($idea->active_status == 'pending' && in_array('Delete',$buttons))
                                            <a class="btn btn-sm btn-danger btn-red" data-toggle="tooltip" data-placement="top" title="Delete Idea " onclick="return confirm('Are you sure you want to Delete this Entry?')" href="{{ route('myideas.delete',['id'=> $idea->idea_id]) }}">
                                                <i class="feather icon-trash"></i>
                                            </a>
                                            @endif
                                            
                                            @if(in_array('Revisions',$buttons))
                                            <a class="btn btn-sm btn-warning btn-blue"  data-toggle="tooltip" data-placement="top" title="Idea Revisions" href="{{ route('myideas.ideaRevision',['id'=> $idea->idea_id]) }}">
                                                <i class="fa fa-history" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                $srno++;
                                @endphp
                                @endforeach
                                @else
                                <h4>Ideas not posted yet!</h4>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="imagesModal" tabindex="-1" role="dialog" aria-labelledby="imagesModallLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- w-100 class so that header
            div covers 100% width of parent div -->
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


@endsection

@section('scripts')

<script src="{{ asset('public/backend-assets/vendors/js/datatables.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#tbl-datatable thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#tbl-datatable thead');

        var table = $('#tbl-datatable').DataTable({
            orderCellsTop: true
            , fixedHeader: true
            , initComplete: function() {
                var api = this.api();

                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function(colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        if (title == 'Submitted On') {
                            $(cell).html('<input type="text" placeholder="' + title + '" />');
                        } else {
                            $(cell).html('<input type="text" placeholder="' + title + '" />');
                        }
                        // On every keypress in this input
                        $(
                                'input'
                                , $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                            .off('keyup change')
                            .on('change', function(e) {
                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr = '({search})'; //$(this).parents('th').find('select').val();

                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != '' ?
                                        regexr.replace('{search}', '(((' + this.value + ')))') :
                                        ''
                                        , this.value != ''
                                        , this.value == ''
                                    )
                                    .draw();
                            })
                            .on('keyup', function(e) {
                                e.stopPropagation();

                                $(this).trigger('change');
                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            }
        , });
        var role = '{{ $role }}';
        //console.log(role);
        minDateFilter = "";
        maxDateFilter = "";

        $("#daterange").daterangepicker();
        $("#daterange").on("apply.daterangepicker", function(ev, picker) {
            minDateFilter = Date.parse(picker.startDate);
            maxDateFilter = Date.parse(picker.endDate);

            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {


                if (role == 'Assessment Team' || role == 'Approving Authority' || role ==
                    'Implementation') {
                    var date = Date.parse(data[5]);
                } else {
                    var date = Date.parse(data[4]);
                }

                if (
                    (isNaN(minDateFilter) && isNaN(maxDateFilter)) ||
                    (isNaN(minDateFilter) && date <= maxDateFilter) ||
                    (minDateFilter <= date && isNaN(maxDateFilter)) ||
                    (minDateFilter <= date && date <= maxDateFilter)
                ) {
                    return true;
                }
                return false;
            });
            table.draw();
        });

    });

    $(document).on("click", ".images_modal_class", function() {
        $('#imagesModal').on('hidden.bs.modal', function() {
            $('#imagesModal .modal-body div').empty();
        });
        var idea_uni_id = $(this).data('id');
        // console.log(idea_uni_id);
        if (idea_uni_id != "") {
            let csrf = '<?php echo csrf_token(); ?>';
            var data = {
                '_token': csrf
                , 'idea_uni_id': idea_uni_id
            }
            $.ajax({
                type: 'POST'
                , url: '{{ url('idea/ajax_get_images_modal') }}'
                , data: data
                , success: function(data) {
                    $('.modal-body div').append(data);
                    $('#imagesModal').modal('show');
                }
            });
        }
    });

</script>

@endsection