<<<<<<<< HEAD:storage/framework/views/5099b3e316a99a261a40b04cc7509bd02f5de470.php
<?php $__env->startSection('title', 'Edit File Setting'); ?>
<?php
========
@extends('backend.layouts.app')
@section('title', 'Edit SLA')
@php
>>>>>>>> ab0961994c66a7079b38c92d78c7cdda05e8c801:old_files/resources_2024_01_29/views/backend/sla/edit.blade.php
    use Spatie\Permission\Models\Role;
@endphp
@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">Edit File Setting</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>

                        <li class="breadcrumb-item">
<<<<<<<< HEAD:storage/framework/views/5099b3e316a99a261a40b04cc7509bd02f5de470.php
                            <a href="<?php echo e(route('admin.filesetting')); ?>">File Setting</a>
========
                            <a href="{{ route('admin.sla') }}">SLA</a>
>>>>>>>> ab0961994c66a7079b38c92d78c7cdda05e8c801:old_files/resources_2024_01_29/views/backend/sla/edit.blade.php
                        </li>

                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
<<<<<<<< HEAD:storage/framework/views/5099b3e316a99a261a40b04cc7509bd02f5de470.php
                    <a class="btn btn-outline-primary" href="<?php echo e(route('admin.filesetting')); ?>">
========
                    <a class="btn btn-outline-primary" href="{{ route('admin.sla')  }}">
>>>>>>>> ab0961994c66a7079b38c92d78c7cdda05e8c801:old_files/resources_2024_01_29/views/backend/sla/edit.blade.php
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
                            @include('backend.includes.errors')
                            {!! Form::model($data, [
                                'method' => 'POST',
                                'url' => ['admin/filesetting/update'],
                                'class' => 'form',
                            ]) !!}
                            {{ Form::hidden('id', $data->id, ['class' => 'form-control']) }}
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <?php
                                      $allowedExtensionsString = "jpg,jpeg,png,gif,bmp,tiff,webp,mp3,wav,ogg,flac,aac,mp4,avi,mkv,mov,flv,wmv,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar";
                                      $extensions = explode(',', $allowedExtensionsString);
                                      
                                    ?>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
<<<<<<<< HEAD:storage/framework/views/5099b3e316a99a261a40b04cc7509bd02f5de470.php
                                            <?php echo e(Form::label('allowed_extetnsion', 'Extension *')); ?>

                                            <?php echo Form::select('allowed_extetnsion',$extensions ,
                                            $extensions_ex, ['class' => 'form-control ','id'=>'tags']); ?>

                                            
========
                                            {{ Form::label('role_id', 'Role *') }}
                                            {{ Form::select('role_id', $external_roles, null, ['class' => 'form-control', 'placeholder' => 'Select Role', 'required' => true]) }}
>>>>>>>> ab0961994c66a7079b38c92d78c7cdda05e8c801:old_files/resources_2024_01_29/views/backend/sla/edit.blade.php
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
<<<<<<<< HEAD:storage/framework/views/5099b3e316a99a261a40b04cc7509bd02f5de470.php
                                            <?php echo e(Form::label('file_size', 'File Size (In mb) *')); ?>

                                            <?php echo e(Form::number('file_size', null, ['class' => 'form-control', 'placeholder' => 'Enter File Size', 'required' => true])); ?>

========
                                            {{ Form::label('deadline_days', 'DeadLine Days *') }}
                                            {{ Form::number('deadline_days', null, ['class' => 'form-control', 'placeholder' => 'Enter DeadLine Days', 'required' => true]) }}
>>>>>>>> ab0961994c66a7079b38c92d78c7cdda05e8c801:old_files/resources_2024_01_29/views/backend/sla/edit.blade.php
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col md-12">
                                {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                                <button type="reset" class="btn btn-dark mr-1 mb-1">Reset</button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

    </section>


<<<<<<<< HEAD:storage/framework/views/5099b3e316a99a261a40b04cc7509bd02f5de470.php
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/idea_portal/resources/views/backend/filesetting/edit.blade.php ENDPATH**/ ?>
========
@endsection
>>>>>>>> ab0961994c66a7079b38c92d78c7cdda05e8c801:old_files/resources_2024_01_29/views/backend/sla/edit.blade.php
