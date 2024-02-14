
<?php $__env->startSection('title', 'Create External User Role'); ?>

<?php $__env->startSection('content'); ?>
<?php

use App\Models\backend\BackendMenubar;
use App\Models\backend\BackendSubMenubar;
use Spatie\Permission\Models\Permission;


$user_id = Auth()->guard('admin')->user()->id;

// $backend_menubar = BackendMenubar::Where(['visibility'=>1])->orderBy('sort_order')->get();
?>
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">External User</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">External User</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                <a class="btn btn-outline-primary" href="<?php echo e(route('admin.rolesexternal')); ?>">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <?php echo $__env->make('backend.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <form method="POST" action="<?php echo e(route('admin.rolesexternal.store')); ?>" class="form">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12 col-12" style="margin-bottom:20px !important;">
                                        <div class="form-label-group">
                                            <?php echo e(Form::label('role_name', 'Role Name *')); ?>

                                            <?php echo e(Form::text('role_name', null, ['class' => 'form-control', 'placeholder'
                                            => 'Enter Role Name', 'required' => true])); ?>


                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12" style="margin-bottom:20px !important;">
                                        <div class="form-group">
                                            <?php echo e(Form::label('role_type', 'Role Type *')); ?>

                                            <?php echo Form::select('role_type',[''=>'Select Role','User'=>'User',
                                            'Assessment Team'=> 'Assessment Team',
                                            'Approving Authority' => 'Approving Authority',
                                            'Implementation' => 'Implementation', 'MIS User'] ,
                                            null, ['class' => 'form-control','id'=>'role_type','required' => true]); ?>

                                        </div>
                                    </div>

                                    
                                    

                                    
                                    <div class="col-md-12 col-12 internal-user external_user_cat_data d-none">
                                    </div>

                                    
                                    <div class="col-md-12 col-12 internal-user external_user_st_data d-none">
                                    </div>


                                    
                                    <div class="col-md-12 col-12 internal-user external_user_men_data d-none">
                                    </div>


                                    


                                    
                                    <div class="col-md-12 col-12 internal-user external_user_btn_data d-none">
                                    </div>

                                    

                                    <div class="col-12 d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                        <button type="reset"
                                            class="btn btn-secondary mr-1 mb-1 text-white">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('role_type').addEventListener('change', function () {
         var type_id = this.value;
         get_dynamic_categories(type_id);
         get_dynamic_status(type_id);
         get_dynamic_menus(type_id);
         get_dynamic_buttons(type_id);
       });
    </script>



</section>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\ideaportal\resources\views/backend/rolesexternal/create.blade.php ENDPATH**/ ?>