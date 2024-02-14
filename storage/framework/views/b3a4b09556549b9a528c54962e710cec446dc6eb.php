<?php
use App\Models\frontend\Ideas;
use App\Models\frontend\IdeaRevisionImages;
?>

<?php $__env->startSection('title', 'User Dashboard | Idea Revisions'); ?>

<?php $__env->startSection('content'); ?>


<section class="cs-breadcrumb">
    <div class="container-fluid">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <h1>Idea Revisions</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('user.dashboard')); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Idea Revisions</li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Back" <?php if(session()->has('sub_page')): ?> href="<?php echo e(session('sub_page')); ?> " <?php else: ?> href="<?php echo e(route('ideas.index')); ?>" <?php endif; ?> >
                        <i style="margin-right:6px;font-size:1.1em;" class="fa fa-angle-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="cs-content">
    <div class="container-fluid">
        <div id="basic-datatable">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table zero-configuration m-0 p-0" id="tbl-datatable">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Title</th>
                                    <th>Remark</th>
                                    <th>File Uploaded</th>
                                    <th>Revision Date</th>
                                    <th>Revision Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($ideas) && count($ideas)>0): ?>
                                <?php
                                $srno = 1;
                                ?>
                                <?php $__currentLoopData = $ideas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $image_path = $idea['image_path'];
                                $full_image_path = 'storage/app/public/'.$image_path;
                                $extArr = explode('.',$image_path);
                                $ext = end($extArr);
                                ?>
                                <tr>
                                    <td><?php echo e($srno); ?></td>
                                    <td><?php echo e($idea->title); ?></td>
                                    <td class='w-25'>
                                        <?php if(isset($idea->rev_reasone)): ?>
                                        <?php echo e($idea->rev_reasone); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $files = ideaRevisionImages::where('idea_uni_id',$idea->idea_uni_id)->whereNotNull('idea_uni_id')->get();
                                        // dd($idea->idea_uni_id);
                                        // foreach($files as $file) {
                                        // dd(asset('storage/app/public/'.$file->image_path));
                                        // }
                                        ?>
                                        
                                        <?php if(count($files) > 0): ?>
                                        <a href="#" class="images_modal_class" data-id="<?php echo e($idea->idea_uni_id); ?>"><?php echo e(count($files).' files'); ?></a>
                                        <?php else: ?>
                                        <p>No files yet</p>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $date = explode(' ' ,$idea->created_at);
                                        ?>
                                        <?php echo e($date[0]); ?>

                                    </td>
                                    <td>
                                        <?php
                                        $date = explode(' ' ,$idea->created_at);
                                        ?>
                                        <?php echo e($date[1]); ?>

                                    </td>
                                    <td>
                                        <a href="<?php echo e(url('/ideas/viewIdeaRevision',$idea->idea_revision_id)); ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $srno++;
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="imagesModal" tabindex="-1" role="dialog" aria-labelledby="imagesModallLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- w-100 class so that header
            div covers 100% width of parent div -->
                <h5 class="modal-title w-100" id="imagesModallLabel">
                    Idea Images
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x
                    </span>
                </button>
            </div>
            <!--Modal body with image-->
            <div class="modal-body">
                <div style="display:grid;grid-template-columns: auto auto auto auto;grid-gap:10px">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<script src="<?php echo e(asset('public/backend-assets/vendors/js/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend-assets/vendors/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script>
    $(document).on("click", ".images_modal_class", function() {
        $('#imagesModal').on('hidden.bs.modal', function() {
            $('#imagesModal .modal-body div').empty();
        });
        var idea_uni_id = $(this).data('id');
        // console.log(idea_uni_id);
        if (idea_uni_id != "") {
            let csrf = '<?php echo csrf_token(); ?>';
            var data = {
                '_token': csrf
                , 'idea_uni_id': idea_uni_id
            }
            $.ajax({
                type: 'POST'
                , url: '<?php echo e(url('idea/ajax_get_idea_revision_images_modal')); ?>'
                , data: data
                , success: function(data) {
                    $('.modal-body div').append(data);
                    $('#imagesModal').modal('show');
                }
            });
        }
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\ideaportal\resources\views/frontend/ideas/ideaRevision.blade.php ENDPATH**/ ?>