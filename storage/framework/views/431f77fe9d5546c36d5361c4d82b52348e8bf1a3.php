<?php

use App\Models\backend\AdminUsers;
use App\Models\frontend\Users;
use App\Models\backend\Category;
use App\Models\frontend\IdeaImages;
?>

<?php $__env->startSection('title', 'Groupwise Budget Allocated/ Used/Approved'); ?>

<?php $__env->startSection('content'); ?>
<?php
    use App\Models\backend\Company;
    ?>

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">Groupwise Budget Allocated/ Used/Approved</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Groupwise Budget Allocated/ Used/Approved</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                
            </div>
        </div>
    </div>
</div>


<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="row">

                        <div class="card-body card-dashboard">
                            

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo e(Form::label('company_id', 'Company')); ?>

                                        <?php echo e(Form::select('company_id', $company_data, request('company_id'), ['id' =>
                                        'tags', 'placeholder' => 'Select Company', 'class' => 'form-control
                                        company_id'])); ?>

                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <?php echo e(Form::label('status', 'Status')); ?>

                                        <?php echo e(Form::select(
                                        'status',
                                        [
                                        'pending' => 'Submitted',
                                        'in_assessment' => 'Processed',
                                        'reject' => 'Rejected',
                                        'resubmit' => 'Revised',
                                        'implemented' => 'implemented',
                                        ],
                                        request('status'),
                                        ['id' => 'status', 'placeholder' => 'Select Status', 'class' => 'form-control'],
                                        )); ?>

                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <?php echo e(Form::label('budget_status', 'Budget Status')); ?>

                                        <?php echo e(Form::select('budget_status',
                                        ['estimate_budget'=>'Allocated','expenses_incurred'=>'Used','expenses_approved'=>'Approved'],
                                        request('budget_status'), ['id' =>
                                        'budget_status', 'placeholder' => 'Select budget_status', 'class' =>
                                        'form-control'])); ?>

                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <?php echo e(Form::label('filter', 'Filter')); ?>

                                        <?php echo e(Form::select('filter', ['<='=> 'Less than', '>'=> 'More than'],
                                            request('filter'), ['id' =>
                                            'filter', 'placeholder' => 'Select Filter', 'class' => 'form-control'])); ?>

                                    </div>
                                </div>

                                <div class="col-md-2" id="budget_amt_container" style="display: none;">
                                    <div class="form-group">
                                        <?php echo e(Form::label('budget_amt', 'Budget Amount')); ?>

                                        <?php echo e(Form::number('budget_amt', request('budget_amt'), ['id' => 'budget_amt',
                                        'placeholder' => 'Enter Budget Amount', 'class' => 'form-control'])); ?>

                                    </div>
                                </div>

                                <div class="col md-4">
                                    <div class="form-group">
                                        <br><br>
                                        <?php echo e(Form::submit('Submit', ['class' => 'btn btn-primary mb-1 applyBtn'])); ?>

                                        <button type="reset" class="btn btn-dark mr-1 mb-1 cancelBtn">Reset</button>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="table-responsive">


                        <table style="position:relative" class="table zero-configuration " id="tbl-datatable">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>ID</th>
                                    <th>Submitted By</th>
                                    <th>Title</th>

                                    <th>Submitted On</th>
                                    <th>Company</th>
                                    <th>BUDGET ALLOCATED</th>
                                    <th>BUDGET APPROVED</th>
                                    <th>BUDGET USED</th>
                                    <th>Status</th>
                                    
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

    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('public/backend-assets/vendors/js/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend-assets/vendors/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script>
    $(function() {

        var filterDropdown = document.getElementById('filter');
        var budgetAmountContainer = document.getElementById('budget_amt_container');

        // Initial check on page load
        toggleBudgetAmountVisibility();

        // Attach an event listener to the filter dropdown
        filterDropdown.addEventListener('change', toggleBudgetAmountVisibility);

        function toggleBudgetAmountVisibility() {
            // Toggle the visibility based on the selected filter value
            budgetAmountContainer.style.display = ['<=', '>'].includes(filterDropdown.value) ? 'block' : 'none';
        }

            var table = $('#tbl-datatable').DataTable({

                orderCellsTop: true,
                fixedHeader: true,

                processing: true,

                serverSide: true,

                ajax: {

                    url: "<?php echo e(route('admin.group_wise_budget')); ?>",
                    type: "GET",
                    data: function(d) {
                        d.company_id = $('select[name="company_id"]').val();
                        d.status = $('select[name="status"]').val();
                        d.filter = $('select[name="filter"]').val();
                        d.budget_amt = $('input[name="budget_amt"]').val();
                        d.budget_status = $('select[name="budget_status"]').val();
                        // alert(d.budget_status);
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
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'company_name',
                        name: 'company_name'
                    },
                    {
                        data: 'estimate_budget',
                        name: 'estimate_budget'
                    },
                    {
                        data: 'expenses_approved',
                        name: 'expenses_approved'
                    },
                    {
                        data: 'expenses_incurred',
                        name: 'expenses_incurred'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    // {
                    //     data: 'category_name',
                    //     name: 'category_name'
                    // },
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


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/idea_portal/resources/views/backend/misreport/group_wise_budget.blade.php ENDPATH**/ ?>