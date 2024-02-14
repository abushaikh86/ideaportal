<?php
use App\Models\frontend\Users;
use App\Models\backend\AdminUsers;
use App\Models\frontend\IdeaStatus;
use App\Models\frontend\IdeaImages;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Models\Rolesexternal;
?>
<?php
    $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
    $role = $roles_external->role_type;
    $idea_status = IdeaStatus::where('idea_id', $idea->idea_id)->get();
    $show_mode = null;
    $ALL_VIDEO_EXTENSIONS = ['flv','webm','avchd','mkv','3gpp','mpeg','mpeg-4','mts','hevc','ogg','proress','mp4'];

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
                        <a class="btn btn-primary"
                            <?php if(session()->has('main_page')): ?> href="<?php echo e(session('main_page')); ?> ">
                        <?php else: ?> href="<?php echo e(route('ideas.index')); ?>"> <?php endif; ?>
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
                    <h6 class="heading mb-4" id="statusTimelineModalLabel">Status Timeline</h1>
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
                        $disabled = '';
                        if (isset($idea->assessment_team_approval) && $idea->assessment_team_approval == 1) {
                            $disabled = 'disabled';
                        }
                        $image_path = $idea['image_path'];
                        $full_image_path = 'storage/app/public/' . $image_path;
                        $extArr = explode('.', $image_path);
                        $ext = end($extArr);
                    ?>
                    <div class="card-body">
                        <?php
                            $user = Users::where('user_id', $idea->user_id)->first();
                            if (isset($idea['created_at'])) {
                                $created_at_arr = explode(' ', $idea['created_at']);
                                $created_at = '| Submitted on : ' . $created_at_arr[0];
                            } else {
                                $created_at = '';
                            }
                            $assessment_team_approval_flag = $idea->assessment_team_approval;
                            $status = '';
                            if ($idea['active_status'] == 'in_assessment') {
                                if ($idea->assessment_team_approval == 1) {
                                    $status = 'Approved by Assessment Team';
                                } else {
                                    $status = 'Under Assessment';
                                }
                            } elseif ($idea['active_status'] == 'pending') {
                                $status = 'Pending';
                            } elseif ($idea['active_status'] == 'under_approving_authority') {
                                $status = 'Under Approval';
                            } elseif ($idea['active_status'] == 'implementation') {
                                $status = 'Implementation';
                            } elseif ($idea['active_status'] == 'reject') {
                                $reason = $idea->reject_reason == null ? '' : '(Reason : ' . $idea->reject_reason . ')';
                                $status = 'Rejected' . $reason;
                            } elseif ($idea['active_status'] == 'on_hold') {
                                $status = 'On-hold';
                            } elseif ($idea['active_status'] == 'resubmit') {
                                $data = FacadesDB::table('ideas')
                                    ->where('idea_id', $idea->idea_id)
                                    ->first();
                                if ($roles_external->role_type == 'User' && $data->assessment_team_approval == 1 && $data->asstmnt_rev_status == 0) {
                                    $status = 'Under Assessment';
                                    $status_color = 'badge bg-secondary me-1';
                                } else {
                                    $reason = $idea->resubmit_reason == null ? '' : '(Reason : ' . $idea->resubmit_reason . ')';
                                    $status = 'Revise Request' . $reason;
                                }
                            } elseif ($idea['active_status'] == 'implemented') {
                                $reason = $idea->resubmit_reason == null ? '' : '(Reason : ' . $idea->resubmit_reason . ')';
                                $status = 'Implemented';
                            }

                        ?>
                        <div class="row g-4">
                            <div class="col-md-5 col-12">
                                <div class="position-sticky top-0">
                                    <div id="idea_title">
                                        <h2 class="mb-3 heading">
                                            <strong><?php echo e($idea->title); ?> </strong>
                                        </h2>
                                        <h3 class="mb-2">Idea Number: <?php echo e($idea->idea_id); ?></h3>
                                        <h5>
                                            <b>
                                                Author : <span class="text-primary text-capitalize"><?php echo e($user['name']); ?>

                                                    <?php echo e($user['last_name']); ?></span>
                                                <span><?php echo e($created_at); ?></span>
                                            </b>
                                        </h5>
                                    </div>

                                    <!-- New Status Card -->
                                    <div class="card status-card mt-4">
                                        <div class="card-header">
                                            <h5>Status</h5>
                                            <!-- <i class="pending">Pending</i> -->
                                            <!-- <i class="assessment">In Assessment</i> -->
                                            <!-- <i class="approved">Approved</i> -->
                                            <i class="<?php echo e(strtolower($status)); ?>"><?php echo e($status); ?></i>

                                        </div>
                                        <div class="card-body">
                                            <ul class="time-line">
                                                

                                                <?php if(count($idea_status) > 0): ?>
                                                <li class="divider">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#statusTimelineModal">
                                                        View Status Timeline
                                                    </button>
                                                </li>
                                                <?php endif; ?>

                                                <?php

                                                    $last_status = count($idea_status) - 1;
                                                    if ($last_status <= 0) {
                                                        $last_status = 0;
                                                    }
                                                ?>
                                                
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
                                                                                <i
                                                                                    class="text-assessment"><?php echo e($is->user_role); ?></i>
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
                                                                                    <i
                                                                                        class="text-assessment"><?php echo e($is->user_role); ?></i>
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
                                                                                <i
                                                                                    class="text-assessment"><?php echo e($is->user_role); ?></i>
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
                                                                                <i
                                                                                    class="text-assessment"><?php echo e($is->user_role); ?></i>
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
                                                                                <i
                                                                                    class="text-assessment"><?php echo e($is->user_role); ?></i>
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
                                                                                <i
                                                                                    class="text-assessment"><?php echo e($is->user_role); ?></i>
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
                                            </ul>
                                        </div>

                                        
                                        
                                        
                                        

                                        
                                        
                                        
                                        
                                    </div>
                                    <!-- New Status Card -->


                                    <?php $data = FacadesDB::table('ideas')
                                        ->where('idea_id', $idea->idea_id)
                                        ->first(); ?>


                                    <?php if($roles_external->role_type == 'User'): ?>
                                    <?php elseif($roles_external->role_type == 'Assessment Team'): ?>
                                        <?php $data = FacadesDB::table('ideas')
                                            ->where(['idea_id' => $idea->idea_id, 'assessment_team_approval' => 1])
                                            ->first(); ?>


                                        <?php if($idea->active_status == 'in_assessment' && $idea->assessment_team_approval == 1): ?>
                                        <?php else: ?>
                                            <?php if(isset($idea->assessment_team_approval) &&
                                                    $idea->assessment_team_approval != 1 &&
                                                    isset($idea->approving_authority_approval) &&
                                                    $idea->approving_authority_approval != 1): ?>


                                                    <?php
                                                        $deadline_missed = 0;
                                                    ?>
                                                    <?php if($roles_external->role_type == 'Assessment Team'): ?>
                                                        <?php $days = 0; ?>
                                                        <?php if(isset($sla->deadline_days)): ?>
                                                            <?php $days = $sla->deadline_days; ?>
                                                        <?php endif; ?>
                                                        <?php if($days > 0): ?>
                                                            <?php
                                                                $today = date('Y-m-d');
                                                                $uploaded_on = $idea->updated_at;
                                                                if (is_null($idea->resubmit_reason)) {
                                                                    $days_ago = date('Y-m-d', mktime(0, 0, 0, date('m', strtotime(str_replace('/', '-', $idea->created_at))), date('d', strtotime(str_replace('/', '-', $idea->created_at))) + $days, date('Y', strtotime(str_replace('/', '-', $idea->created_at)))));
                                                                } else {
                                                                    $days_ago = date('Y-m-d', mktime(0, 0, 0, date('m', strtotime(str_replace('/', '-', $idea->updated_at))), date('d', strtotime(str_replace('/', '-', $idea->updated_at))) + $days, date('Y', strtotime(str_replace('/', '-', $idea->updated_at)))));
                                                                }
                                                                $diff = strtotime($today) - strtotime($days_ago);
                                                                $diff = $diff / 86400;
                                                                if ($diff > 0) {
                                                                    $deadline_missed = 1;
                                                                }
                                                            ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <div class="_deadline_missed_form_div d-none">
                                                        <?php echo e(Form::hidden('deadline_status', $deadline_missed, ['class' => 'form-control', 'id' => 'deadline_status'])); ?>

                                                    </div>

                                                    <?php if($roles_external->role_type == 'Assessment Team'): ?>
                                                        <?php if($idea->active_status == 'in_assessment'): ?>
                                                            <?php if($assessment_team_approval_flag == 0): ?>
                                                                <div class="d-flex justify-content-end mt-3">
                                                                    <button type="button" class="btn btn-success"
                                                                        data-toggle="modal"
                                                                        data-target="#approveModal">Submit for
                                                                        Approval</button>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if($roles_external->role_type == 'Assessment Team'): ?>
                                    
                                        <?php endif; ?>
                            </div>
                        </div>


                        <div class="col-md-7 col-12">
                            <div class="list">
                                <div class="item">
                                    <div class="heading">
                                        <h5>Idea Description</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3">
                                            <?php echo e($idea->description); ?>

                                        </p>


                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>Outcome of Idea</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3"><?php echo e(isset($idea->idea_outcome) ? $idea->idea_outcome : ''); ?>

                                        </p>


                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>Describe why the idea should to be implemented/What makes your idea unique?
                                        </h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3">
                                            <?php echo e(isset($idea->why_implemented) ? $idea->why_implemented : ''); ?></p>

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
                                        <p class="mb-3">
                                            <?php echo e(isset($idea->already_implemented_or_no) ? $idea->already_implemented_or_no : ''); ?>

                                        </p>

                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>This idea has no other alternative</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3"><?php echo e(isset($idea->alternatives) ? $idea->alternatives : ''); ?>

                                        </p>

                                    </div>
                                </div>

                                <div class="item">
                                    <div class="heading">
                                        <h5>Is the cost of implementing the idea is less than the benefit</h5>
                                    </div>
                                    <div class="content">
                                        <p class="mb-3">
                                            <?php echo e(isset($idea->cost_and_benifits) ? $idea->cost_and_benifits : ''); ?></p>

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


                            </div>
                            <?php if(isset($disabled) && $disabled != 'disabled'): ?>
                                <button class="btn btn-primary mt-3" id="update_details_assesment">Update
                                    Details</button>
                            <?php endif; ?>

                            <?php
                                $idea_uni_id = $idea->idea_uni_id;
                                $idea_images = IdeaImages::where(['is_supporting' => 0, 'idea_uni_id' => $idea_uni_id])
                                    ->whereNotNull('idea_uni_id')
                                    ->get();
                            ?>
                            <?php if(count($idea_images) > 0): ?>
                                <div class="full-img-boxin">
                                    <h3 class="heading mb-3">Attachment</h3>
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
                                                <a style="margin-top:10px;"
                                                    class="card card-body shadow <?php echo e($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' ? '' : 'test-popup-link'); ?>"
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
                                                        alt="<?php echo e($image_path == 'null' ? 'Image not available' : 'Idea Image'); ?> ">
                                                    <p class="h5 text-center mt-2"><?php echo e($label_text); ?></p>
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            
                            <?php if(is_null($show_mode)): ?>
                                <?php if($role != 'User'): ?>
                                    <div class="form_container chat-form" style="position: relative;">
                                        <form method="POST" action="<?php echo e(route('ideas.storeSupportingdocs')); ?>"
                                            enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="row align-items-end">
                                                <div class="col-lg-8">
                                                    <div class="dropzone-container">
                                                        <label for="files">Upload your Supproting Attachments
                                                            here</label>
                                                        <div class="drop-zone mb-0">
                                                            <input type="file" class="form-control image-file"
                                                                multiple="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <input type="hidden" name="idea_id" value="<?php echo e($idea->idea_id); ?>">
                                                    <button type="submit" class="btn btn-secondary"
                                                        id="submit">Upload</button>
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
                                            $images = IdeaImages::where(['is_supporting' => 1, 'idea_uni_id' => $idea->idea_uni_id])->get();
                                            // dd($images);
                                        ?>
                                        <?php if(count($images) > 0): ?>
                                            <div>
                                                <h5 class="sub-heading mb-3">Uploaded Files</h5>
                                                <div id="uploaded_images" class="row g-3">
                                                    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            // dd($image);
                                                            $img_path = '';
                                                            $label_text = '';
                                                            $file_path = asset('storage/app/public/' . $image->image_path);
                                                            $fileNameParts = explode('.', $image->file_name);
                                                            $ext = end($fileNameParts);
                                                            // dd($ext);
                                                            if ($ext == 'doc' || $ext == 'docx' || $ext == 'xlsx' || $ext == 'txt') {
                                                                $img_path = asset('storage/app/public/uploads/asset/doc.png');
                                                            } elseif ($ext == 'pdf') {
                                                                $img_path = asset('storage/app/public/uploads/asset/pdf.png');
                                                            } elseif ($ext === 'mp4' || $ext === 'mov' || $ext === 'avi') {
                                                                $img_path = asset('storage/app/public/uploads/asset/vid.png');
                                                            } else {
                                                                $img_path = asset('storage/app/public/' . $image->image_path);
                                                            }
                                                        ?>
                                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                                            <div class="card border-0 shadow">
                                                                <img class="card-img-top" src="<?php echo e($img_path); ?>"
                                                                    alt="Card image cap">
                                                                <div class="card-body">
                                                                    <p class="card-text mb-2"><?php echo e($image->file_name); ?>

                                                                    </p>
                                                                    <a href="<?php echo e(route('ideas.delete_image', ['id' => $image->image_id])); ?>"
                                                                        class="btn btn-sm btn-danger cross-image remove"
                                                                        onclick="return confirm('Are you sure you want to delete this File')">Remove</a>
                                                                    <?php if($ext == 'doc' || $ext == 'pdf' || $ext == 'docx' || $ext == 'xlsx' || $ext == 'txt'): ?>
                                                                        <a href="<?php echo e($file_path); ?>"
                                                                            class="btn btn-sm btn-primary <?php echo e($ext == 'pdf' || $ext == 'doc' || $ext == 'xlsx' || $ext == 'txt' || $ext == 'docx' ? '' : 'test-popup-link'); ?>"
                                                                            target="_blank">View</a>
                                                                    <?php elseif($ext === 'mp4' || $ext === 'mov' || $ext === 'avi'): ?>
                                                                        <a href="<?php echo e($file_path); ?>"
                                                                            class="btn btn-sm btn-primary <?php echo e($ext === 'mp4' || $ext === 'mov' || $ext === 'avi' ? '' : 'test-popup-link'); ?>"
                                                                            target="_blank">View</a>
                                                                    <?php else: ?>
                                                                        <a href="<?php echo e($img_path); ?>"
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
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card mt-4">
            <div class="card-body">
                <h3 class="heading mb-4">Idea Discussion</h3>
                <div class="chat-section">
                    <?php if(count($feedback) > 0): ?>
                        <?php $__currentLoopData = $feedback; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $flag_c = '';
                                $class_idea_discussion = 'idea-discussion-box-right';
                                $style = 'flex-direction:row-reverse';
                                $style2 = 'align-items:flex-end';
                                $style3 = '';
                                if ($fb['user_role'] == 'admin') {
                                    $flag_c = 'true';
                                    $user = AdminUsers::where('admin_user_id', $fb['user_id'])->first();
                                } else {
                                    $flag_c = 'false';
                                    $user = Users::where('user_id', $fb['user_id'])->first();
                                }
                            ?>
                            <?php if(Auth::id() == $fb['user_id'] && $fb['user_role'] !== 'admin'): ?>
                                <?php
                                    $flag_c = 'false';
                                    $class_idea_discussion = 'idea-discussion-box';
                                    $style = '';
                                    $style2 = '';
                                ?>
                            <?php endif; ?>
                            <div class="users-img mb-3" style="<?php echo e($style); ?>">
                                <div class="<?php echo e($class_idea_discussion); ?>" style="<?php echo e($style2); ?>">
                                    <h4>
                                        <strong>
                                            <?php echo e($flag_c == 'true' ? $user['first_name'] : $user['name']); ?>

                                            <?php echo e($user['last_name']); ?>

                                        </strong>

                                        <em>&#40; <?php echo e($fb['user_role']); ?> &#41;</em>
                                    </h4>

                                    <?php if($fb['media_file']): ?>
                                        <?php
                                            $url = url('/') . '/storage/app/public/' . $fb['media_file'];
                                            $fileExtension = pathinfo($fb['media_file'], PATHINFO_EXTENSION);

                                        ?>
                                        <a href="<?php echo e($url); ?>" target="_blank">

                                            <?php if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                                <img src="<?php echo e($url); ?>" alt="Click To View">
                                            <?php elseif(in_array($fileExtension, ['mp4', 'avi', 'mov', 'wmv'])): ?>
                                                <i class="fa fa-file-video-o" aria-hidden="true"
                                                    style="font-size: 40px;"></i>
                                            <?php elseif(in_array($fileExtension, ['pdf', 'doc', 'docx'])): ?>
                                                <i class="fa fa-file-pdf-o" aria-hidden="true"
                                                    style="font-size: 40px;"></i>
                                            <?php else: ?>
                                                <i class="fa fa-file" aria-hidden="true" style="font-size: 40px;"></i>
                                            <?php endif; ?>
                                        </a>
                                    <?php endif; ?>

                                    <p class="feedback-text"><?php echo e($fb['feedback']); ?></p>
                                    <p lass="datein"><?php echo e($fb['created_at']); ?></p>
                                </div>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div>
                            <h4>No Discussion yet</h4>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form_container chat-form">
                <form method="POST" action="<?php echo e(route('ideas.storeFeedback')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
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
        </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="statusTimelineModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusTimelineModalLabel">Approve Idea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to Submit the idea for the Approval?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="<?php echo e(route('ideas.approveIdeaBAU', ['id' => $idea->idea_id, 'role' => $role])); ?>"
                        class="btn btn-primary">Yes</a>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function() {
            //update status of drop downs

            $('#update_details_assesment').click(function() {
                var token = "<?php echo e(csrf_token()); ?>";
                let assessment_idea_clarity = $('#assessment_idea_clarity').val();
                let assessment_outcome = $('#assessment_outcome').val();
                let assessment_why_implemented = $('#assessment_why_implemented').val();
                let assessment_challenges = $('#assessment_challenges').val();
                let assessment_is_no_implemented = $('#assessment_is_no_implemented').val();
                let assessment_has_alternatives = $('#assessment_has_alternatives').val();
                let assessment_has_less_benifits = $('#assessment_has_less_benifits').val();
                let benifits = $('#benifits').val();
                let idea_id = $('#idea_id').val();
                let remarks = $('#remarks').val();

                var data_array = {
                    'assessment_idea_clarity': assessment_idea_clarity,
                    'assessment_outcome': assessment_outcome,
                    'assessment_why_implemented': assessment_why_implemented,
                    'assessment_challenges': assessment_challenges,
                    'assessment_is_no_implemented': assessment_is_no_implemented,
                    'assessment_has_alternatives': assessment_has_alternatives,
                    'assessment_has_less_benifits': assessment_has_less_benifits,
                    'benifits': benifits,
                    'remarks': remarks,
                    'idea_id': idea_id,
                    '_token': token
                };

                $.ajax({
                    url: "<?php echo e(url('/')); ?>/ideas/updateidea/assessment/confirmations",
                    type: "POST",
                    data: data_array,
                    success: function(resp) {
                        console.log(resp);
                        toastr.success("Your Response has been Saved");
                    },
                    error: function() {
                        toastr.error("failed to store response");
                    }
                });

            });
        });

        //if idea sended for approval then set select box as disabled
    </script>

    <?php if(isset($disabled) && $disabled == 'disabled'): ?>
        <script>
            $(document).ready(function() {
                //  $('#assessment_idea_clarity','#assessment_outcome','#assessment_why_implemented','#assessment_challenges','#assessment_is_no_implemented','#assessment_has_alternatives','#assessment_has_less_benifits','#benifits').prop('disabled':'true');
                $('#assessment_idea_clarity , #assessment_outcome , #assessment_why_implemented , #assessment_challenges , #assessment_is_no_implemented , #assessment_has_alternatives , #assessment_has_less_benifits , #benifits')
                    .prop('disabled', 'disabled');
            });
        </script>
    <?php endif; ?>
    <script type="text/javascript">
        $(document).ready(function() {

            //seelect 2
            $('#benifits').select2();


            $('#error_message').hide();
            if (window.File && window.FileList && window.FileReader) {

                $(".image-file").on("change", function(e) {
                    $('#error_message').hide();
                    var file = e.target.files,
                        imagefiles = $(".image-file")[0].files;
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
                                $("#error_message li").append(
                                    `File size exceeds the limit of 50 MB`);
                                $("#error_message").show();
                                return;
                            }

                            if (fn_ext[1] == 'doc' || fn_ext[1] == 'docx' || fn_ext[1] ==
                                'xlsx' || fn_ext[1] == 'txt') {
                                img_src =
                                    '<?php echo e(asset('storage/app/public/uploads/asset/doc.png')); ?>';
                            } else if (fn_ext[1] == 'pdf') {
                                img_src =
                                    '<?php echo e(asset('storage/app/public/uploads/asset/pdf.png')); ?>';
                            } else if (fn_ext[1] == 'png' || fn_ext[1] == 'jpeg' || fn_ext[
                                    1] == 'jpg') {
                                img_src = e.target.result
                            } else if (fn_ext[1] === 'mp4' || fn_ext[1] === 'mov' || fn_ext[
                                    1] === 'avi') {
                                img_src =
                                    '<?php echo e(asset('storage/app/public/uploads/asset/vid.png')); ?>';
                            } else {
                                $('#error_message li').empty();
                                $('.image-file').val('');
                                $("#error_message li").append(
                                    `Select the specified type of files`);
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ideaportal/resources/views/frontend/myideas/view.blade.php ENDPATH**/ ?>