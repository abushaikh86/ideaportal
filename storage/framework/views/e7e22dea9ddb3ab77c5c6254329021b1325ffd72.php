<?php
use App\Models\frontend\Department;
use App\Models\backend\Company;
use App\Models\backend\Designation;
use App\Models\backend\Location;
?>

<!DOCTYPE html>
<?php $__env->startSection('title', 'Sign Up'); ?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Sign Up</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel=" stylesheet" type="text/css" href="<?php echo e(asset('public/frontend-assets/css/toastr.min.css')); ?>">
    <link rel=" stylesheet" type="text/css" href="<?php echo e(asset('public/frontend-assets/static/css/login.css')); ?>">
</head>

<body>

    
    <main class="auth-screen" style="background: url(<?php echo e(asset('/public/frontend-assets/static/images/login-bg.jpg')); ?>);">
        <div class="card shadow border-0">
            <form action="<?php echo e(route('user.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="image">
                    <img src="<?php echo e(asset('/public/frontend-assets/images/logo.png')); ?>" alt="">
                    <h2>Create an account</h2>
                </div>
                <div class="form">
                    <div class="item">
                        <input type="text" name="name" value="<?php echo e(old('name')); ?>" placeholder="Enter Name *" required />
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="item">
                        <input type="text" name="last_name" value="<?php echo e(old('last_name')); ?>" placeholder="Enter Last Name *" required />
                        <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="item">
                        <input type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Enter Email *" required />
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="item">
                        <input type="text" name="mobile_no" value="<?php echo e(old('mobile_no')); ?>" placeholder="Enter Mobile No. *" required />
                        <?php $__errorArgs = ['mobile_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="item">
                        <select id="department" name="department" class="" required>
                            <option value="" selected>Select Department *</option>
                            <?php $__currentLoopData = Department::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty(old('department') && old('department') == $item['department_id'])): ?>
                                    <option value="<?php echo e(old('department')); ?>" selected>
                                        <?php echo e($item['name']); ?>

                                    </option>
                                <?php else: ?>
                                    <option value="<?php echo e($item['department_id']); ?>">
                                        <?php echo e($item['name']); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['department'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="item">
                        <select id="company_id" name="company_id" class="form-select" required>
                            <option value="" selected>Select Company *</option>
                            <?php $__currentLoopData = Company::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty(old('company_id') && old('company_id') == $item['company_id'])): ?>
                                    <option value="<?php echo e(old('company_id')); ?>" selected>
                                        <?php echo e($item['company_name']); ?>

                                    </option>
                                <?php else: ?>
                                    <option value="<?php echo e($item['company_id']); ?>">
                                        <?php echo e($item['company_name']); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['company_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="item">
                        <select id="designation_id" name="designation_id" class="form-select" required>
                            <option value="" selected>Select Designation *</option>
                            <?php $__currentLoopData = Designation::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty(old('designation_id') && old('designation_id') == $item['designation_id'])): ?>
                                    <option value="<?php echo e(old('designation_id')); ?>" selected>
                                        <?php echo e($item['designation_name']); ?>

                                    </option>
                                <?php else: ?>
                                    <option value="<?php echo e($item['designation_id']); ?>">
                                        <?php echo e($item['designation_name']); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['designation_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="item">
                        <select id="location" name="location" class="form-select" required>
                            <option value="" selected>Select Location *</option>
                            <?php $__currentLoopData = Location::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty(old('location') && old('location') == $item['location_id'])): ?>
                                    <option value="<?php echo e(old('location')); ?>" selected>
                                        <?php echo e($item['location_name']); ?>

                                    </option>
                                <?php else: ?>
                                    <option value="<?php echo e($item['location_id']); ?>">
                                        <?php echo e($item['location_name']); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="item">
                        <input type="password" onkeypress="return event.charCode != 32" name="password" value="<?php echo e(old('password')); ?>" placeholder="Enter Password *" data-toggle="tooltip" data-placement="top" title="Password Must Contains Atleat 6 Character With One Special Character, Capital Letter And Digit" required />
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="item">
                        <input id='password' onkeypress="return event.charCode != 32" type="password" name="password_confirmation" placeholder="Confirm Password *" required />
                        <?php $__errorArgs = ['confirm_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <span class="helper-text">
                        <b>Note:</b> Password Must Contains Atleat 6 Character With One Special Character, Capital Letter And Digit
                    </span>
                </div>
                <button type="submit">Create Account <i class="fal fa-long-arrow-right"></i></button>
                <p>Already have account? <a href="<?php echo e(url('/')); ?>">Sign In</a></p>
            </form>
        </div>
    </main>

    <script src="<?php echo e(asset('public/backend-assets/assets/js/jquery-3.6.1.min.js')); ?>" crossorigin="anonymous"></script>
    <script src="<?php echo e(asset('public/frontend-assets/js/toastr.min.js')); ?>"></script>

    <?php echo $__env->make('frontend.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH /var/www/html/ideaportal/resources/views/frontend/account/registration.blade.php ENDPATH**/ ?>