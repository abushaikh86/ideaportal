<!DOCTYPE html>
<?php $__env->startSection('title', 'Sign in'); ?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Sign in</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel=" stylesheet" type="text/css" href="<?php echo e(asset('public/frontend-assets/css/toastr.min.css')); ?>">
    <link rel=" stylesheet" type="text/css" href="<?php echo e(asset('public/frontend-assets/static/css/login.css')); ?>">
</head>

<body>
    
    <main class="login-screen" style="background: url(<?php echo e(asset('/public/frontend-assets/static/images/login-bg.jpg')); ?>);">
        <div class="card">
            <div class="image">
                <img src="<?php echo e(asset('/public/frontend-assets/images/jm-baxi.jpg')); ?>" alt="">
            </div>
            <div class="form">
                <img src="<?php echo e(asset('/public/frontend-assets/images/logo.png')); ?>" alt="" class="logo">
                <h2>Login to your account</h2>
                <form action="<?php echo e(route('user.auth')); ?>" method="POST">
                    <?php if(isset($errors) && count($errors) > 0): ?>
                    <ul class="error">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <?php echo e($error); ?>

                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <?php endif; ?>

                    
                    <?php echo csrf_field(); ?>
                    <input type="email" name="email" placeholder="Enter Email" class="input" />
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="helper-text"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    
                    <input type="password" name="password" placeholder="Password" class="input" />
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="helper-text"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    
                    <?php if(request()->input('status') == 'error'): ?>
                    <div>Incorrect Password or Username</div>
                    <?php elseif(request()->input('status') == 'errorNA'): ?>
                    <div>Account under verification please contact admin</div>
                    <?php elseif(request()->input('status') == 'errorRA'): ?>
                    <div>Account is not assigned with any role please contact admin</div>
                    <?php endif; ?>
                    
                    <button type="submit">Login <i class="fal fa-long-arrow-right"></i></button>
                    <p>
                        Not registered? <a href="<?php echo e(url('/user/register')); ?>">Create an account</a>
                    </p>
                    <p>
                        Forgot Password? <a href="<?php echo e(route('user.forgot_password')); ?>">Reset Password</a>
                    </p>
                </form>
            </div>
        </div>
    </main>

    <script src="<?php echo e(asset('public/backend-assets/assets/js/jquery-3.6.1.min.js')); ?>" crossorigin="anonymous"></script>
    <script src="<?php echo e(asset('public/frontend-assets/js/toastr.min.js')); ?>"></script>
    
    <?php echo $__env->make('frontend.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH C:\wamp64\www\ideaportal\resources\views/frontend/account/userLogin.blade.php ENDPATH**/ ?>