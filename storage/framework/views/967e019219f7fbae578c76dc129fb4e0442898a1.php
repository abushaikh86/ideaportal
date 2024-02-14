<?php $__env->startSection('title', 'Add File Setting'); ?>
<?php
    use Spatie\Permission\Models\Role;
?>
<?php $__env->startSection('content'); ?>

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">Add File Setting</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('admin.filesetting')); ?>">File Setting</a>
                        </li>

                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <a class="btn btn-outline-primary" href="<?php echo e(route('admin.filesetting')); ?>">
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
                            
                            <?php echo $__env->make('backend.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo e(Form::open([
                                'url' => 'admin/filesetting/store',
                                'method' => 'post',
                            ])); ?>

                            <?php echo csrf_field(); ?>
                            <div class="form-body">
                                <div class="row">
                                    <?php
                                     $allowedExtensionsString = "jpg,jpeg,png,gif,bmp,tiff,webp,mp3,wav,ogg,flac,aac,mp4,avi,mkv,mov,flv,wmv,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar";
                                     $extensions = explode(',', $allowedExtensionsString);
                                    ?>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <?php echo e(Form::label('allowed_extetnsion', 'Extension *')); ?>

                                            <?php echo Form::select('allowed_extetnsion',$extensions ,
                                            null, ['class' => 'form-control ','id'=>'tags']); ?>

                                            
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <?php echo e(Form::label('file_size', 'File Size (In mb) *')); ?>

                                            <?php echo e(Form::number('file_size', null, ['class' => 'form-control', 'placeholder' => 'Enter File Size', 'required' => true])); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col md-12">
                                    <?php echo e(Form::submit('Add', ['class' => 'btn btn-primary mr-1 mb-1'])); ?>

                                    <button type="reset" class="btn btn-dark mr-1 mb-1">Reset</button>
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                </div>
            </div>

    </section>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/idea_portal/resources/views/backend/filesetting/create.blade.php ENDPATH**/ ?>