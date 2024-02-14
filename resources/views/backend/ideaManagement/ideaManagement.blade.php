<?php

use App\Models\backend\AdminUsers;
use App\Models\frontend\Users;
use App\Models\backend\Category;
use App\Models\frontend\IdeaImages;
?>
@extends('backend.layouts.app')
@section('title', 'Idea Management')


@section('content')
<?php
    use App\Models\backend\Company;
    ?>

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">Manage Ideas</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Manage Ideas</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                {{-- <a class="btn btn-outline-primary" href="{{ route('user.addIdea') }}">
                    <i class="feather icon-plus"></i> Add
                </a> --}}
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
                            {{-- @if (isset($ideas) && count($ideas) > 0) --}}
                            {{-- <div class="input-group my-2 daterange-inn"
                                style="display:flex;justify-content:flex-end;">
                                <div style="display:flex;justify-content:center;align-items:center;" class=" mx-2">
                                    <i class="fa fa-calendar" style="margin-right:8px;" aria-hidden="true"></i>
                                    <input class="form-control form-control-sm" id="daterange"
                                        placeholder="Search by date range..">
                                </div>
                            </div> --}}


                            <div style="margin: 20px 0px;">

                                <strong>Date Filter:</strong>

                                <input type="text" name="daterange" value="" />

                                {{-- <button class="btn btn-success filter">Filter</button> --}}

                            </div>
                            <table style="position:relative" class="table zero-configuration " id="tbl-datatable">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>ID</th>
                                        <th>Submitted By</th>
                                        <th>Title</th>
                                        <th class="file_uploaded" style="width:12%">File Uploaded</th>
                                        <th>Submitted On</th>
                                        <th>Company</th>
                                        <th>Status</th>
                                        <th>Timeline</th>
                                        <th>Category</th>
                                        <th class="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

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
            // Setup - add a text input to each footer cell
            $('#tbl-datatable thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#tbl-datatable thead');

            // var table = $('#tbl-datatable').DataTable({
            //     orderCellsTop: true,
            //     fixedHeader: true,
            //     initComplete: function() {
            //         var api = this.api();

            //         // For each column
            //         api
            //             .columns()
            //             .eq(0)
            //             .each(function(colIdx) {
            //                 // Set the header cell to contain the input element
            //                 var cell = $('.filters th').eq(
            //                     $(api.column(colIdx).header()).index()
            //                 );
            //                 var title = $(cell).text();
            //                 if (title == 'Submitted On') {
            //                     $(cell).html('<input type="date" placeholder="' + title + '" />');
            //                 } else {
            //                     $(cell).html('<input type="text" placeholder="' + title + '" />');
            //                 }
            //                 // On every keypress in this input
            //                 $(
            //                         'input', $('.filters th').eq($(api.column(colIdx).header())
            //                             .index())
            //                     )
            //                     .off('keyup change')
            //                     .on('change', function(e) {
            //                         // Get the search value
            //                         $(this).attr('title', $(this).val());
            //                         var regexr =
            //                             '({search})'; //$(this).parents('th').find('select').val();

            //                         var cursorPosition = this.selectionStart;
            //                         // Search the column for that value
            //                         api
            //                             .column(colIdx)
            //                             .search(
            //                                 this.value != '' ?
            //                                 regexr.replace('{search}', '(((' + this.value +
            //                                     ')))') :
            //                                 '', this.value != '', this.value == ''
            //                             )
            //                             .draw();
            //                     })
            //                     .on('keyup', function(e) {
            //                         e.stopPropagation();

            //                         $(this).trigger('change');
            //                         $(this)
            //                             .focus()[0]
            //                             .setSelectionRange(cursorPosition, cursorPosition);
            //                     });
            //             });
            //     },
            // });
        });

        //     //console.log(role);
        //     minDateFilter = "";
        //     maxDateFilter = "";

        //     $("#daterange").daterangepicker();
        //     $("#daterange").on("apply.daterangepicker", function(ev, picker) {
        //         minDateFilter = Date.parse(picker.startDate);
        //         maxDateFilter = Date.parse(picker.endDate);

        //         $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        //             var date = Date.parse(data[5]);

        //             if (
        //                 (isNaN(minDateFilter) && isNaN(maxDateFilter)) ||
        //                 (isNaN(minDateFilter) && date <= maxDateFilter) ||
        //                 (minDateFilter <= date && isNaN(maxDateFilter)) ||
        //                 (minDateFilter <= date && date <= maxDateFilter)
        //             ) {
        //                 return true;
        //             }
        //             return false;
        //         });
        //         table.draw();
        //     });
        // });

        $(document).on("click", ".images_modal_class", function() {
            $('#imagesModal').on('hidden.bs.modal', function() {
                $('#imagesModal .modal-body div').empty();
            });
            var idea_uni_id = $(this).data('id');
            // console.log(idea_uni_id);
            if (idea_uni_id != "") {
                let csrf = '<?php echo csrf_token(); ?>';
                var data = {
                    '_token': csrf,
                    'idea_uni_id': idea_uni_id
                }
                $.ajax({
                    type: 'POST',
                    url: '{{ url('idea/ajax_get_images_modal') }}',
                    data: data,
                    success: function(data) {
                        $('.modal-body div').append(data);
                        $('#imagesModal').modal('show');
                    }
                });
            }
        });




        $(function() {



            $('input[name="daterange"]').daterangepicker({

                startDate: moment().subtract(1, 'M'),

                endDate: moment()

            });



            var table = $('#tbl-datatable').DataTable({

                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function() {
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
                                $(cell).html('<input type="date" placeholder="' + title + '" />');
                            } else {
                                $(cell).html('<input type="text" placeholder="' + title + '" />');
                            }
                            // On every keypress in this input
                            $(
                                    'input', $('.filters th').eq($(api.column(colIdx).header())
                                        .index())
                                )
                                .off('keyup change')
                                .on('change', function(e) {
                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr =
                                        '({search})'; //$(this).parents('th').find('select').val();

                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != '' ?
                                            regexr.replace('{search}', '(((' + this.value +
                                                ')))') :
                                            '', this.value != '', this.value == ''
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
                },



                processing: true,

                serverSide: true,

                ajax: {

                    url: "{{ route('admin.ideaManagement') }}",
                    type: "GET",
                    data: function(d) {

                        d.from_date = $('input[name="daterange"]').data('daterangepicker').startDate
                            .format('YYYY-MM-DD H:i:s');

                        d.to_date = $('input[name="daterange"]').data('daterangepicker').endDate.format(
                            'YYYY-MM-DD  H:i:s');

                    }

                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'idea_id',
                        name: 'idea_id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'files',
                        name: 'files'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'company_name',
                        name: 'company_name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'timeline',
                        name: 'timeline'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]



            });



            $(".applyBtn").click(function() {

                table.draw();

            });


            $(document).on("click", ".cancelBtn", function(e) {

                window.location.reload();
            });
        });


        //$(document).on("click", ".images_modal_class", function() {
        //    $('#imagesModal').on('hidden.bs.modal', function() {
        //        $('#imagesModal .modal-body div').empty();
        //    });
        //    var idea_uni_id = $(this).data('id');
        //    // console.log(idea_uni_id);
        //    if (idea_uni_id != "") {
        //        let csrf = '<?php echo csrf_token();?>';
        //        var data = {
        //            '_token': csrf,
        //            'idea_uni_id': idea_uni_id
        //        }
        //        $.ajax({
        //            type: 'POST',
        //            url: "{{ url('idea/ajax_get_images_modal') }}",
        //            data: data,
        //            success: function(data) {
        //                $('.modal-body div').append(data);
        //                $('#imagesModal').modal('show');
        //            }
        //        });
        //    }
        //});
</script>
@endsection
