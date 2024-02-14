<?php $__env->startSection('title', 'Admin Login'); ?>
<?php $__env->startSection('content'); ?>
    
    <style>
        @import  url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap');

        *{
            font-family: 'Lato', sans-serif !important;
        }
        body {
            font-family: "Lato", sans-serif !important;
            background-color: #00223e !important;
            position: relative;
        }
        .admin-panel{
            min-height:100vh;
            background: #00223e;
            position: relative;
            z-index: 0;
            padding: 70px 0;
        }
        .admin-panel::after{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 25%;
            background: #faa52a;
            z-index: 1;
        }
        .admin-panel .card {
            display: flex;
            align-items: stretch;
            justify-content: center;
            flex-direction: row;
            z-index: 2;
            margin-bottom: 0;
        }
        .admin-panel .card .image{
            width: 42%;
            overflow: hidden;
        }
        .admin-panel .card .image img{
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        .admin-panel .card .form{
            width: 58%;
            padding: 40px 60px;
        }
        .admin-panel .card .form img{
            width: 170px;
            margin: 0 0 15px 0 !important;
        }
        .admin-panel .card .form h2{
            color: #004460;
            font-weight: 900;
            font-size: 35px;
            margin: 0 0 20px 0 !important;
            line-height: 100%;
        }
        .admin-panel .card .form  label {
            font-size: 16px;
            font-weight: 500;
            color: #212529;
        }
        .admin-panel .card .form .form-control {
            background-color: #f3f3f3;
            line-height: 32px;
            border: 0px;
            outline: none;
            border-radius: 5px;
            color: #000;
            margin: 0 0 10px 0 !important;
        }
        .admin-panel .card .form  .form-control::placeholder {
            font-weight: 300;
            color: #eee;
        }
        .admin-panel .card .form .login-btn {
            background-color: #faa52a;
            padding: 5px 40px;
            font-weight: 700;
            font-size: 20px;
            line-height: 32px;
            border-radius: 5px;
            color: #fff;
        }
        .admin-panel .card .form .login-btn:hover {
            background-color: #004460;
            color: #fff;
        }
        @media (max-width: 1020px) {
            .admin-panel::after{
                width: 35%;
            }
            .admin-panel .card {
                flex-direction: column;
            }
            .admin-panel .card .image{
                width: 100%;
                height: 300px;
            }
            .admin-panel .card .form{
                width: 100%;
            }
            .admin-panel .card .form h2{
                font-size: 30px;
            }
        }
        @media (max-width: 767px) {
            .admin-panel::after{
                width: 40%;
            }
            .admin-panel .card .form{
                padding: 30px;
            }
            .admin-panel .card .form img{
                width: 130px
            }
            .admin-panel .card .form h2{
                font-size: 25px;
            }
        }
    </style>


    <section class="admin-panel">
        <div class="container">
            <div class="card shadow border-0 rounded-0">
                <div class="image">
                    <img src="<?php echo e(asset('public/backend-assets/images/logo/jm-baxi5.webp')); ?>" class="img-fluid" />
                </div>
                <div class="form">
                    <img src="<?php echo e(asset('public/backend-assets/images/logo/index.png')); ?>" class="img-fluid mb-3" />
                    <h2 class="mb-3">Idea Submission Portal</h2>
                    <?php echo $__env->make('backend.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <form method="POST" action="<?php echo e(route('admin.login.submit')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="exampleInputText1" class="form-label">User Name</label>
                            <input type="text" name="email" class="form-control" id="exampleInputText1" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" />
                            <a class="message text-primary" style="text-decoration: underline!important;" href="<?php echo e(route('admin.forgot_password')); ?>">Forgot Password</a>
                        </div>
                        <button type="submit" class="btn login-btn mt-1">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.fullempty', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\ideaportal\resources\views/backend/account/loginform.blade.php ENDPATH**/ ?>