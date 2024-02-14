<?php
use App\Models\backend\AdminUsers;
use App\Models\backend\Category;
use App\Models\frontend\Users;
use App\Models\frontend\IdeaImages;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Models\Rolesexternal;
use App\Models\backend\Company;

?>
<?php
    $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
    // $role = Auth::user()->role;
    $role = $roles_external->role_type;

    $buttons = [];

    // dd($roles_external->role_type);

    if (!empty($roles_external)) {
        $buttons = explode(',', $roles_external->button_values);
    }

    // dd($buttons);

?>

<?php if($role == 'Assessment Team' || $role == 'Approving Authority' || $role == 'Implementation'): ?>
    <?php $__env->startSection('title', 'User Dashboard | Idea Management'); ?>
<?php else: ?>
    <?php $__env->startSection('title', 'User Dashboard | My Ideas'); ?>
<?php endif; ?>


<?php $__env->startSection('content'); ?>

    <div class="container-fluid">

        <div class="row breadcrumbs-top mt-3">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('user.dashboard')); ?>">Dashboard</a>
                    </li>
                    <?php if($roles_external->role_name == 'User'): ?>
                        <li class="breadcrumb-item active">My Ideas</li>
                    <?php elseif(
                        $roles_external->role_name == 'Assessment Team' ||
                            $roles_external->role_name == 'Approving Authority' ||
                            $roles_external->role_name == 'Implementation'): ?>
                        <li class="breadcrumb-item active">Submitted Ideas</li>
                    <?php endif; ?>
                </ol>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="content-header row  pt-3 pb-3">
            <div class="content-header-left col-md-6 col-12 mb-2">

                <?php if($roles_external->role_name == 'User'): ?>
                    <h3 class="content-header-title">My Ideas</h3>
                <?php elseif(
                    $roles_external->role_name == 'Assessment Team' ||
                        $roles_external->role_name == 'Approving Authority' ||
                        $roles_external->role_name == 'Implementation'): ?>
                    <h3 class="content-header-title">Ideas</h3>
                <?php endif; ?>
            </div>
        </div>


        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <?php if(isset($notifications) && count($notifications) > 0): ?>
                                        
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
                                                <?php
                                                    $srno = 1;
                                                ?>
                                                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                
                                                   <tr>
                                                        <td> <?php echo e($loop->index + 1); ?></td>
                                                        <td> <?php echo e($data->description); ?></td>
                                                        <td> <?php echo e($data->title); ?></td>
                                                        <td>
                                                            <?php if(isset($data->notification_read) && $data->notification_read == 1 ): ?>
                                                                Seen
                                                            <?php else: ?>
                                                                Not Seen
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $idea_id = 0;
                                                                if(isset($data->notification_ideas)){
                                                                    $idea_id = $data->notification_ideas->idea_id;
                                                                }
                                                            ?>
                                                            <a href="<?php echo e(url('/')); ?>/ideas/ajax_update_notification/<?php echo e($data->notification_id); ?>/<?php echo e($idea_id); ?>" class="btn btn-primary">View</a>
                                                        </td>
                                                   </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <h1>Ideas not posted yet!</h1>
                                    <?php endif; ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tbl-datatable').DataTable();
        });
    </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\ideaportal\resources\views/frontend/notifications/index.blade.php ENDPATH**/ ?>