<?php
use App\Models\frontend\Department;
?>

<?php $__env->startSection('title', 'User Dashboard | Edit Profile'); ?>

<?php $__env->startSection('content'); ?>


<section class="cs-breadcrumb">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('user.dashboard')); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Edit Profile</li>
        </ol>
    </div>
</section>


<section class="cs-content">
    <div class="container-fluid">
        <div id="basic-datatable">
            <div class="card">
                <div class="card-header">
                    <h1>Edit Profile</h1>
                    <a class="btn btn-outline-primary" href="<?php echo e(route('ideas.index')); ?>">
                        <i class="fa fa-angle-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <?php echo $__env->make('backend.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo Form::model($userdata, [
                    'method' => 'POST',
                    'url' => ['/user/updateProfile'],
                    'class' => 'form'
                    ]); ?>

                    <?php echo csrf_field(); ?>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('first_name', 'First Name *')); ?>

                                <?php echo e(Form::hidden('user_id', $userdata->user_id, ['class' =>
                                'form-control'])); ?>

                                <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' =>
                                'Enter First Name', 'required' => true])); ?>

                            </div>
                        </div>
    
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('last_name', 'Last Name *')); ?>

                                <?php echo e(Form::text('last_name', null, ['class' => 'form-control', 'placeholder'
                                =>
                                'Enter Last Name', 'required' => true])); ?>

                            </div>
                        </div>
    
    
                        <div class="col-md-6 col-12">
                            <div class="form-label-group">
                                <?php echo e(Form::label('email', 'Email *')); ?>

                                <?php echo e(Form::text('email', null, ['class' => 'form-control', 'placeholder' =>
                                'Enter
                                Email', 'required' => true, 'readonly'=>true])); ?>

    
                            </div>
                        </div>
    
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('mobile_no', 'Mobile No. *')); ?>

                                <?php echo e(Form::text('mobile_no', null, ['class' => 'form-control', 'placeholder'
                                =>
                                'Enter Last Name', 'required' => true])); ?>

                            </div>
                        </div>
    
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('department', 'Department *')); ?>

                                <?php echo Form::select('department',
                                $department,
                                null,
                                ['class' => 'form-select', 'placeholder' => 'Select department', 'required'
                                => true]); ?>

                            </div>
                        </div>
    
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('company_id', 'Company *')); ?>

                                <?php echo Form::select('company_id', $company,
                                null,
                                ['class' => 'form-select', 'placeholder' => 'Select Company', 'required' =>
                                true]); ?>

                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('designation_id', 'Designation *')); ?>

                                <?php echo Form::select('designation_id',
                                $designation,
                                null,
                                ['class' => 'form-select', 'placeholder' => 'Select Designation',
                                'required' => true]); ?>

                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('location', 'Location *')); ?>

                                <?php echo Form::select('location',
                                $location,
                                null,
                                ['class' => 'form-select', 'placeholder' => 'Select Location', 'required'
                                => true]); ?>

                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1'])); ?>

                    <button type="reset" class="btn btn-secondary mr-1 mb-1">Reset</button>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ideaportal/resources/views/frontend/users/editProfile.blade.php ENDPATH**/ ?>