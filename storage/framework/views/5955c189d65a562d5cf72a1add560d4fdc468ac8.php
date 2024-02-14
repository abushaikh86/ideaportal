
<?php $__env->startSection('title', 'User Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<?php
use App\Models\Rolesexternal;
use App\Models\frontend\Ideas;
$role = Auth::user()->role;
$roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
$user_role = $roles_external->role_type;

$roles_external1 = Rolesexternal::where(['role_type' => 'User'])
    ->pluck('id')
    ->toArray();
$curr_user_data = DB::table('users')
    ->whereRaw('FIND_IN_SET(?, sub_role)', [3])
    ->where('user_id', Auth::user()->user_id)
    ->get();

$buttons = [];
$menus = [];

if (!empty($roles_external)) {
    $buttons = explode(',', $roles_external->button_values);
}
if (!empty($roles_external)) {
    $menus = explode(',', $roles_external->menu_values);
}
?>

<?php if(in_array('menu_values', $menus) && in_array('dashboard', $menus)): ?>



<section class="cs-content">
    <div class="container-fluid">
        <div id="basic-datatable">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="card shadow db-card">
                        <div class="card-body">
                            <div class="text">
                                <h4 class="heading text-dark mb-3">Share your idea to participate</h4>
                                <p class="mb-4">Share your innovative idea and join the competition for a chance to win exciting rewards. Don't miss this opportunity!</p>
                                <a href="<?php echo e(route('ideas.addIdea')); ?>" class="btn btn-primary">Add New Idea</a>
                            </div>
                            <div class="image">
                                <img src="<?php echo e(asset('/public/frontend-assets/static/images/dashboard-banner.jpg')); ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card h-100">
                        <div class="card-header">
                            <h1>Top Idea Creator</h1>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="info-chart">
                                        <div class="head">
                                            <h6>Current Leaders</h6>
                                            <p>Goals created current month</p>
                                        </div>
                                        <div class="list">
                                            <div class="item">
                                                <img src="https://www.corporatephotographerslondon.com/wp-content/uploads/2021/06/non-smiling-LinkedIn-profile-photo.jpg" alt="">
                                                <h5>
                                                    <span>John Doe</span>
                                                    <i>15</i>
                                                </h5>
                                            </div>
                                            <div class="item">
                                                <img src="https://www.corporatephotographerslondon.com/wp-content/uploads/2021/06/non-smiling-LinkedIn-profile-photo.jpg" alt="">
                                                <h5>
                                                    <span>John Doe</span>
                                                    <i>15</i>
                                                </h5>
                                            </div>
                                            <div class="item">
                                                <img src="https://www.corporatephotographerslondon.com/wp-content/uploads/2021/06/non-smiling-LinkedIn-profile-photo.jpg" alt="">
                                                <h5>
                                                    <span>John Doe</span>
                                                    <i>15</i>
                                                </h5>
                                            </div>
                                            <div class="item">
                                                <img src="https://www.corporatephotographerslondon.com/wp-content/uploads/2021/06/non-smiling-LinkedIn-profile-photo.jpg" alt="">
                                                <h5>
                                                    <span>John Doe</span>
                                                    <i>15</i>
                                                </h5>
                                            </div>
                                            <div class="item">
                                                <img src="https://www.corporatephotographerslondon.com/wp-content/uploads/2021/06/non-smiling-LinkedIn-profile-photo.jpg" alt="">
                                                <h5>
                                                    <span>John Doe</span>
                                                    <i>15</i>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="info-chart">
                                        <div class="head bg-secondary">
                                            <h6 class="text-dark">Last month's winners</h6>
                                            <p class="text-dark">Goals created last month</p>
                                        </div>
                                        <div class="list">
                                            <div class="item">
                                                <img src="https://www.corporatephotographerslondon.com/wp-content/uploads/2021/06/non-smiling-LinkedIn-profile-photo.jpg" alt="">
                                                <h5>
                                                    <span>John Doe</span>
                                                    <i>15</i>
                                                </h5>
                                            </div>
                                            <div class="item">
                                                <img src="https://www.corporatephotographerslondon.com/wp-content/uploads/2021/06/non-smiling-LinkedIn-profile-photo.jpg" alt="">
                                                <h5>
                                                    <span>John Doe</span>
                                                    <i>15</i>
                                                </h5>
                                            </div>
                                            <div class="item">
                                                <img src="https://www.corporatephotographerslondon.com/wp-content/uploads/2021/06/non-smiling-LinkedIn-profile-photo.jpg" alt="">
                                                <h5>
                                                    <span>John Doe</span>
                                                    <i>15</i>
                                                </h5>
                                            </div>
                                            <div class="item">
                                                <img src="https://www.corporatephotographerslondon.com/wp-content/uploads/2021/06/non-smiling-LinkedIn-profile-photo.jpg" alt="">
                                                <h5>
                                                    <span>John Doe</span>
                                                    <i>15</i>
                                                </h5>
                                            </div>
                                            <div class="item">
                                                <img src="https://www.corporatephotographerslondon.com/wp-content/uploads/2021/06/non-smiling-LinkedIn-profile-photo.jpg" alt="">
                                                <h5>
                                                    <span>John Doe</span>
                                                    <i>15</i>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="info-chart">
                                        <div class="head bg-tertiary">
                                            <h6>All-Time Leaders</h6>
                                            <p>Goals created all time</p>
                                        </div>
                                        <div class="list">
                                            <div class="item">
                                                <img src="https://www.corporatephotographerslondon.com/wp-content/uploads/2021/06/non-smiling-LinkedIn-profile-photo.jpg" alt="">
                                                <h5>
                                                    <span>John Doe</span>
                                                    <i>15</i>
                                                </h5>
                                            </div>
                                            <div class="item">
                                                <img src="https://www.corporatephotographerslondon.com/wp-content/uploads/2021/06/non-smiling-LinkedIn-profile-photo.jpg" alt="">
                                                <h5>
                                                    <span>John Doe</span>
                                                    <i>15</i>
                                                </h5>
                                            </div>
                                            <div class="item">
                                                <img src="https://www.corporatephotographerslondon.com/wp-content/uploads/2021/06/non-smiling-LinkedIn-profile-photo.jpg" alt="">
                                                <h5>
                                                    <span>John Doe</span>
                                                    <i>15</i>
                                                </h5>
                                            </div>
                                            <div class="item">
                                                <img src="https://www.corporatephotographerslondon.com/wp-content/uploads/2021/06/non-smiling-LinkedIn-profile-photo.jpg" alt="">
                                                <h5>
                                                    <span>John Doe</span>
                                                    <i>15</i>
                                                </h5>
                                            </div>
                                            <div class="item">
                                                <img src="https://www.corporatephotographerslondon.com/wp-content/uploads/2021/06/non-smiling-LinkedIn-profile-photo.jpg" alt="">
                                                <h5>
                                                    <span>John Doe</span>
                                                    <i>15</i>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card h-100">
                        <div class="card-header">
                            <h1>Leader Board</h1>
                        </div>
                        <div class="card-body">
                            <div id="category-wise-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h1>Leader Board</h1>
                        </div>
                        <div class="card-body">
                            <div id="leader-board-chart" class="chart-lg"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card h-100">
                        <div class="card-header">
                            <h1>Ideas submitted this year</h1>
                        </div>
                        <div class="card-body">
                            <div id="chart-mentions" class="chart-lg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="page-wrapper d-none">
    <div class="container-fluid">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-end">
                <div class="col-6 col-sm-6 col-md-6">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">Overview</div>
                    <h2 class="page-title">Welcome to Dashboard</h2>
                </div>

                <?php if(!$curr_user_data->isEmpty() && $roles_external->role_type != 'User' && in_array('ideas_for_approval', $menus)): ?>
                    <div class="col-6 col-sm-6 col-md-6" id="option_select_ideas">
                        <label for="idea_type">Select Idea Type</label>
                        <select class="form-control" id="idea_type" name="idea_type">
                            <option value="ideas">Ideas for Approval</option>
                            <option value="my ideas">My Ideas</option>
                        </select>
                    </div>
                <?php endif; ?>
                
                <?php if($roles_external->role_type == 'User'): ?>
                    <div class="content-header-right col-6 col-sm-6 col-md-6">
                        <div class="btn-group float-md-right ms-2 " role="group"
                            aria-label="Button group with nested dropdown" style="float: right;">
                            <div class="btn-group " role="group">

                                <?php if(in_array('ideas_for_approval', $menus) && in_array('Add', $buttons)): ?>
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                        title="Add New Idea" href="<?php echo e(route('ideas.addIdea')); ?>">
                                        <i class="feather icon-plus"></i> &nbsp;Add New Idea
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-fluid">
            <h2 id="head_ideas"></h2>

            
            <div class="row row-deck row-cards" id="ideas_block">
                
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="card">
                        
                        <a href="<?php echo in_array('ideas_for_approval', $menus) ? route('ideas.index') : '#'; ?>" style="text-decoration:none;color:black;">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Total Ideas</div>
                                </div>
                                <div class="h1"><?php echo e($total_ideas); ?><span class="ideas-icon"><img
                                            src="<?php echo e(asset('public/frontend-assets/images/icon1.png')); ?>"></span>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>



                <?php if(
                    $roles_external->role_type == 'Assessment Team' ||
                        $roles_external->role_type == 'Approving Authority' ||
                        $roles_external->role_type != 'Implementation'): ?>
                    <div class="col-sm-3 col-lg-3">
                        <div class="card">
                            <a href="<?php echo in_array('ideas_for_approval', $menus) ? route('ideas.index') : '#'; ?>?st=revise_req" style="text-decoration:none;color:black;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Revise Request</div>
                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h1 mb-0 me-2"><?php echo e($revise_request); ?><span class="ideas-icon"><img
                                                    src="<?php echo e(asset('public/frontend-assets/images/icon9.png')); ?>"></span>
                                        </div>
                                        <div class="me-auto">
                                            <span class="text-green d-inline-flex align-items-center lh-1">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($roles_external->role_type != 'Implementation'): ?>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        <div class="card">
                            <a href="<?php echo in_array('ideas_for_approval', $menus) ? route('ideas.index') : '#'; ?>?st=under_asset" style="text-decoration:none;color:black;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <?php if($roles_external->role_type == 'Approving Authority'): ?>
                                            <div class="subheader">Approved Ideas</div>
                                        <?php else: ?>
                                            <div class="subheader">Under Assessment</div>
                                        <?php endif; ?>

                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h1 mb-0 me-2"><?php echo e($under_assessment); ?><span
                                                class="ideas-icon"><img
                                                    src="<?php echo e(asset('public/frontend-assets/images/icon5.png')); ?>"></span>
                                        </div>
                                        <div class="me-auto">
                                            <span class="text-green d-inline-flex align-items-center lh-1">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        <div class="card">
                            <a href="<?php echo in_array('ideas_for_approval', $menus) ? route('ideas.index') : '#'; ?>?st=under_approv" style="text-decoration:none;color:black;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Under Approval</div>

                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h1 mb-0 me-2"><?php echo e($under_approving); ?><span
                                                class="ideas-icon"><img
                                                    src="<?php echo e(asset('public/frontend-assets/images/icon8.png')); ?>"></span>
                                        </div>
                                        <div class="me-auto">
                                            <span class="text-green d-inline-flex align-items-center lh-1">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>


                <?php if($roles_external->role_type != 'Assessment Team' || $roles_external->role_type != 'Approving Authority'): ?>
                    <?php if($roles_external->role_type != 'Implementation'): ?>
                        <?php if($roles_external->role_type != 'Assessment Team'): ?>
                            <?php if($roles_external->role_type != 'Approving Authority'): ?>
                                <div class="col-sm-3 col-lg-3">
                                    <div class="card">
                                        <a href="<?php echo in_array('ideas_for_approval', $menus) ? route('ideas.index') : '#'; ?>?st=approved_ideas"
                                            style="text-decoration:none;color:black;">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="subheader">Approved Ideas</div>
                                                </div>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="h1 mb-0 me-2"><?php echo e($approved_ideas); ?><span
                                                            class="ideas-icon"><img
                                                                src="<?php echo e(asset('public/frontend-assets/images/icon2.png')); ?>"></span>
                                                    </div>
                                                    <div class="me-auto">
                                                        <span
                                                            class="text-green d-inline-flex align-items-center lh-1">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php endif; ?>

                <?php if(
                    $roles_external->role_type == 'Assessment Team' ||
                        $roles_external->role_type == 'Approving Authority' ||
                        $roles_external->role_type == 'Implementation'): ?>
                    <div class="col-sm-3 col-lg-3">
                        <div class="card">
                            <a href="<?php echo in_array('my_ideas', $menus) ? route('ideas.index') : '#'; ?>?st=implementation"
                                style="text-decoration:none;color:black;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Under Implementation</div>

                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h1 mb-0 me-2"><?php echo e($implementation); ?><span
                                                class="ideas-icon"><img
                                                    src="<?php echo e(asset('public/frontend-assets/images/icon9.png')); ?>"></span>
                                        </div>
                                        <div class="me-auto">
                                            <span class="text-green d-inline-flex align-items-center lh-1">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="card">
                        <a href="<?php echo in_array('ideas_for_approval', $menus) ? route('ideas.index') : '#'; ?>?st=implemented" style="text-decoration:none;color:black;">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Implemented Ideas</div>
                                </div>
                                <div class="d-flex align-items-baseline">
                                    <div class="h1 mb-0 me-2"><?php echo e($implemented); ?><span class="ideas-icon"><img
                                                src="<?php echo e(asset('public/frontend-assets/images/icon8.png')); ?>"></span>
                                    </div>
                                    <div class="me-auto">
                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <?php if(
                    $roles_external->role_type == 'Assessment Team' ||
                        $roles_external->role_type == 'Approving Authority' ||
                        $roles_external->role_type != 'Implementation'): ?>
                    <div class="col-sm-3 col-lg-3">
                        <div class="card">
                            <a href="<?php echo in_array('ideas_for_approval', $menus) ? route('ideas.index') : '#'; ?>?st=rejected" style="text-decoration:none;color:black;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Rejected</div>

                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h1 mb-0 me-2"><?php echo e($rejected); ?><span
                                                class="ideas-icon"><img
                                                    src="<?php echo e(asset('public/frontend-assets/images/icon7.png')); ?>"></span>
                                        </div>
                                        <div class="me-auto">
                                            <span class="text-green d-inline-flex align-items-center lh-1">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>


            </div>
            <br>
            
            <?php if($roles_external->role_type != 'User'): ?>
                <div class="row row-deck row-cards" id="myideas_block">
                    
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        <div class="card">
                            <a href="<?php echo in_array('my_ideas', $menus) ? route('myideas.index') : '#'; ?>" style="text-decoration:none;color:black;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Total Ideas</div>
                                    </div>
                                    <div class="h1"><?php echo e($total_ideas1); ?><span class="ideas-icon"><img
                                                src="<?php echo e(asset('public/frontend-assets/images/icon1.png')); ?>"></span>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>




                    <?php if(
                        $roles_external->role_type == 'Assessment Team' ||
                            $roles_external->role_type == 'Approving Authority' ||
                            $roles_external->role_type == 'Implementation'): ?>
                        <div class="col-sm-3 col-lg-3">
                            <div class="card">
                                <a href="<?php echo in_array('my_ideas', $menus) ? route('myideas.index') : '#'; ?>?st=revise_req"
                                    style="text-decoration:none;color:black;">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="subheader">Revise Request</div>
                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div class="h1 mb-0 me-2"><?php echo e($revise_request1); ?><span
                                                    class="ideas-icon"><img
                                                        src="<?php echo e(asset('public/frontend-assets/images/icon9.png')); ?>"></span>
                                            </div>
                                            <div class="me-auto">
                                                <span class="text-green d-inline-flex align-items-center lh-1">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">

                        <div class="card">
                            <a href="<?php echo in_array('my_ideas', $menus) ? route('myideas.index') : '#'; ?>?st=under_asset"
                                style="text-decoration:none;color:black;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Under Assessment</div>

                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h1 mb-0 me-2"><?php echo e($under_assessment1); ?><span
                                                class="ideas-icon"><img
                                                    src="<?php echo e(asset('public/frontend-assets/images/icon5.png')); ?>"></span>
                                        </div>
                                        <div class="me-auto">
                                            <span class="text-green d-inline-flex align-items-center lh-1">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">

                        <div class="card">
                            <a href="<?php echo in_array('my_ideas', $menus) ? route('myideas.index') : '#'; ?>?st=under_approv"
                                style="text-decoration:none;color:black;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Under Approval</div>

                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h1 mb-0 me-2"><?php echo e($under_approving1); ?><span
                                                class="ideas-icon"><img
                                                    src="<?php echo e(asset('public/frontend-assets/images/icon8.png')); ?>"></span>
                                        </div>
                                        <div class="me-auto">
                                            <span class="text-green d-inline-flex align-items-center lh-1">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php if(
                        $roles_external->role_type == 'Assessment Team' ||
                            $roles_external->role_type == 'Approving Authority' ||
                            $roles_external->role_type == 'Implementation'): ?>
                        <div class="col-sm-3 col-lg-3">
                            <div class="card">
                                <a href="<?php echo in_array('my_ideas', $menus) ? route('myideas.index') : '#'; ?>?st=approved_ideas"
                                    style="text-decoration:none;color:black;">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="subheader">Approved Ideas</div>
                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div class="h1 mb-0 me-2"><?php echo e($approved_ideas1); ?><span
                                                    class="ideas-icon"><img
                                                        src="<?php echo e(asset('public/frontend-assets/images/icon2.png')); ?>"></span>
                                            </div>
                                            <div class="me-auto">
                                                <span class="text-green d-inline-flex align-items-center lh-1">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(
                        $roles_external->role_type == 'Assessment Team' ||
                            $roles_external->role_type == 'Approving Authority' ||
                            $roles_external->role_type == 'Implementation'): ?>
                        <div class="col-sm-3 col-lg-3">
                            <div class="card">
                                <a href="<?php echo in_array('my_ideas', $menus) ? route('myideas.index') : '#'; ?>?st=implementation"
                                    style="text-decoration:none;color:black;">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="subheader">Under Implementation</div>

                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div class="h1 mb-0 me-2"><?php echo e($implementation1); ?><span
                                                    class="ideas-icon"><img
                                                        src="<?php echo e(asset('public/frontend-assets/images/icon9.png')); ?>"></span>
                                            </div>
                                            <div class="me-auto">
                                                <span class="text-green d-inline-flex align-items-center lh-1">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        <div class="card">
                            <a href="<?php echo in_array('my_ideas', $menus) ? route('myideas.index') : '#'; ?>?st=implemented"
                                style="text-decoration:none;color:black;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Implemented Ideas</div>
                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h1 mb-0 me-2"><?php echo e($implemented1); ?><span
                                                class="ideas-icon"><img
                                                    src="<?php echo e(asset('public/frontend-assets/images/icon8.png')); ?>"></span>
                                        </div>
                                        <div class="me-auto">
                                            <span class="text-green d-inline-flex align-items-center lh-1">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <?php if(
                        $roles_external->role_type == 'Assessment Team' ||
                            $roles_external->role_type == 'Approving Authority' ||
                            $roles_external->role_type == 'Implementation'): ?>
                        <div class="col-sm-3 col-lg-3">
                            <div class="card">
                                <a href="<?php echo in_array('my_ideas', $menus) ? route('myideas.index') : '#'; ?>?st=rejected"
                                    style="text-decoration:none;color:black;">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="subheader">Rejected</div>

                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div class="h1 mb-0 me-2"><?php echo e($rejected1); ?><span
                                                    class="ideas-icon"><img
                                                        src="<?php echo e(asset('public/frontend-assets/images/icon7.png')); ?>"></span>
                                            </div>
                                            <div class="me-auto">
                                                <span class="text-green d-inline-flex align-items-center lh-1">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>


                </div>
            <?php endif; ?>

            <?php

            ?>
            

            <br>

            <div class="col-lg-12">
                <div class="row row-cards">
                </div>
            </div>
            
        </div>

    </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<script>
    function getNumber() {
        const arr_res = [];
        const obj_res = <?php echo json_encode($response); ?>

        obj_res.map((e) => {
            arr_res.push(e.y);
        })
        var largest = 0;

        for (i = 0; i < arr_res.length; i++) {
            if (arr_res[i] > largest) {
                largest = arr_res[i];
            }
        }
        return largest < 10 ? 10 : largest;
    }




    $(document).ready(function() {
        //console.log((<?php echo json_encode($response); ?>));
        var options = {
            chart: {
                height: 350,
                type: 'bar',
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                name: 'Ideas',
                // data: [],
                data: <?php echo json_encode($response); ?>,
            }],
            yaxis: {
                max: getNumber
            },
            title: {
                text: 'Ideas',
            },
            noData: {
                text: 'Loading...'
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart-mentions"), options
        );

        chart.render();


        // url = '<?php echo e(url('ideas/getChartValues')); ?>';
        // $.getJSON(url, function(response) {
        //     // var jsonData = JSON.parse(response);
        //     // var return_data = jsonData.response;
        //     //console.log(response);
        //     chart.updateSeries([{
        //         name: 'Ideas',
        //         data: response
        //     }])
        // });

    })

    $(document).ready(function() {


        var user_data_exists = <?php echo json_encode($curr_user_data); ?>;
        var role = '<?php echo $user_role; ?>';
        if (user_data_exists == '') {
            localStorage.setItem('ideas', 'ideas');
        }




        if (role != 'User') {

            if (localStorage.getItem('ideas')) {
                $('#idea_type option[value="' + localStorage.getItem('ideas') + '"]').attr('selected',
                    'selected');
            } else {
                var default_selected = $('#idea_type').find(":selected").val();
                if (default_selected == 'ideas') {
                    localStorage.setItem('ideas', 'ideas');
                } else {
                    localStorage.setItem('ideas', 'my ideas');
                }
            }

            var idea_type = localStorage.getItem('ideas');
            $('#idea_type option[value="' + idea_type + '"]').attr('selected', 'selected');

            $('#head_ideas').html(idea_type.toUpperCase());
            if (idea_type == 'ideas') {
                $('#ideas_block').show();
                $('#myideas_block').hide();
            } else {
                $('#myideas_block').show();
                $('#ideas_block').hide();
            }
        }
        // }
    });

    $('#idea_type').change(function() {




        var default_selected = $('#idea_type').find(":selected").val();

        if (default_selected == 'ideas') {
            localStorage.setItem('ideas', 'ideas');
        } else {
            localStorage.setItem('ideas', 'my ideas');
        }


        var idea_type = localStorage.getItem('ideas');
        $('#idea_type option').attr('selected', false);
        $('#idea_type option[value="' + idea_type + '"]').attr('selected', 'selected');

        $("#option_select_ideas select").val(idea_type);
        // var idea_type = $(this).val();
        $('#head_ideas').html(idea_type.toUpperCase());
        if (idea_type == 'ideas') {
            $('#ideas_block').show();
            $('#myideas_block').hide();
        } else {
            $('#myideas_block').show();
            $('#ideas_block').hide();
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Replace these counts with your actual counts
        var totalCount = <?php echo e($total_ideas); ?>;
        var pendingCount = <?php echo e($pending); ?>;
        var underAssessmentCount = <?php echo e($under_assessment); ?>;
        var underApprovingCount = <?php echo e($under_approving); ?>;
        var approvedCount = <?php echo e($approved_ideas); ?>;
        var implementationCount = <?php echo e($implementation); ?>;
        var implementedCount = <?php echo e($implemented); ?>;
        var onHoldCount = <?php echo e($on_hold); ?>;
        var reviseRequestCount = <?php echo e($revise_request); ?>;
        var rejectedCount = <?php echo e($rejected); ?>;

        var weights = {
            pending: 0.0,
            underAssessment: 0.1,
            underApproving: 0.1,
            approved: 0.2,
            implementation: 0.3,
            implemented: 0.3,
            onHold: 0.0, // Subtract some score for on-hold
            reviseRequest: -0.2, // Subtract more score for revise request
            rejected: -1 // Rejects contribute negatively to the overall score
        };

        var weightedSum =
            pendingCount * weights.pending +
            underAssessmentCount * weights.underAssessment +
            underApprovingCount * weights.underApproving +
            approvedCount * weights.approved +
            implementationCount * weights.implementation +
            implementedCount * weights.implemented +
            onHoldCount * weights.onHold +
            reviseRequestCount * weights.reviseRequest +
            rejectedCount * weights.rejected;

        // Normalize the weighted sum to a percentage

        var overallPercentage = ((weightedSum / totalCount) + 1) *
            50; // Adding 1 and multiplying by 50 to get a percentage in the range [0, 100]

        // Update the progress bar width and text
        if (weightedSum == 0 || overallPercentage == 0) {
            document.getElementById("myProgressBar").style.width = 1 + "%";
            document.getElementById("myProgressBar").textContent = Math.round(0) + "%";
        } else {
            document.getElementById("myProgressBar").style.width = overallPercentage + "%";
            document.getElementById("myProgressBar").textContent = Math.round(overallPercentage) + "%";
        }
    });
</script>

<script>
    // Leader Board Chart
    const leaderBoardChart = () => {
        let options = {
            series: [
                {
                    name: "",
                    data: [50, 25, 20, 30],
                },
            ],
            chart: {
                type: 'bar',
                height: 350,
            },
            plotOptions: {
                bar: {
                    borderRadius: 0,
                    horizontal: true,
                    distributed: true,
                    barHeight: '80%',
                    isFunnel: true,
                },
            },
            colors: [
                '#4a6fff',
                '#4dc87d',
                '#f4314c',
                '#ffbd4a',
            ],
            dataLabels: {
                enabled: true,
                formatter: function (val, opt) {
                    return opt.w.globals.labels[opt.dataPointIndex]
                },
                dropShadow: {
                    enabled: true,
                },
            },
            title: {
                text: 'Idea Status',
                align: 'left',
            },
            xaxis: {
                categories: ['Top Rated', 'On Hold', 'Revised', 'Reviewed'],
            },
            legend: {
                show: false,
            },
        };

        let chart = new ApexCharts(document.querySelector("#leader-board-chart"), options);
        chart.render();
    }
    leaderBoardChart();

    // Category Wise Ideas Chart
    const categoryWiseChart = () => {
        let options = {
            series: [25, 50, 20, 30],
            chart: {
                type: 'polarArea',
            },
            fill: {
                opacity: 0.8
            },
            stroke: {
                colors: ['#fff']
            },
            labels: ['Process Changed', 'Automation', 'Cost Saving', 'Product'],
            yaxis: {
                show: false
            },
            colors: [
                '#4a6fff',
                '#4dc87d',
                '#f4314c',
                '#ffbd4a',
            ],
            legend: {
                position: 'bottom'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
        };

        const chart = new ApexCharts(document.querySelector("#category-wise-chart"), options);
        chart.render();
    }
    categoryWiseChart();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\ideaportal\resources\views/frontend/users/dashboard.blade.php ENDPATH**/ ?>