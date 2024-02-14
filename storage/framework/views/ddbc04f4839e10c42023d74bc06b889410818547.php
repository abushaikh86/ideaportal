<?php

use App\Models\frontend\Users;
use App\Models\backend\AdminUsers;
use App\Models\frontend\IdeaStatus;
use App\Models\frontend\Feedback;
use App\Models\frontend\IdeaImages;
use App\Models\Rolesexternal;
$ALL_VIDEO_EXTENSIONS = ['flv','webm','avchd','mkv','3gpp','mpeg','mpeg-4','mts','hevc','ogg','proress','mp4'];

// usama_14-02-2024- available users to chat
$other_users = Feedback::where('idea_id', $idea->idea_id)
->orWhere('user_id', $idea->user_id)
->pluck('user_id')
->toArray();
$get_users = Users::whereIn('user_id', $other_users)->where('user_id', '!=', Auth::id())->get();
?>
<?php
$status_buttons = [];

$roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
$role = $roles_external->role_type;

if(!empty($roles_external)){
$status_buttons = explode(',',$roles_external->status_values);
}
$idea_status = IdeaStatus::where('idea_id',$idea->idea_id)->get();
?>

<?php $__env->startSection('title', 'User Dashboard | View Idea'); ?>

<?php $__env->startSection('content'); ?>


<section class="cs-breadcrumb">
    <div class="container-fluid">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <h1>View Idea</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('user.dashboard')); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">View Idea</li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Back"
                     <?php if(session()->has('main_page')): ?> href="<?php echo e(session('main_page')); ?> " <?php else: ?> href="<?php echo e(route('ideas.index')); ?>" <?php endif; ?>>
                        <i style="margin-right:6px;font-size:1.1em;" class="fa fa-angle-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Timeline Modal -->
<div class="modal fade timeline-modal show" id="statusTimelineModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="statusTimelineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-times"></i>
            </button>
            <div class="modal-body">
                <h6 class="heading mb-4" id="statusTimelineModalLabel">Status Timeline </h1>
                    <ul class="time-line">
                        

                        <?php $__currentLoopData = $idea_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $is): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php if($is->idea_status == 'rejected'): ?>
                        <?php if(isset($is['user_id'])): ?>
                        <?php
                        $user_name = Users::where('user_id', $is['user_id'])->first();
                        $date = explode(' ', $is['created_at']);
                        ?>
                        <li class="item">
                            <p>Idea has been rejected by
                                <span>
                                    <?php if(isset($user_name['name'])): ?>
                                    <?php echo e($user_name['name']); ?>

                                    <?php echo e($user_name['last_name']); ?>

                                    <?php endif; ?>


                                    <?php if(isset($is->user_role)): ?>
                                    &#40;
                                    <i class="text-assessment"><?php echo e($is->user_role); ?></i>
                                    &#41;
                                    <?php endif; ?>
                                </span>

                                <i> on <?php echo e($date[0]); ?> at
                                    <?php echo e($date[1]); ?></i>
                            </p>
                        </li>
                        <?php if(isset($is['user_id'])): ?>
                        <?php

                        $user_name = Users::where('user_id', $is['user_id'])->first();
                        $date = explode(' ', $is['created_at']);
                        ?>
                        <li class="item">
                            <p>Idea send for Revision by
                                <span>
                                    <?php if(isset($user_name['name'])): ?>
                                    <?php echo e($user_name['name']); ?>

                                    <?php echo e($user_name['last_name']); ?>

                                    <?php endif; ?>


                                    <?php if(isset($is->user_role)): ?>
                                    &#40;
                                    <i class="text-assessment"><?php echo e($is->user_role); ?></i>
                                    &#41;
                                    <?php endif; ?>
                                </span>

                                <i> on <?php echo e($date[0]); ?> at
                                    <?php echo e($date[1]); ?></i>
                            </p>
                        </li>

                        
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php elseif($is->idea_status == 'assessment_team_approved'): ?>
                        <?php if(isset($is['user_id'])): ?>
                        <?php
                        $user_name = Users::where('user_id', $is['user_id'])->first();
                        $date = explode(' ', $is['created_at']);
                        ?>
                        <li class="item">
                            <p>
                                
                                Idea has been approved by
                                <span>
                                    <?php if(isset($user_name['name'])): ?>
                                    <?php echo e($user_name['name']); ?>

                                    <?php echo e($user_name['last_name']); ?>

                                    <?php endif; ?>


                                    <?php if(isset($is->user_role)): ?>
                                    &#40;
                                    <i class="text-assessment"><?php echo e($is->user_role); ?></i>
                                    &#41;
                                    <?php endif; ?>
                                </span>

                                <i> on <?php echo e($date[0]); ?> at
                                    <?php echo e($date[1]); ?></i>
                            </p>
                        </li>
                        <?php endif; ?>
                        <?php elseif($is->idea_status == 'approving_authority_approved'): ?>
                        <?php if(isset($is['user_id'])): ?>
                        <?php
                        $user_name = Users::where('user_id', $is['user_id'])->first();
                        $date = explode(' ', $is['created_at']);
                        ?>
                        <li class="item">
                            <p>Idea has been approved by
                                <span>
                                    <?php if(isset($user_name['name'])): ?>
                                    <?php echo e($user_name['name']); ?>

                                    <?php echo e($user_name['last_name']); ?>

                                    <?php endif; ?>


                                    <?php if(isset($is->user_role)): ?>
                                    &#40;
                                    <i class="text-assessment"><?php echo e($is->user_role); ?></i>
                                    &#41;
                                    <?php endif; ?>
                                </span>

                                <i> on <?php echo e($date[0]); ?> at
                                    <?php echo e($date[1]); ?></i>
                            </p>
                        </li>
                        <?php endif; ?>
                        <?php elseif($is->idea_status == 'implemented'): ?>
                        <?php if(isset($is['user_id'])): ?>
                        <?php
                        $user_name = Users::where('user_id', $is['user_id'])->first();
                        $date = explode(' ', $is['created_at']);
                        ?>
                        <li class="item">
                            <p>Idea has been Implemented by
                                <span>
                                    <?php if(isset($user_name['name'])): ?>
                                    <?php echo e($user_name['name']); ?>

                                    <?php echo e($user_name['last_name']); ?>

                                    <?php endif; ?>


                                    <?php if(isset($is->user_role)): ?>
                                    &#40;
                                    <i class="text-assessment"><?php echo e($is->user_role); ?></i>
                                    &#41;
                                    <?php endif; ?>
                                </span>

                                <i> on <?php echo e($date[0]); ?> at
                                    <?php echo e($date[1]); ?></i>
                            </p>
                        </li>
                        <?php endif; ?>
                        
                        <?php elseif($is->idea_status == 'on_hold'): ?>
                        <?php if(isset($is['user_id'])): ?>
                        <?php
                        $user_name = Users::where('user_id', $is['user_id'])->first();
                        $date = explode(' ', $is['created_at']);
                        ?>
                        <li class="item">
                            <p>Idea Kept On Hold by
                                <span>
                                    <?php if(isset($user_name['name'])): ?>
                                    <?php echo e($user_name['name']); ?>

                                    <?php echo e($user_name['last_name']); ?>

                                    <?php endif; ?>


                                    <?php if(isset($is->user_role)): ?>
                                    &#40;
                                    <i class="text-assessment"><?php echo e($is->user_role); ?></i>
                                    &#41;
                                    <?php endif; ?>
                                </span>

                                <i> on <?php echo e($date[0]); ?> at
                                    <?php echo e($date[1]); ?></i>
                            </p>
                        </li>


                        
                        <?php endif; ?>
                        
                        <?php elseif($is->idea_status == 'resubmit'): ?>
                        <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
            </div>
        </div>
    </div>
</div>


<section class="cs-content">
    <div class="container-fluid">
        <div id="basic-datatable">
            <div class="card">
                <?php
                $image_path = $idea['image_path'];
                $full_image_path = 'storage/app/public/'.$image_path;
                $extArr = explode('.',$image_path);
                $ext = end($extArr);
                ?>
                <div class="card-body">
                    <?php
                    $user = Users::where('user_id',$idea->user_id)->first();
                    if(isset($idea['created_at'])){
                    $created_at_arr = explode(' ',$idea['created_at']);
                    $created_at ='| Submitted on : '.$created_at_arr[0];
                    } else {
                    $created_at ='';
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="position-sticky top-0">
                                <div id="idea_title">
                                    <h2 class="mb-3 heading">
                                        <strong><?php echo e($idea->title); ?> </strong>
                                    </h2>
                                    <h3 class="mb-2">Idea Number: <?php echo e($idea->idea_id); ?></h3>
                                    <h5>
                                        <b>
                                            Author : <span class="text-primary text-capitalize"><?php echo e($user['name']); ?> <?php echo e($user['last_name']); ?></span>
                                            <span><?php echo e($created_at); ?></span>
                                        </b>
                                    </h5>
                                </div>

                                <!-- New Status Card -->
                                <div class="card status-card mt-4">
                                    <div class="card-header">
                                        <?php
                                        $status = '';
                                        ?>
                                        <?php if($idea->active_status == 'implementation'): ?>
                                        
                                        <?php $status = 'implementation'; ?>
                                        <?php elseif($idea->active_status == 'implemented'): ?>
                                        
                                        <?php $status = 'implemented'; ?>

                                        <?php endif; ?>
                                        <h5>Status</h5>
                                        <!-- <i class="pending">Pending</i> -->
                                        <!-- <i class="assessment">In Assessment</i> -->
                                        <!-- <i class="approved">Approved</i> -->
                                        <i class="<?php echo e(strtolower($status)); ?>"><?php echo e($status); ?></i>
                                    </div>
                                    <div class="card-body">
                                        <ul class="time-line">
                                            
                                            <?php

                                            $last_status = count($idea_status) - 1;
                                            if ($last_status <= 0) { $last_status=0; } ?> 
                                                <?php $__currentLoopData = $idea_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $is): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($loop->index == 0 || $loop->index == $last_status): ?>
                                                <?php if($is->idea_status == 'rejected'): ?>
                                                <?php if(isset($is['user_id'])): ?>
                                                <?php
                                                $user_name = Users::where('user_id', $is['user_id'])->first();
                                                $date = explode(' ', $is['created_at']);
                                                ?>
                                                <li class="item">
                                                    <p>Idea has been rejected by
                                                        <span>
                                                            <?php if(isset($user_name['name'])): ?>
                                                            <?php echo e($user_name['name']); ?>

                                                            <?php echo e($user_name['last_name']); ?>

                                                            <?php endif; ?>


                                                            <?php if(isset($is->user_role)): ?>
                                                            &#40;
                                                            <i class="text-assessment"><?php echo e($is->user_role); ?></i>
                                                            &#41;
                                                            <?php endif; ?>
                                                        </span>

                                                        <i> on <?php echo e($date[0]); ?> at
                                                            <?php echo e($date[1]); ?></i>
                                                    </p>
                                                </li>
                                                <?php if(isset($is['user_id'])): ?>
                                                <?php

                                                $user_name = Users::where('user_id', $is['user_id'])->first();
                                                $date = explode(' ', $is['created_at']);
                                                ?>
                                                <li class="item">
                                                    <p>Idea send for Revision by
                                                        <span>
                                                            <?php if(isset($user_name['name'])): ?>
                                                            <?php echo e($user_name['name']); ?>

                                                            <?php echo e($user_name['last_name']); ?>

                                                            <?php endif; ?>


                                                            <?php if(isset($is->user_role)): ?>
                                                            &#40;
                                                            <i class="text-assessment"><?php echo e($is->user_role); ?></i>
                                                            &#41;
                                                            <?php endif; ?>
                                                        </span>

                                                        <i> on <?php echo e($date[0]); ?> at
                                                            <?php echo e($date[1]); ?></i>
                                                    </p>
                                                </li>

                                                
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                <?php elseif($is->idea_status == 'assessment_team_approved'): ?>
                                                <?php if(isset($is['user_id'])): ?>
                                                <?php
                                                $user_name = Users::where('user_id', $is['user_id'])->first();
                                                $date = explode(' ', $is['created_at']);
                                                ?>
                                                <li class="item">
                                                    <p>
                                                        
                                                        Idea has been approved by
                                                        <span>
                                                            <?php if(isset($user_name['name'])): ?>
                                                            <?php echo e($user_name['name']); ?>

                                                            <?php echo e($user_name['last_name']); ?>

                                                            <?php endif; ?>


                                                            <?php if(isset($is->user_role)): ?>
                                                            &#40;
                                                            <i class="text-assessment"><?php echo e($is->user_role); ?></i>
                                                            &#41;
                                                            <?php endif; ?>
                                                        </span>

                                                        <i> on <?php echo e($date[0]); ?> at
                                                            <?php echo e($date[1]); ?></i>
                                                    </p>
                                                </li>
                                                <?php endif; ?>
                                                <?php elseif($is->idea_status == 'approving_authority_approved'): ?>
                                                <?php if(isset($is['user_id'])): ?>
                                                <?php
                                                $user_name = Users::where('user_id', $is['user_id'])->first();
                                                $date = explode(' ', $is['created_at']);
                                                ?>
                                                <li class="item">
                                                    <p>Idea has been approved by
                                                        <span>
                                                            <?php if(isset($user_name['name'])): ?>
                                                            <?php echo e($user_name['name']); ?>

                                                            <?php echo e($user_name['last_name']); ?>

                                                            <?php endif; ?>


                                                            <?php if(isset($is->user_role)): ?>
                                                            &#40;
                                                            <i class="text-assessment"><?php echo e($is->user_role); ?></i>
                                                            &#41;
                                                            <?php endif; ?>
                                                        </span>

                                                        <i> on <?php echo e($date[0]); ?> at
                                                            <?php echo e($date[1]); ?></i>
                                                    </p>
                                                </li>
                                                <?php endif; ?>
                                                <?php elseif($is->idea_status == 'implemented'): ?>
                                                <?php if(isset($is['user_id'])): ?>
                                                <?php
                                                $user_name = Users::where('user_id', $is['user_id'])->first();
                                                $date = explode(' ', $is['created_at']);
                                                ?>
                                                <li class="item">
                                                    <p>Idea has been Implemented by
                                                        <span>
                                                            <?php if(isset($user_name['name'])): ?>
                                                            <?php echo e($user_name['name']); ?>

                                                            <?php echo e($user_name['last_name']); ?>

                                                            <?php endif; ?>


                                                            <?php if(isset($is->user_role)): ?>
                                                            &#40;
                                                            <i class="text-assessment"><?php echo e($is->user_role); ?></i>
                                                            &#41;
                                                            <?php endif; ?>
                                                        </span>

                                                        <i> on <?php echo e($date[0]); ?> at
                                                            <?php echo e($date[1]); ?></i>
                                                    </p>
                                                </li>
                                                <?php endif; ?>
                                                
                                                <?php elseif($is->idea_status == 'on_hold'): ?>
                                                <?php if(isset($is['user_id'])): ?>
                                                <?php
                                                $user_name = Users::where('user_id', $is['user_id'])->first();
                                                $date = explode(' ', $is['created_at']);
                                                ?>
                                                <li class="item">
                                                    <p>Idea Kept On Hold by
                                                        <span>
                                                            <?php if(isset($user_name['name'])): ?>
                                                            <?php echo e($user_name['name']); ?>

                                                            <?php echo e($user_name['last_name']); ?>

                                                            <?php endif; ?>


                                                            <?php if(isset($is->user_role)): ?>
                                                            &#40;
                                                            <i class="text-assessment"><?php echo e($is->user_role); ?></i>
                                                            &#41;
                                                            <?php endif; ?>
                                                        </span>

                                                        <i> on <?php echo e($date[0]); ?> at
                                                            <?php echo e($date[1]); ?></i>
                                                    </p>
                                                </li>


                                                
                                                <?php endif; ?>
                                                
                                                <?php elseif($is->idea_status == 'resubmit'): ?>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <?php if(count($idea_status) > 0): ?>
                                                <li class="divider">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#statusTimelineModal">
                                                        View Status Timeline
                                                    </button>
                                                </li>
                                                <?php endif; ?>

                                        </ul>
                                    </div>
                                </div>
                                <!-- New Status Card -->


                                <div class="bg-back d-none">
                                    <div class="status-heading">
                                        <h4 class="mb-4"><strong>Status</strong></h4>
                                    </div>
                                    <div id="idea_status">

                                        
                                            
                                            

                                    </div>

                                    <ul class="timeline">
                                        <?php
                                        //$idea_status = IdeaStatus::where('idea_id',$idea->idea_id)->get();
                                        // dump($idea_status);
                                        ?>
                                        <?php $__currentLoopData = $idea_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $is): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($is->idea_status == 'rejected'): ?>
                                        <?php
                                        if(isset($is['user_id'])) {
                                        $user_name = Users::where('user_id',$is['user_id'])->first();
                                        $date = explode(' ',$is['created_at']);
                                        ?>
                                        <li>
                                            <p>Idea has been rejected by
                                                <strong><?php echo e($user_name['name']); ?>

                                                    <?php echo e($user_name['last_name']); ?></strong>
                                                <br> <?php if(isset($is->user_role)): ?>
                                                &#40;
                                                <?php echo e($is->user_role); ?>

                                                &#41;
                                                <?php endif; ?>
                                                on <strong> <?php echo e($date[0]); ?></strong> at
                                                <strong><?php echo e($date[1]); ?></strong>
                                            </p>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        <?php elseif($is->idea_status == 'assessment_team_approved'): ?>

                                        <?php
                                        if(isset($is['user_id'])) {
                                        $user_name = Users::where('user_id',$is['user_id'])->first();
                                        $date = explode(' ',$is['created_at']);
                                        ?>
                                        <li>
                                            <p>Idea has been approved by
                                                <strong><?php echo e($user_name['name']); ?>

                                                    <?php echo e($user_name['last_name']); ?></strong>
                                                <br> <?php if(isset($is->user_role)): ?>
                                                &#40;
                                                <?php echo e($is->user_role); ?>

                                                &#41;
                                                <?php endif; ?>
                                                on <strong> <?php echo e($date[0]); ?></strong> at
                                                <strong><?php echo e($date[1]); ?></strong>
                                            </p>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        <?php elseif($is->idea_status== 'approving_authority_approved'): ?>
                                        <?php
                                        if(isset($is['user_id'])) {
                                        $user_name = Users::where('user_id',$is['user_id'])->first();
                                        $date = explode(' ',$is['created_at']);
                                        ?>
                                        <li>
                                            <p>Idea has been approved by
                                                <strong><?php echo e($user_name['name']); ?>

                                                    <?php echo e($user_name['last_name']); ?></strong>
                                                <br> <?php if(isset($is->user_role)): ?>
                                                &#40;
                                                <?php echo e($is->user_role); ?>

                                                &#41;
                                                <?php endif; ?>
                                                on <strong> <?php echo e($date[0]); ?></strong> at
                                                <strong><?php echo e($date[1]); ?></strong>
                                            </p>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        <?php elseif($is->idea_status== 'implemented'): ?>
                                        <?php
                                        if(isset($is['user_id'])) {
                                        $user_name = Users::where('user_id',$is['user_id'])->first();
                                        $date = explode(' ',$is['created_at']);
                                        ?>
                                        <li>
                                            <p>Idea has been Implemented by
                                                <strong><?php echo e($user_name['name']); ?>

                                                    <?php echo e($user_name['last_name']); ?></strong>
                                                <br>
                                                <?php if(isset($is->user_role)): ?>
                                                &#40;
                                                <?php echo e($is->user_role); ?>

                                                &#41;
                                                <?php endif; ?>
                                                on <strong> <?php echo e($date[0]); ?></strong> at
                                                <strong><?php echo e($date[1]); ?></strong>
                                            </p>
                                        </li>
                                        <?php
                                        }
                                        ?>



                                        
                                        <?php elseif($is->idea_status== 'on_hold'): ?>
                                        <?php
                                        if(isset($is['user_id'])) {
                                        $user_name = Users::where('user_id',$is['user_id'])->first();
                                        $date = explode(' ',$is['created_at']);
                                        ?>
                                        <li>
                                            <p>Idea Kept On Hold by <?php echo e(isset($is->role_name)?$is->role_name:''); ?>

                                                <strong>
                                                    <?php if(isset($user_name['name'])): ?>
                                                    <?php echo e($user_name['name']); ?>

                                                    <?php echo e($user_name['last_name']); ?>

                                                    <?php endif; ?>
                                                </strong> <?php if(isset($is->user_role)): ?>
                                                &#40;
                                                <?php echo e($is->user_role); ?>

                                                &#41;
                                                <?php endif; ?>
                                                <br> on <strong> <?php echo e($date[0]); ?></strong> at
                                                <strong><?php echo e($date[1]); ?></strong>
                                            </p>
                                        </li>
                                        <?php
                                        }
                                        ?>

                                        

                                        
                                        <?php elseif($is->idea_status== 'resubmit'): ?>
                                        <?php

                                        if(isset($is['user_id'])) {
                                        $user_name = Users::where('user_id',$is['user_id'])->first();
                                        $date = explode(' ',$is['created_at']);
                                        ?>
                                        <li>
                                            <p>Idea send for Revision by <?php echo e(isset($is->role_name)?$is->role_name:''); ?>

                                                <strong>
                                                    <?php if(isset($user_name['name'])): ?>
                                                    <?php echo e($user_name['name']); ?>

                                                    <?php echo e($user_name['last_name']); ?>

                                                    <?php endif; ?>
                                                </strong> <?php if(isset($is->user_role)): ?>
                                                &#40;
                                                <?php echo e($is->user_role); ?>

                                                &#41;
                                                <?php endif; ?>
                                                <br> on <strong> <?php echo e($date[0]); ?></strong> at
                                                <strong><?php echo e($date[1]); ?></strong>
                                            </p>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        


                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>

                                <div class="d-flex justify-content-start mt-3">
                                    
                                    <?php if($idea->active_status == 'implementation'): ?>
                                    <?php if($idea->implemented == 0): ?>
                                    <button type="button"
                                        title="click here to change the status of the idea to Implemented"
                                        class="btn btn-danger mx-2" data-toggle="modal"
                                        data-target="#implementationFailedModal">Failed to Implement</button>
                                    <?php endif; ?>
                                    <?php endif; ?>

                                    
                                    <?php if($idea->active_status == 'implementation'): ?>
                                    <?php if($idea->implemented == 0): ?>
                                    <?php if(in_array('implemented',$status_buttons)): ?>
                                    <button type="button"
                                        title="click here to change the status of the idea to Implemented"
                                        class="btn btn-success mx-2" data-toggle="modal"
                                        data-target="#implementationModal">Idea Successfully Implemented</button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                                
                                <?php if($idea->implemented == 1 && $idea->active_status == 'implemented'): ?>
                                <?php if($idea->certificate != 1): ?>
                                <div class="d-flex justify-content-start mt-3">
                                    <?php if(in_array('certificate',$status_buttons)): ?>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#approveForCertificateModal">Generate Certificate</button>
                                    <?php endif; ?>
                                </div>
                                <?php else: ?>
                                <div class="d-flex flex-column align-items-end mt-3">
                                    <p>Certificate has already been Generated</p>
                                    <a class="btn btn-dark"
                                        href="<?php echo e(route('rewards.view',['id'=>$idea->idea_id])); ?>">View Certificate</a>
                                </div>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-7">
                            <div class="list">
                                <div class="item">
                                    <div class="heading">
                                        <h5>Idea Description</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3">
                                            <?php echo e((isset($idea->description)?$idea->description:'')); ?>

                                        </p>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>Outcome of Idea</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3"><?php echo e(isset($idea->idea_outcome) ? $idea->idea_outcome : ''); ?></p>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>Describe why the idea should to be implemented/What makes your idea unique?
                                        </h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3"><?php echo e(isset($idea->why_implemented) ? $idea->why_implemented : ''); ?></p>

                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>The idea presented has no risks or challenges to the Business</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3"><?php echo e(isset($idea->challeges) ? $idea->challeges : ''); ?></p>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>This idea is new and not implemented anywhere in JMB Group</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3"><?php echo e(isset($idea->already_implemented_or_no) ?
                                            $idea->already_implemented_or_no : ''); ?></p>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>This idea has no other alternative</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3"><?php echo e(isset($idea->alternatives) ? $idea->alternatives : ''); ?></p>

                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>Is the cost of implementing the idea is less than the benefit</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3"><?php echo e(isset($idea->cost_and_benifits) ? $idea->cost_and_benifits :
                                            ''); ?></p>

                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>Benefits of Implementing the Idea1</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3"><?php echo e(isset($idea->benifits) ? $idea->benifits : ''); ?></p>

                                    </div>
                                </div>

                                <?php if(strtolower($roles_external->role_type) == 'assessment team'): ?>
                                <div class="item">
                                    <div class="heading">
                                        <h5>Remarks</h5>
                                    </div>
                                    
                                </div>
                                <?php endif; ?>

                                
                                <?php
                                $idea_uni_id = $idea->idea_uni_id;
                                $idea_images = IdeaImages::where(['is_supporting' => 0, 'idea_uni_id' =>
                                $idea_uni_id])->whereNotNull('idea_uni_id')->get();
                                ?>
                                <?php if(count($idea_images) > 0): ?>
                                <div class="full-img-boxin">
                                    <h3 class="heading mt-4 mb-3">Attachment</h3>
                                    <div class="row">
                                        <?php $__currentLoopData = $idea_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idea_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                        $fileNameParts = explode('.', $idea_image->file_name);
                                        $ext = end($fileNameParts);
                                        // dd($ext);
                                        $img_path = '';
                                        $label_text = '';
                                        $file_path = asset('storage/app/public/' . $idea_image->image_path);
                                        if ($ext == 'doc') {
                                        $label_text = 'Download DOC';
                                        $img_path = asset('storage/app/public/uploads/asset/doc.png');
                                        } elseif ($ext == 'pdf') {
                                        $label_text = 'View PDF';
                                        $img_path = asset('storage/app/public/uploads/asset/pdf.png');
                                        }
                                        elseif(in_array(strtolower($ext),$ALL_VIDEO_EXTENSIONS )){
                                        $label_text = 'View Video';
                                        $img_path = asset('storage/app/public/uploads/'. $idea_image->image_path);
                                        }
                                        else {
                                        $label_text = 'View Image';
                                        $img_path = asset('storage/app/public/' . $idea_image->image_path);
                                        }
                                        ?>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <a class="card card-body shadow <?php echo e($ext == 'pdf' || $ext == 'doc' || $ext == 'docx'?'':'test-popup-link'); ?>"
                                                href="<?php echo e($file_path); ?>" target="_blank">

                                                <?php if(in_array(strtolower($ext),$ALL_VIDEO_EXTENSIONS )): ?>
                                                <video style="width:100%;height:50px; object-fit:contain" controls>
                                                    <source src="<?php echo e($img_path); ?>" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>

                                                <a class="card card-body mt-1" style='border:none !important'
                                                    href="<?php echo e($file_path); ?>" target="_blank">Download</a>

                                                <?php else: ?>
                                                <img style="width:100%;height:100px; object-fit:contain"
                                                    src="<?php echo e($img_path); ?>"
                                                    alt="<?php echo e($image_path == 'null' ? 'Image not available': 'Idea Image'); ?> ">
                                                <p class="h5 text-center mt-2"><?php echo e($label_text); ?></p>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <?php endif; ?>

                                
                                <?php if($role != 'User'): ?>
                                <div class="form_container chat-form" style="position: relative;">
                                    <form method="POST" action="<?php echo e(route('ideas.storeSupportingdocs')); ?>"
                                        enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row align-items-end">
                                            <div class="col-lg-8">
                                                <div class="dropzone-container">
                                                    <label for="files">Upload your Supproting Attachments here</label>
                                                    <div class="drop-zone mb-0">
                                                        <input type="file" class="form-control image-file" multiple="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="hidden" name="idea_id" value="<?php echo e($idea->idea_id); ?>">
                                                <button type="submit" class="btn btn-dark" id="submit">Upload</button>
                                            </div>
                                        </div>
                                        <div id="selected-images" class="mt-4 row g-2 idea_imgaes_container">
                                        </div>
                                    </form>

                                    <fieldset style="border-color: #12c712;display:none;padding:2.3em;margin:1em 0px;">
                                        <legend style="font-size:1.3em">Preview</legend>
                                        <div id="selected-images" class="row g-2">
                                        </div>
                                    </fieldset>
                                    <?php
                                    $images =
                                    IdeaImages::where(['is_supporting'=>1,'idea_uni_id'=>$idea->idea_uni_id])->get();
                                    // dd($images);
                                    ?>
                                    <?php if(count($images) > 0): ?>
                                    <div>
                                        <legend style="font-size:1.3em">Uploaded Files</legend>
                                        <hr>
                                        <div id="uploaded_images" class="row g-2">
                                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            // dd($image);
                                            $img_path = '';
                                            $label_text = '';
                                            $file_path = asset('storage/app/public/' . $image->image_path);
                                            $fileNameParts = explode('.', $image->file_name);
                                            $ext = end($fileNameParts);
                                            // dd($ext);
                                            if ($ext == 'doc' || $ext == 'docx' || $ext == 'xlsx' || $ext =='txt') {
                                            $img_path = asset('storage/app/public/uploads/asset/doc.png');
                                            } elseif ($ext == 'pdf'){
                                            $img_path = asset('storage/app/public/uploads/asset/pdf.png');
                                            }else if($ext === 'mp4' || $ext === 'mov' || $ext === 'avi'){
                                            $img_path = asset('storage/app/public/uploads/asset/vid.png');
                                            }else {
                                            $img_path = asset('storage/app/public/' . $image->image_path);
                                            }
                                            ?>
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="card border-0 shadow">
                                                    <div
                                                        style="width:100%;height:150px;overflow:hidden;padding:15px 0px;">
                                                        <img class="card-img-top" src="<?php echo e($img_path); ?>"
                                                            alt="Card image cap"
                                                            style="width:100%;height:100%;object-position:center;object-fit:contain">
                                                    </div>
                                                    <div class="card-body">
                                                        <p style="text-overflow: ellipsis;overflow: hidden;width: 100%;white-space: nowrap;"
                                                            class="card-text"><?php echo e($image->file_name); ?></p>
                                                        <a href="<?php echo e(route('ideas.delete_image',['id'=>$image->image_id])); ?>"
                                                            class="btn btn-sm btn-danger cross-image
                                                            remove" style="margin:5px 8px 5px 0px;"
                                                            onclick="return confirm('Are you sure you want to delete this File')">Remove</a>
                                                        <?php if($ext == 'doc' || $ext == 'pdf' || $ext == 'docx' || $ext ==
                                                        'xlsx' || $ext =='txt'): ?>
                                                        <a style="margin:5px 5px 5px 0px;" href="<?php echo e($file_path); ?>"
                                                            class="btn btn-sm btn-primary <?php echo e($ext == 'pdf' || $ext == 'doc' || $ext  == 'xlsx' || $ext  =='txt' || $ext == 'docx'?'':'test-popup-link'); ?>"
                                                            target="_blank">View</a>
                                                        <?php elseif($ext === 'mp4' || $ext === 'mov' || $ext === 'avi'): ?>
                                                        <a style="margin:5px 5px 5px 0px;" href="<?php echo e($file_path); ?>"
                                                            class="btn btn-sm btn-primary <?php echo e($ext === 'mp4' || $ext === 'mov' || $ext === 'avi'?'':'test-popup-link'); ?>"
                                                            target="_blank">View</a>
                                                        <?php else: ?>
                                                        <a style="margin:5px 5px 5px 0px;" href="<?php echo e($img_path); ?>"
                                                            class="btn btn-sm btn-primary test-popup-link">View</a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div>
                                        <h2 class=" mt-4">Supporting attachments not uploaded yet</h2>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

            
            <?php if(!$get_users->isEmpty()): ?>
            <div class="card mt-4">

                
                <div class="card-body">
                    <h3 class="heading mb-4">Idea Discussion</h3>
                    
                    <div class="chat-section">
                    </div>
                </div>


                
                <div class="form_container chat-form">
                    <form method="POST" action="<?php echo e(route('ideas.storeFeedback')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <div class="col-md-3">
                                <select name="receiver_id" id="receiver_id" class="form-control" required>
                                    <option value="">Select User To Chat With</option>
                                    <?php if($get_users): ?>
                                    <?php $__currentLoopData = $get_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($row->user_id); ?>">
                                        <?php echo e($row->name . ' ' . $row->last_name); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <!-- File preview container -->
                        <div id="file-preview"
                            style="top: -150px; right: 0; max-width: 20%; max-height: 10%; overflow: hidden;  padding: 5px; border-radius: 5px;">
                            <div id="preview-content"
                                style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%;">
                            </div>
                        </div>

                        <div class="users-img feedback_container" style="display: flex; align-items: center;">

                            <div class="form-group" style="width: 100%; flex-grow: 1; margin-right: 10px;">
                                <input type="text" name="feedback" class="form-control" id="feedback"
                                    placeholder="Enter your comments here..." />
                            </div>

                            <label for="file-input" style="cursor: pointer;position: relative;top: 4px;">
                                <i class="fa fa-paperclip attachment" aria-hidden="true"
                                    style="font-size: 20px; margin-right: 10px;"></i>
                            </label>
                            <input id="file-input" type="file" name="attachment" style="display: none;">

                            <input type="hidden" name="idea_id" value="<?php echo e($idea->idea_id); ?>">

                            <button type="submit" style="background: none; border: none; cursor: pointer;">
                                <i class="fa fa-paper-plane" aria-hidden="true" style="font-size: 20px;"></i>
                            </button>
                        </div>
                    </form>

                    <script>
                        document.getElementById('file-input').addEventListener('change', function(event) {
                            const fileInput = event.target;
                            const filePreview = document.getElementById('preview-content');

                            if (fileInput.files && fileInput.files[0]) {
                                const file = fileInput.files[0];
                                const fileType = file.type.split('/')[0];

                                const reader = new FileReader();

                                reader.onload = function(e) {
                                    if (fileType === 'image') {
                                        // For images, display image with name
                                        filePreview.innerHTML =
                                            `<img src="${e.target.result}" alt="File Preview" style="max-width: 100%; max-height: 70%; border-radius: 5px;">
                                                                <p style="margin: 5px 0; font-size: 14px;">${file.name}</p>`;
                                    } else if (fileType === 'video') {
                                        // For videos, display video thumbnail with icon and name
                                        filePreview.innerHTML =
                                            `<i class="fa fa-file-video-o" aria-hidden="true" style="font-size: 40px; color: #ff6600;"></i>
                                                                <p style="margin: 5px 0; font-size: 14px;">${file.name}</p>`;
                                    } else {
                                        // For other file types, display a generic icon with name
                                        filePreview.innerHTML =
                                            `<i class="fa fa-file" aria-hidden="true" style="font-size: 40px;"></i>
                                                                <p style="margin: 5px 0; font-size: 14px;">${file.name}</p>`;
                                    }
                                };

                                reader.readAsDataURL(fileInput.files[0]);
                            }
                        });
                    </script>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<div class="container-fluid">



    <!-- Modal -->
    <div class="modal fade" id="implementationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Implemented</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to change the Idea status to Implemented ?<br>
                    You will not be able to change the Idea Status again!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="<?php echo e(route('ideas.idea_implemented',['id'=>$idea->idea_id])); ?>" class="btn btn-primary">Yes</a>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->



    <!-- Modal  for reject Idea-->
    <div class="modal fade" id="implementationFailedModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleFailedModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleFailedModalLabel">Reason For Idea Not Implemented</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('reject_idea_implementation_team')); ?>" method="POST" id='reject_idea_form'>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <label for="">Enter Reason</label>
                            <?php echo csrf_field(); ?>
                            <textarea name="reason" cols="30" rows="10" class='form-control'
                                id='reject_idea_area'></textarea>
                            <input type="hidden" name="idea_id" value="<?php echo e($idea->idea_id); ?>" id='reject_idea_id'>
                            <span class="text-danger" id="reject_idea_error"></span>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="submit" value="Submit" class="btn btn-primary" name='submit'
                            id='reject_idea_button' onclick="return submitRejectForm()">
                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->


    <div class="modal fade" id="approveForCertificateModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Generate Certificate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to Generate Certificate for this Idea
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="<?php echo e(route('ideas.approve_certificate',['id'=>$idea->idea_id])); ?>"
                        class="btn btn-primary">Yes</a>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('scripts'); ?>


    
    
    <script>
        $(document).ready(function () {
        // Function to update chat messages
        async function updateChatMessages(userId, ideaId) {
            // Make an Ajax request to get chat messages for the selected user and idea
            const response = await $.ajax({
                url: '<?php echo e(route("getChatMessages")); ?>',
                type: 'POST',
                data: { user_id: userId, idea_id: ideaId, _token: '<?php echo e(csrf_token()); ?>' },
            });

            // Update the chat section with the received messages
            var chatSection = $('.chat-section');
            chatSection.empty();

            if (response.chats.length > 0) {
                // Loop through the messages and append them to the chat section
                for (const chat of response.chats) {
                    await getUserDetailsAndAppendChat(chat);
                }
            } else {
                chatSection.append('<div><h4>No Discussion yet</h4></div>');
            }
        }

        async function getUserDetailsAndAppendChat(chat) {
            const userResponse = await $.ajax({
                url: '<?php echo e(route("getUserDetails")); ?>',
                type: 'POST',
                data: { user_id: chat.user_id, _token: '<?php echo e(csrf_token()); ?>' },
            });

            var flag_c = '';
            var class_idea_discussion = 'idea-discussion-box-right';
            var style = 'flex-direction:row-reverse';
            var style2 = 'align-items:flex-end';

            if (chat.user_role == 'admin') {
                flag_c = 'true';
            } else {
                flag_c = 'false';
            }

            if (<?php echo e(Auth::id()); ?> == chat.user_id && chat.user_role !== 'admin') {
                flag_c = 'false';
                class_idea_discussion = 'idea-discussion-box';
                style = '';
                style2 = '';
            }

            var chatHtml = '<div class="users-img mb-3" style="' + style + '">';
            chatHtml += '<div class="' + class_idea_discussion + '">';
            chatHtml += '<h4>';
            chatHtml += '<strong>' + (userResponse.user.name + ' ' + userResponse.user.last_name) + '</strong>';
            chatHtml += '<em>&#40; ' + chat.user_role + ' &#41;</em>';
            chatHtml += '</h4>';

            if (chat.media_file) {
                var url = '<?php echo e(url('/')); ?>/storage/app/public/' + chat.media_file;
                var fileExtension = chat.file_extension;

                chatHtml += '<a href="' + url + '" target="_blank">';
                if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                    chatHtml += '<img src="' + url + '" alt="Click To View">';
                } else if (['mp4', 'avi', 'mov', 'wmv'].includes(fileExtension)) {
                    chatHtml += '<i class="fa fa-file-video-o" aria-hidden="true" style="font-size: 40px;"></i>';
                } else if (['pdf', 'doc', 'docx'].includes(fileExtension)) {
                    chatHtml += '<i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 40px;"></i>';
                } else {
                    chatHtml += '<i class="fa fa-file" aria-hidden="true" style="font-size: 40px;"></i>';
                }
                chatHtml += '</a>';
            }

            chatHtml += '<p class="feedback-text">' + chat.feedback + '</p>';
            chatHtml += '<p class="datein">' + chat.created_at + '</p>';
            chatHtml += '</div>';
            chatHtml += '</div>';

            var chatSection = $('.chat-section');
            chatSection.prepend(chatHtml);
        }

        // Initial load of chat messages based on the default selected user
        var initialUserId = $('#receiver_id').val();
        var ideaId = '<?php echo e(request("id")); ?>';
        // updateChatMessages(initialUserId, ideaId);

        // Event handler for user selection change
        $('#receiver_id').on('change', function () {
            var userId = $(this).val();
            updateChatMessages(userId, ideaId);
        });
    });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {

         //seelect 2
         $('#benifits').select2();


        $('#error_message').hide();
        if (window.File && window.FileList && window.FileReader) {

            $(".image-file").on("change", function(e) {
                $('#error_message').hide();
                var file = e.target.files
                , imagefiles = $(".image-file")[0].files;
                var i = 0;

                $.each(imagefiles, function(index, value) {
                    var f = file[i];
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var img_src;
                        fn_ext = f.name;
                        // Regular expression for file extension.
                        var patternFileExtension = /\.([0-9a-z]+)(?:[\?#]|$)/i;

                        //Get the file Extension
                        var fn_ext = (fn_ext).match(patternFileExtension);
                        var fileSize = value.size / (1024 * 1024);

                        // alert(fileSize);

                        if (fileSize > 50) {
                            $('#error_message li').empty();
                            $('.image-file').val('');
                            $("#error_message li").append(`File size exceeds the limit of 50 MB`);
                            $("#error_message").show();
                            return;
                        }

                        if (fn_ext[1] == 'doc' || fn_ext[1] == 'docx' || fn_ext[1] == 'xlsx' || fn_ext[1] =='txt') {
                            img_src = '<?php echo e(asset("storage/app/public/uploads/asset/doc.png")); ?>';
                        } else if (fn_ext[1] == 'pdf') {
                            img_src = '<?php echo e(asset("storage/app/public/uploads/asset/pdf.png")); ?>';
                        } else if (fn_ext[1] == 'png' || fn_ext[1] == 'jpeg' || fn_ext[1] == 'jpg') {
                            img_src = e.target.result
                        }else if (fn_ext[1] === 'mp4' || fn_ext[1] === 'mov' || fn_ext[1] === 'avi') {
                            img_src = '<?php echo e(asset("storage/app/public/uploads/asset/vid.png")); ?>';
                        }else {
                            $('#error_message li').empty();
                            $('.image-file').val('');
                            $("#error_message li").append(`Select the specified type of files`);
                            $("#error_message").show();
                            return;
                        }
                        $("#selected-images").parent('fieldset').addClass('d-block');

                        $("#selected-images").append(`
                        <div class="pip boxDiv col-lg-2 col-md-4 col-sm-6">
                            <div class="card border-0 shadow">
                                <div style="width:100%;height:150px;overflow:hidden;padding:15px 0px;">
                                    <img class="card-img-top prescriptions" src="${img_src}" alt="Image to upload" style="width:100%;height:100%;object-position:center;object-fit:contain">
                                </div>
                                <div class="card-body">
                                    <p style="text-overflow: ellipsis;overflow: hidden;width: 100%;white-space: nowrap;" class="card-text">${value.name}</p>
                                    <a style="margin:5px 5px 5px 0px;" class="btn btn-sm btn-danger cross-image remove">Remove</a>
                                </div>
                            </div>
                            <input type="hidden" name="file[]" value="${e.target.result}">
                            <input type="hidden" name="fileName[]" value="${value.name}">
                        </div>`);
                        $(".remove").click(function() {
                            $(this).parent().parent().parent(".pip").remove();
                        });
                    });
                    fileReader.readAsDataURL(f);
                    i++;
                });
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
    });

    </script>

    <script>
        function submitRejectForm(){
        var text = $('#reject_idea_area').val();
        text = text.trim();
        if(text != '' || text.length > 0){
            console.log('in');
           // $('#reject_idea_form').submit();
            return true;
        }else{
            console.log('elase');
            $('#reject_idea_error').html('Please Enter Reason.');
            return false;
        }
    }

    $(document).ready(function(){
        $('#reject_idea_area').keypress(function(){
            $('#reject_idea_error').html('');
        });
    });

    </script>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\ideaportal\resources\views/frontend/ideas/view_idea_implementation_team.blade.php ENDPATH**/ ?>