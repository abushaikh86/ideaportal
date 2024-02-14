<?php
use App\Models\backend\AdminUsers;
use App\Models\backend\Category;
use App\Models\frontend\Users;
?>
<?php
$role = Auth::user()->role;
//dd($role);
?>


<?php $__env->startSection('title', 'User Dashboard | Rewards and Recognition'); ?>
<?php $__env->startSection('content'); ?>


<section class="cs-breadcrumb">
    <div class="container-fluid">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <h1>Certificates for Ideas</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('user.dashboard')); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Rewards and Recognition</li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Back" href="<?php echo e(route('rewards')); ?>">
                        <i style="margin-right:6px;font-size:1.1em;" class="fa fa-angle-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="cs-content">
    <div class="container-fluid">
        <div id="basic-datatable">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <?php if(isset($ideas) && count($ideas) > 0): ?>
                        <table class="table zero-configuration new-configuration-table" id="tbl-datatable">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Title</th>
                                    <th width="170">Submitted On</th>
                                    <th>Status</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno = 1;
                                ?>
                                <?php $__currentLoopData = $ideas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php

                                $idea_status = $idea->active_status;
                                $status = '';
                                $status_color = '';
                                if($idea_status == 'in_assessment') {
                                $status = "Under Assessment";
                                $status_color = 'badge bg-secondary me-1';
                                } elseif($idea_status == 'pending') {
                                $status = "Pending";
                                $status_color = 'badge bg-secondary me-1';
                                } elseif($idea_status == 'under_approving_authority') {
                                $status = "Under Approval";
                                $status_color = 'badge bg-warning me-1';
                                } elseif($idea_status == 'implementation') {
                                $status = "Implementation";
                                $status_color = 'badge bg-danger me-1';
                                } elseif($idea_status == 'reject') {
                                $reason = $idea->reject_reason == null ? '' : '(Reason : '.$idea->reject_reason.')';
                                $status = "Rejected ".$reason;
                                $status_color = 'badge bg-danger me-1';
                                }elseif($idea_status == 'on_hold') {
                                $status = "On-hold";
                                $status_color = 'badge bg-secondary me-1';
                                }elseif($idea_status == 'resubmit') {
                                $reason = $idea->resubmit_reason == null ? '' : '(Reason :
                                '.$idea->resubmit_reason.')';
                                $status = "Revise Request ".$reason;
                                $status_color = 'badge bg-warning me-1';
                                }elseif($idea_status == 'implemented') {
                                $status = "Implemented";
                                $status_color = 'badge bg-warning me-1';
                                }

                                $category = $idea->category_id == '' || !isset($idea->category_id) ? 'Not
                                Assigned':
                                Category::where('category_id',$idea->category_id)->first()['category_name'];
                                ?>
                                <tr>
                                    <td><?php echo e($srno); ?></td>
                                    <td><?php echo e($idea->title); ?></td>
                                    <td><?php echo e(explode(' ',$idea->created_at)[0]); ?></td>
                                    <td>
                                        <span class="<?php echo e($status_color); ?>"></span>
                                        <?php echo e($status); ?>

                                    </td>
                                    <td><?php echo e($category); ?></td>
                                    <td>
                                        <div style="display:flex; gap:8px;">
                                            <?php echo Form::open([
                                            'method'=>'GET',
                                            'url' => ['/rewards/view',$idea->idea_id],
                                            'style' => 'display:inline'
                                            ]); ?>

                                            <?php echo Form::button('<i class="fa fa-eye"></i>',
                                            ['type' => 'submit',
                                            'class' => 'btn btn-sm btn-info btn-orange',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'title' => 'View Idea Certificate'
                                            ]); ?>

                                            <?php echo Form::close(); ?>


                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $srno++;
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <h4 class="text-danger">No Certificates</h4>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<script src="<?php echo e(asset('public/backend-assets/vendors/js/datatables.min.js')); ?>">
</script>
<script src="<?php echo e(asset('public/backend-assets/vendors/js/dataTables.bootstrap4.min.js')); ?>">
</script>
<script>
    $('#tbl-datatable').DataTable({
        responsive: true
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\ideaportal\resources\views/frontend/rewards/index.blade.php ENDPATH**/ ?>