<?php

use App\Models\frontend\Users;
use App\Models\backend\AdminUsers;
use App\Models\frontend\IdeaStatus;
use App\Models\frontend\IdeaImages;
?>

<?php $__env->startSection('title', 'View Idea'); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">

        <div class="row breadcrumbs-top mt-3">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">View Idea</li>

                </ol>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="content-header row  pt-3 pb-3">
            <div class="content-header-left col-md-6 col-6">
                <h3 class="content-header-title">View Idea</h3>
            </div>
            <div class="content-header-left col-md-6 col-6">
                <div class="btn-group float-md-right  ms-2" style="float: right" role="group"
                    aria-label="Button group with nested dropdown" margin-top:-10px;>
                    <div class="btn-group" role="group">
                        
                        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary" >Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">

            <?php
                $image_path = $idea['image_path'];
                $full_image_path = 'storage/app/public/' . $image_path;
                $extArr = explode('.', $image_path);
                $ext = end($extArr);

                $disabled = '';
                if (isset($idea->approving_authority_approval) && $idea->approving_authority_approval == 1) {
                    $disabled = 'disabled';
                }
            ?>

            <div class="card-body" style="min-height:320px">
                <?php
                    $user = Users::where('user_id', $idea->user_id)->first();
                    if (isset($idea['created_at'])) {
                        $created_at_arr = explode(' ', $idea['created_at']);
                        $created_at = '| Submitted on : ' . $created_at_arr[0];
                    } else {
                        $created_at = '';
                    }
                ?>
                <div class="row">
                    <div class="col-md-7 col-12" style="position:relative;min-height:320px;">

                        <div id="idea_title">
                            <h2 class="mb-3 idea-heading"><strong><?php echo e($idea->title); ?></strong></h2>
                            <h3>Idea Number: <?php echo e($idea->idea_id); ?></h3>
                            <br>
                            <p style="color: #979797;"><i>Author : <?php echo e($user['name']); ?> <?php echo e($user['last_name']); ?>

                                    <span><?php echo e($created_at); ?></span> </i></p>
                        </div>
                        <div id="idea_description" class='border m-1 p-2 rounded'>
                            <p class='h4'>Idea Description</p>
                            
                            <p class="mb-3"><?php echo e(isset($idea->description) ? $idea->description : ''); ?></p>

                            

                            <?php if(isset($assessment_journey->idea_description)): ?>
                                <div class="card">
                                    Assessment User Response : <?php echo e($assessment_journey->idea_description); ?>

                                </div>
                            <?php endif; ?>

                        </div>

                        <div id="idea_description" class='border m-1 p-2 rounded'>
                            <p class='h4'>Outcome of Idea</p>
                            
                            <p class="mb-3"><?php echo e(isset($idea->idea_outcome) ? $idea->idea_outcome : ''); ?></p>


                            <?php if(isset($assessment_journey->outcome)): ?>
                                <div class="card">
                                    Assessment User Response : <?php echo e($assessment_journey->outcome); ?>

                                </div>
                            <?php endif; ?>

                        </div>

                        <div id="idea_description" class='border m-1 p-2 rounded'>
                            <p class='h4'>Describe why the idea should to be implemented/What makes your idea unique?
                            </p>
                            
                            <p class="mb-3"><?php echo e(isset($idea->why_implemented) ? $idea->why_implemented : ''); ?></p>


                            <?php if(isset($assessment_journey->why_implemented)): ?>
                                <div class="card">
                                    Assessment User Response : <?php echo e($assessment_journey->why_implemented); ?>

                                </div>
                            <?php endif; ?>

                        </div>

                        <div id="idea_description" class='border m-1 p-2 rounded'>
                            <p class='h4'>The idea presented has no risks or challenges to the Business</p>
                            
                            <p class="mb-3"><?php echo e(isset($idea->challeges) ? $idea->challeges : ''); ?></p>



                            <?php if(isset($assessment_journey->challenges)): ?>
                                <div class="card">
                                    Assessment User Response : <?php echo e($assessment_journey->challenges); ?>

                                </div>
                            <?php endif; ?>


                        </div>

                        <div id="idea_description" class='border m-1 p-2 rounded'>
                            <p class='h4'>This idea is new and not implemented anywhere in JMB Group</p>
                            
                            <p class="mb-3">
                                <?php echo e(isset($idea->already_implemented_or_no) ? $idea->already_implemented_or_no : ''); ?></p>


                            <?php if(isset($assessment_journey->idea_not_implemented)): ?>
                                <div class="card">
                                    Assessment User Response : <?php echo e($assessment_journey->idea_not_implemented); ?>

                                </div>
                            <?php endif; ?>


                        </div>
                        <div id="idea_description" class='border m-1 p-2 rounded'>
                            <p class='h4'>This idea has no other alternative </p>
                            
                            <p class="mb-3"><?php echo e(isset($idea->alternatives) ? $idea->alternatives : ''); ?></p>


                            <?php if(isset($assessment_journey->has_alternatives)): ?>
                                <div class="card">
                                    Assessment User Response : <?php echo e($assessment_journey->has_alternatives); ?>

                                </div>
                            <?php endif; ?>


                        </div>

                        <div id="idea_description" class='border m-1 p-2 rounded'>
                            <p class='h4'>Is the cost of implementing the idea is less than the benefit</p>
                            
                            <p class="mb-3"><?php echo e(isset($idea->cost_and_benifits) ? $idea->cost_and_benifits : ''); ?></p>

                            
                            <?php if(isset($assessment_journey->has_less_benifits)): ?>
                                <div class="card">
                                    Assessment User Response : <?php echo e($assessment_journey->has_less_benifits); ?>

                                </div>
                            <?php endif; ?>


                        </div>

                        <div id="idea_description" class='border m-1 p-2 rounded'>
                            <p class='h4'>Benefits of Implementing the Idea</p>
                            
                            <p class="mb-3"><?php echo e(isset($idea->benifits) ? $idea->benifits : ''); ?></p>

                            
                            <?php if(isset($assessment_journey->benifits)): ?>
                                <div class="card">
                                    Assessment User Response : <?php echo e($assessment_journey->benifits); ?>

                                </div>
                            <?php endif; ?>



                        </div>

                        <?php
                            $idea_uni_id = $idea->idea_uni_id;
                            $idea_images = IdeaImages::where(['is_supporting' => 0, 'idea_uni_id' => $idea_uni_id])
                                ->whereNotNull('idea_uni_id')
                                ->get();
                        ?>
                        <?php if(count($idea_images) > 0): ?>
                            <div class="full-img-boxin">
                                <h3 class="attachment-heading mb-3">Attachment</h3>
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
                                            } else {
                                                $label_text = 'View Image';
                                                $img_path = asset('storage/app/public/' . $idea_image->image_path);
                                            }
                                        ?>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <a style="margin-top:10px;"
                                                class="card card-body shadow <?php echo e($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' ? '' : 'test-popup-link'); ?>"
                                                href="<?php echo e($file_path); ?>" target="_blank">
                                                <img style="width:100%;height:100px; object-fit:contain"
                                                    src="<?php echo e($img_path); ?>"
                                                    alt="<?php echo e($image_path == 'null' ? 'Image not available' : 'Idea Image'); ?> ">
                                                <p class="h5 text-center mt-2"><?php echo e($label_text); ?></p>
                                            </a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>



                            </div>
                        <?php endif; ?>

  

                            <div class="form_container chat-form" style="position: relative;">
                                <form method="POST" action="<?php echo e(route('ideas.storeSupportingdocs')); ?>"
                                    enctype="multipart/form-data">

                                    <?php echo csrf_field(); ?>
                                    <div class="col-12 col-sm-6 col-md-6 col-6">
                                        <div class="dropzone-container">
                                            
                                        </div>
                                    </div>

                                    <input type="hidden" name="idea_id" value="<?php echo e($idea->idea_id); ?>" id='idea_id'>
                                    

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
                                    <div style="border:none;">
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
                                                        <div
                                                            style="width:100%;height:150px;overflow:hidden;padding:15px 0px;">
                                                            <img class="card-img-top" src="<?php echo e($img_path); ?>"
                                                                alt="Card image cap"
                                                                style="width:100%;height:100%;object-position:center;object-fit:contain">
                                                        </div>
                                                        <div class="card-body">
                                                            <p style="text-overflow: ellipsis;overflow: hidden;width: 100%;white-space: nowrap;"
                                                                class="card-text"><?php echo e($image->file_name); ?></p>
                                                            <a href="<?php echo e(route('ideas.delete_image', ['id' => $image->image_id])); ?>"
                                                                class="btn btn-sm btn-danger cross-image
                                                                                   remove"
                                                                style="margin:5px 8px 5px 0px;"
                                                                onclick="return confirm('Are you sure you want to delete this File')">Remove</a>
                                                            <?php if($ext == 'doc' || $ext == 'pdf' || $ext == 'docx' || $ext == 'xlsx' || $ext == 'txt'): ?>
                                                                <a style="margin:5px 5px 5px 0px;"
                                                                    href="<?php echo e($file_path); ?>"
                                                                    class="btn btn-sm btn-primary <?php echo e($ext == 'pdf' || $ext == 'doc' || $ext == 'xlsx' || $ext == 'txt' || $ext == 'docx' ? '' : 'test-popup-link'); ?>"
                                                                    target="_blank">View</a>
                                                            <?php elseif($ext === 'mp4' || $ext === 'mov' || $ext === 'avi'): ?>
                                                                <a style="margin:5px 5px 5px 0px;"
                                                                    href="<?php echo e($file_path); ?>"
                                                                    class="btn btn-sm btn-primary <?php echo e($ext === 'mp4' || $ext === 'mov' || $ext === 'avi' ? '' : 'test-popup-link'); ?>"
                                                                    target="_blank">View</a>
                                                            <?php else: ?>
                                                                <a style="margin:5px 5px 5px 0px;"
                                                                    href="<?php echo e($img_path); ?>"
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

                    
                    <div class="col-md-5 col-12">
                        <div class="bg-back">
                            <div class="status-heading">
                                <h4 class="mb-4"><strong>Status</strong></h4>
                            </div>
                            <div id="idea_status">
    
                                <?php if($idea->active_status == 'pending'): ?>
                                Status : Pending
                                <?php elseif($idea->active_status == 'in_assessment'): ?>
                                
                                <?php if($idea->assessment_team_approval == 1	): ?>
                                    Status : Approved by Assessment Team
                                <?php else: ?>
                                    Status : Under Assessment
                                <?php endif; ?>
                                <?php elseif($idea->active_status == 'under_approving_authority'): ?>
                                Status : Under Approval
                                <?php elseif($idea->active_status == 'on_hold'): ?>
                                Status : On-hold
                                <?php elseif($idea->active_status == 'resubmit'): ?>
                                <?php
                                $reason = $idea->resubmit_reason == null ? '' : '(Reason : '.$idea->resubmit_reason.')';
                                ?>
                                Status : Revise Request <?php echo e($reason); ?>

                                <?php elseif($idea->active_status == 'reject'): ?>
                                <?php
                                $reason = $idea->reject_reason == null ? '' : '(Reason : '.$idea->reject_reason.')';
                                ?>
                                Status : Rejected <?php echo e($reason); ?>

                                <?php elseif($idea->active_status == 'implementation'): ?>
                                Status : Implementation
                                <?php elseif($idea->active_status == 'implemented'): ?>
                                Status : Implemented
                                <?php endif; ?>
                            </div>
    
                            <ul class="timeline">
                                <?php
                                $idea_status = IdeaStatus::where('idea_id',$idea->idea_id)->get();
                                // dump($idea_status);
                               // dd($idea_status->toArray());
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

                                            <?php echo e($user_name['last_name']); ?>

    
                                            <?php if(isset($is->user_role)): ?>
                                            &#40;
                                                <?php echo e($is->user_role); ?>

                                            &#41;
                                            <?php endif; ?>
                                            <br></strong> on <strong> <?php echo e($date[0]); ?></strong> at
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
                              //  dd($user_name->toArray());
                                ?>
                                <li>
                                    <p>Idea has been approved by
                                        <strong><?php echo e($user_name['name']); ?>

                                            <?php echo e($user_name['last_name']); ?>

                                            <?php if(isset($is->user_role)): ?>
                                            &#40;
                                                <?php echo e($is->user_role); ?>

                                            &#41;
                                            <?php endif; ?>
                                            <br></strong> on <strong> <?php echo e($date[0]); ?></strong> at
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

                                            <?php echo e($user_name['last_name']); ?>

                                            <?php if(isset($is->user_role)): ?>
                                            &#40;
                                                <?php echo e($is->user_role); ?>

                                            &#41;
                                            <?php endif; ?>
                                            <br></strong> on <strong> <?php echo e($date[0]); ?></strong> at
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

                                            <?php echo e($user_name['last_name']); ?>

                                            <?php if(isset($is->user_role)): ?>
                                            &#40;
                                                <?php echo e($is->user_role); ?>

                                            &#41;
                                            <?php endif; ?>
                                            <br></strong> on <strong> <?php echo e($date[0]); ?></strong> at
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
                                    <p>Idea Kept On Hold  by <?php echo e(isset($is->role_name)?$is->role_name:''); ?>

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

                        
                        <div class="row m-1 mt-1">
                            <form action="<?php echo e(route('ideaApproveWithbudget')); ?>" method="post"
                                id='approveWithBudgetForm'>
                                <?php echo csrf_field(); ?>
                                <div class="col-md-12 mb-1">
                                    <label for="">Expenses Estimation </label>
                                    <input type="hidden" value="<?php echo e($idea->idea_id); ?>" name="idea_id"
                                        id="budgetForm_idea_id">

                                    <input type="text" name="estimate_budget" id="estimate_budget"
                                        value="<?php echo e(isset($idea->estimate_budget) ? $idea->estimate_budget : 0); ?>"
                                        class='form-control' placeholder='Enter Estimate Amount' readonly>
                                    <span class="text-danger" id="error_estimate_budget"></span>

                                </div>

                                <div class="col-md-12 mb-1">
                                    <label for="">Expenses Approved</label>
                                    <input type="text" name="expenses_approved" id="expenses_approved"
                                        class='form-control' placeholder="Enter Approved Amount" readonly
                                        value="<?php echo e(isset($idea->expenses_approved) ? $idea->expenses_approved : ''); ?>">
                                    <span class="text-danger" id="error_expenses_approved"></span>
                                </div>


                                <div class="col-md-12 mb-1">
                                    <label for=""> Expenses Incurred </label>
                                    <input type="text" name="expenses_incurred" id="expenses_incurred"
                                        class='form-control' placeholder="Enter Incurred Amount" readonly
                                        value="<?php echo e(isset($idea->expenses_incurred) ? $idea->expenses_incurred : ''); ?>">
                                    <span class="text-danger" id="error_expenses_incurred"></span>
                                </div>

                                <div class="col-md-12 mb-1">
                                    <label for=""> Expenses By Company Details </label>
                                    <?php echo e(Form::select('expenses_approved_company', $company, $idea->expenses_approved_company, ['class' => 'form-control','disabled' => true, 'id' => 'expenses_approved_company', 'Placeholder' => 'Expenses By Company Details'])); ?>

                                    <span class="text-danger" id="error_expenses_approved_company"></span>
                                </div>

                                <div class="col-md-12 mb-1">
                                    <label for=""> Expenses By SPOC Details </label>
                                    <select name="spoc_details" id="spoc_details" class='form-control' disabled>
                                        <option value="">Select</option>
                                    </select>
                                    <span class="text-danger" id="error_spoc_details"></span>
                                </div>

                            </form>
                        </div>
                      
                    </div>
    
                    <?php if($idea->implemented == 1 && $idea->active_status == 'implemented'): ?>
                    <?php if($idea->certificate != 1): ?>
    
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveForCertificateModal">Generate Certificate</button>
                    </div>
                    <?php else: ?>
                    <div class="d-flex flex-column align-items-end mt-3">
                        <p>Certificate has already been Generated</p>
                        <a class="btn btn-primary" href="<?php echo e(route('admin.rewards.view',['id'=>$idea->idea_id])); ?>">View
                            Certificate</a>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
                </div>

                    </div>

                </div>



            </div>

     

    
    <div class="card" style="margin-top: 20px">

        <div class="card-body idea-discussion-in">
            <h3 class="mb-4">Idea Discussion</h3>
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
                        <div class="users-img mb-3"
                            style="display:flex !important;justify-content: flex-start;align-items:center; <?php echo e($style); ?>">
                            
                            <div class="<?php echo e($class_idea_discussion); ?>"
                                style="display:flex;flex-direction:column;justify-content:space-between;<?php echo e($style2); ?>">
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
                                            <img src="<?php echo e($url); ?>" alt="Click To View" width="80px"
                                                height="80px">
                                        <?php elseif(in_array($fileExtension, ['mp4', 'avi', 'mov', 'wmv'])): ?>
                                            <i class="fa fa-file-video-o" aria-hidden="true"
                                                style="font-size: 40px;"></i>
                                        <?php elseif(in_array($fileExtension, ['pdf', 'doc', 'docx'])): ?>
                                            <i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 40px;"></i>
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

            <?php
                $btn_disabled = '';
                if ($idea->approving_authority_approval == 1) {
                    $btn_disabled = 'disabled';
                }
            ?>
            

            <div class="form_container chat-form" style="position: relative;">
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

                        <button <?php echo e($btn_disabled); ?> type="submit"
                            style="background: none; border: none; cursor: pointer;">
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
    <!-- Modal -->
    <div class="modal fade" id="app_by_app_auth" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Approve Idea</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to Approve the Idea ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button onclick="Submit_budget_form()" class='btn btn-primary'> Yes </button>
                    
                </div>
            </div>
        </div>
    </div>


    
    <!-- Modal -->
    <div class="modal fade" id="update_details_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to Update Expense Details ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button onclick="update_budget_form()" class='btn btn-primary'> Yes </button>
                </div>
            </div>
            </d  </div>

        <?php $__env->stopSection(); ?>
        <?php $__env->startSection('scripts'); ?>

            <script type="text/javascript">
                $(document).ready(function() {

                    //seelect 2
                    $('#benifits').select2();
                    getSOPC();


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
                            url: "<?php echo e(url('/')); ?>/ideas/updateidea/approver/confirmations",
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

            <script>
                $(document).ready(function() {
                    //    $('#app_by_app_auth').modal('show');
                    $('#expenses_approved_company').change(function() {
                        getSOPC();
                    });
                });

                function getSOPC() {
                    var company_id = $('#expenses_approved_company').val();
                    if (company_id != '') {
                        var token = "<?php echo e(csrf_token()); ?>";
                        var send_data = {
                            '_token': token,
                            'company_id': company_id
                        };
                        var surl = "<?php echo e(url('/')); ?>/ajax/get/employees";
                        $.ajax({
                            url: surl,
                            type: "post",
                            data: send_data,

                            success: function(resp) {
                                // $('#spoc_details').html(resp);
                                var db_selected_name = "<?php echo e($idea->spoc_details); ?>";
                                var htm = "<optio value=''>Select option</option>";
                                if (resp) {
                                    var resp_array = JSON.parse(resp);
                                    console.log(resp);
                                    if (resp_array.length > 0) {
                                        $(resp_array).each(function(key, value) {
                                            var sts = null;
                                            if (value.user_id == db_selected_name) {
                                                sts = 'selected';
                                            }
                                            htm +=
                                                `<option value=${value.user_id} ${sts}>${value.name} ${value.last_name} </option>`;

                                        });
                                    }
                                    // console.log(htm);
                                    $('#spoc_details').html(htm);
                                }
                            }
                        });
                    }
                }

                function showConfirm_model() {
                    var est_budget = $('#estimate_budget').val();
                    var budget_Approved = $('#expenses_approved').val();
                    var budget_incured = $('#expenses_incurred').val();
                    var company_id = $('#expenses_approved_company').val();
                    var user_id = $('#spoc_details').val();
                    var error = true;
                    if (est_budget == "") {
                        $('#error_estimate_budget').html("Please Enter Budget");
                        error = false;
                    }

                    // if(budget_Approved == ""){
                    //    $('#expenses_approved').html("Please Enter Budget");
                    // }

                    // if(budget_incured == ""){
                    //    $('#').html("");
                    // }

                    if (company_id == "") {
                        $('#error_expenses_approved_company').html("Please Select Company");
                        error = false;
                    }

                    if (user_id == "") {
                        $('#error_spoc_details').html("Please Select Employee");
                        error = false;
                    }


                    //if error is true then show modal
                    if (error == true) {
                        $('#app_by_app_auth').modal('show');
                    }
                }

                function Submit_budget_form() {
                    $('#approveWithBudgetForm').submit();
                }

                function update_budget_details() {
                    $('#update_details_modal').modal('show');
                }

                function update_budget_form() {
                    var idea_id = $('#budgetForm_idea_id').val();
                    var estimate_budget = $('#estimate_budget').val();
                    var expenses_approved = $('#expenses_approved').val();
                    var expenses_incurred = $('#expenses_incurred').val();
                    var expenses_approved_company = $('#expenses_approved_company').val();
                    var spoc_details = $('#spoc_details').val();
                    var token = "<?php echo e(csrf_token()); ?>";

                    var data_arr = {
                        '_token': token,
                        'idea_id': idea_id,
                        'estimate_budget': estimate_budget,
                        'expenses_approved': expenses_approved,
                        'expenses_approved_company': expenses_approved_company,
                        'spoc_details': spoc_details
                    };
                    $.ajax({
                        url: "<?php echo e(route('ideaupdatebudgetdetails')); ?>",
                        type: 'POST',
                        data: data_arr,
                        success: function(resp) {
                            if (resp) {
                                toastr.success('Details has been Updated');
                            } else {
                                toastr.error('Failed to update Details');
                            }
                            $('#update_details_modal').modal('hide');
                        },
                        error: function() {
                            toastr.error('Failed to update Details');
                            $('#update_details_modal').modal('hide');
                        }
                    });

                }
            </script>

        <?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ideaportal/resources/views/backend/ideaManagement/view.blade.php ENDPATH**/ ?>