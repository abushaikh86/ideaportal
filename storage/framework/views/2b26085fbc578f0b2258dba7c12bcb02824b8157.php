<?php
use App\Models\backend\AdminUsers;
use App\Models\backend\Category;
use App\Models\frontend\Users;
use App\Models\frontend\IdeaImages;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Models\Rolesexternal;
use App\Models\backend\Company;

?>
<?php
    $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
    $role = $roles_external->role_type;
    $buttons = [];
    if (!empty($roles_external)) {
        $buttons = explode(',', $roles_external->button_values);
    }
?>

<?php $__env->startSection('title', 'Dashboard | All Idea'); ?>
<?php $__env->startSection('content'); ?>


<section class="cs-breadcrumb">
    <div class="container-fluid">
        <?php if($roles_external->role_name == 'User'): ?>
            <h1>All Ideas</h1>
        <?php elseif(
            $roles_external->role_name == 'Assessment Team' ||
            $roles_external->role_name == 'Approving Authority' ||
            $roles_external->role_name == 'Implementation'): ?>
            <h1>All Ideas</h1>
        <?php endif; ?>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('user.dashboard')); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">All Ideas</li>
        </ol>
    </div>
</section>


<section class="cs-content">
    <div class="container-fluid">
        <div id="basic-datatable">
            <div class="card">
                <div class="card-body">
                    <div class="element-group">
                        <div class="input-group">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <input class="form-control" id="daterange" placeholder="Search by date range..">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <?php if(isset($ideas) && count($ideas) > 0): ?>
                            <table class="table zero-configuration new-configuration-table" id="tbl-datatable">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>ID</th>
                                        <?php if($role == 'Assessment Team' || $role == 'Approving Authority' || $role == 'Implementation'): ?>
                                            <th>Submitted By</th>
                                        <?php endif; ?>
                                        <th>Title</th>
                                        <th class="file_uploaded">File Uploaded</th>
                                        <th>Submitted On</th>
                                        <th>Company</th>
                                        <th>Status</th>
                                        <th>Rating</th>
                                        <th>Category</th>
                                        <th class="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $srno = 1;
                                    ?>
                                    <?php $__currentLoopData = $ideas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $company_id = $idea->company_data->company_id ?? '';
                                            $company = Company::where('company_id', $company_id)->pluck('company_name');

                                            $image_path = $idea->image_path;
                                            $full_image_path = 'storage/app/public/' . $image_path;
                                            $extArr = explode('.', $image_path);
                                            $ext = end($extArr);
                                            // dump($ext);
                                            $user = Users::where('user_id', $idea->user_id)->first();
                                            $idea_status = $idea->active_status;
                                            $status = '';
                                            $status_color = '';

                                            if ($idea_status == 'in_assessment' && $idea->assessment_team_approval == 0) {
                                                //     $status = "Approved by assement team";
                                                $status = 'Under Assessment';
                                                //role  {{ dd($roles_external->role_name) }}
                                                if ($roles_external->role_name == 'Assessment Team') {
                                                    $status = 'Under Assessment';
                                                } elseif ($roles_external->role_name == 'Approving Authority') {
                                                    $status = 'Approved by Assessment';
                                                }
                                                $status_color = 'badge bg-secondary me-1';
                                            }
                                            if ($idea_status == 'in_assessment' && $idea->assessment_team_approval == 1) {
                                                //     $status = "Approved by assement team";
                                                $status = 'Processed for Approval';

                                                //role  {{ dd($roles_external->role_name) }}
                                                if ($roles_external->role_name == 'Assessment Team') {
                                                    $status = 'Processed for Approval';
                                                } elseif ($roles_external->role_name == 'Approving Authority') {
                                                    $status = 'Approved by Assessment';
                                                }
                                                $status_color = 'badge bg-secondary me-1';
                                            } elseif ($idea_status == 'pending') {
                                                $status = 'Pending';
                                                $status_color = 'badge bg-secondary me-1';
                                            } elseif ($idea_status == 'under_approving_authority') {
                                                $status = 'Under Approval';
                                                if ($roles_external->role_name == 'Approving Authority' || $roles_external->role_name == 'Assessment Team') {
                                                    $status = 'Processed for Implementation';
                                                }

                                                $status_color = 'badge bg-warning me-1';
                                            } elseif ($idea_status == 'implementation') {
                                                $status = 'Implementation';
                                                $status_color = 'badge bg-danger me-1';
                                            } elseif ($idea_status == 'reject') {
                                                $reason =
                                                    $idea->reject_reason == null
                                                        ? ''
                                                        : '(Reason :
                            ' .
                                                            $idea->reject_reason .
                                                            ')';
                                                $status = 'Rejected ' . $reason;
                                                //use user role
                                                if ($roles_external->role_name == 'Assessment Team') {
                                                    $status = 'Rejected by Assessment ' . $reason;
                                                } elseif ($roles_external->role_name == 'Approving Authority') {
                                                    $status = 'Rejected by Approver ' . $reason;
                                                }

                                                $status_color = 'badge bg-danger me-1';
                                            } elseif ($idea_status == 'on_hold') {
                                                $status = 'On-hold';
                                                //use user role
                                                if ($roles_external->role_name == 'Assessment Team') {
                                                    $status = ' Kept On Hold- by Assessment';
                                                } elseif ($roles_external->role_name == 'Approving Authority') {
                                                    $status = 'Kept On Hold- by Approver';
                                                }

                                                $status_color = 'badge bg-secondary me-1';
                                            } elseif ($idea_status == 'resubmit') {
                                                $data = FacadesDB::table('ideas')
                                                    ->where('idea_id', $idea->idea_id)
                                                    ->first();
                                                // dd($data);
                                                if ($roles_external->role_type == 'User' && $data->assessment_team_approval == 1 && $data->asstmnt_rev_status == 0) {
                                                    $status = 'Under Assessment';
                                                    $status_color = 'badge bg-secondary me-1';
                                                } else {
                                                    $reason =
                                                        $idea->resubmit_reason == null
                                                            ? ''
                                                            : '(Reason :
                            ' .
                                                                $idea->resubmit_reason .
                                                                ')';
                                                    $status = 'Revise Request ' . $reason;
                                                    if ($roles_external->role_name == 'Assessment Team') {
                                                        $status = 'To be Revised by Assessment ' . $reason;
                                                    } elseif ($roles_external->role_name == 'Approving Authority') {
                                                        $status = 'To be Revised by Approver ' . $reason;
                                                    }

                                                    $status_color = 'badge bg-warning me-1';
                                                }
                                            } elseif ($idea_status == 'implemented') {
                                                $status = 'Implemented';
                                                $status_color = 'badge bg-warning me-1';
                                            }

                                            $category =
                                                $idea->category_id == '' || !isset($idea->category_id)
                                                    ? 'Not
                            Assigned'
                                                    : Category::where('category_id', $idea->category_id)->first()['category_name'];
                                        ?>

                                        <tr class="idea">
                                            <td><?php echo e($srno); ?></td>

                                            <td><?php echo e('000' . $idea->idea_id); ?></td>

                                            <?php if($role == 'Assessment Team' || $role == 'Approving Authority' || $role == 'Implementation'): ?>
                                            <td>
                                                <?php if(isset($user['name'])): ?>
                                                    <?php echo e($user['name']); ?>

                                                <?php endif; ?>

                                                <?php if(isset($user['last_name'])): ?>
                                                    <?php echo e($user['last_name']); ?>

                                                <?php endif; ?>
                                            </td>
                                            <?php endif; ?>

                                            <td><?php echo e($idea->title); ?></td>

                                            <td>
                                                <?php
                                                $files = IdeaImages::where(['is_supporting' => 0, 'idea_uni_id' => $idea->idea_uni_id])
                                                        ->whereNotNull('idea_uni_id')
                                                        ->get();
                                                ?>

                                                <?php if(count($files) > 0): ?>
                                                    <a href="#" class="images_modal_class" data-id="<?php echo e($idea->idea_uni_id); ?>"><?php echo e(count($files) . ' files'); ?></a>
                                                <?php else: ?>
                                                    <span>No files yet</span>
                                                <?php endif; ?>
                                            </td>

                                            <td><?php echo e(explode(' ', $idea->created_at)[0]); ?></td>
                                            
                                            <td><?php echo e($company[0] ?? ''); ?></td>
                                            
                                            <td>
                                                <i class=" <?php echo e($status_color); ?>"></i>
                                                <?php echo e($status); ?>

                                            </td>

                                            <td>
                                                <span class="rating-cell" data-rating="0">
                                                    <button type="button" class="btn btn-primary btn-sm open-modal-btn" data-id="<?php echo e($idea->idea_id); ?>">
                                                        <?php echo e($idea->rating ?? 0); ?> 
                                                        <span class="ml-2 badge badge-warning" style="background:#bff03a; color:#000; margin-left:5px;">&#9733</span>
                                                    </button>
                                                </span>
                                            </td>

                                            <td><?php echo e($category); ?></td>

                                            <td>
                                                <div class="btn-group">
                                                    <?php echo Form::open([ 'method' => 'GET', 'url' => ['/ideas/view', $idea->idea_id,1], ]); ?>

                                                    <?php echo Form::button('<i class="fa fa-eye"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-sm btn-info btn-orange',
                                                        'data-toggle' => 'tooltip',
                                                        'data-placement' => 'top',
                                                        'title' => 'View Idea',
                                                    ]); ?>

                                                    <?php echo Form::close(); ?>

                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                            $srno++;
                                        ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <h4>Ideas not posted yet!</h4>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="ratingModal" class="modal">
    <div class="modal-content" style="width: 30%;">
        <span class="close" style="cursor: default;">&times;</span>
        <div id="stars-container">
            <!-- Stars will be dynamically added here using JavaScript -->
        </div>
    </div>
</div>

<div class="modal fade" id="imagesModal" tabindex="-1" role="dialog" aria-labelledby="imagesModallLabel"
    aria-hidden="true">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#tbl-datatable thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#tbl-datatable thead');

        var table = $('#tbl-datatable').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function() {
                var api = this.api();

                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function(colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        if (title == 'Submitted On') {
                            $(cell).html('<input type="text" placeholder="' + title + '" />');
                        } else {
                            $(cell).html('<input type="text" placeholder="' + title + '" />');
                        }
                        // On every keypress in this input
                        $(
                                'input', $('.filters th').eq($(api.column(colIdx).header())
                                    .index())
                            )
                            .off('keyup change')
                            .on('change', function(e) {
                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr =
                                    '({search})'; //$(this).parents('th').find('select').val();

                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != '' ?
                                        regexr.replace('{search}', '(((' + this.value +
                                            ')))') :
                                        '', this.value != '', this.value == ''
                                    )
                                    .draw();
                            })
                            .on('keyup', function(e) {
                                e.stopPropagation();

                                $(this).trigger('change');
                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },
        });
        var role = '<?php echo e($role); ?>';
        //console.log(role);
        minDateFilter = "";
        maxDateFilter = "";

        $("#daterange").daterangepicker();
        $("#daterange").on("apply.daterangepicker", function(ev, picker) {
            minDateFilter = Date.parse(picker.startDate);
            maxDateFilter = Date.parse(picker.endDate);

            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {


                if (role == 'Assessment Team' || role == 'Approving Authority' || role ==
                    'Implementation') {
                    var date = Date.parse(data[5]);
                } else {
                    var date = Date.parse(data[4]);
                }

                if (
                    (isNaN(minDateFilter) && isNaN(maxDateFilter)) ||
                    (isNaN(minDateFilter) && date <= maxDateFilter) ||
                    (minDateFilter <= date && isNaN(maxDateFilter)) ||
                    (minDateFilter <= date && date <= maxDateFilter)
                ) {
                    return true;
                }
                return false;
            });
            table.draw();
        });

    });

    $(document).on("click", ".images_modal_class", function() {
        $('#imagesModal').on('hidden.bs.modal', function() {
            $('#imagesModal .modal-body div').empty();
        });
        var idea_uni_id = $(this).data('id');
        // console.log(idea_uni_id);
        if (idea_uni_id != "") {
            let csrf = '<?php echo csrf_token(); ?>';
            var data = {
                '_token': csrf,
                'idea_uni_id': idea_uni_id
            }
            $.ajax({
                type: 'POST',
                url: '<?php echo e(url('idea/ajax_get_images_modal')); ?>',
                data: data,
                success: function(data) {
                    $('.modal-body div').append(data);
                    $('#imagesModal').modal('show');
                }
            });
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ratingCells = document.querySelectorAll('.rating-cell');
        const modal = document.getElementById('ratingModal');
        const starsContainer = document.getElementById('stars-container');

        ratingCells.forEach(cell => {
            const openModalBtn = cell.querySelector('.open-modal-btn');
            //  openModalBtn.addEventListener('click', () => openModal(cell, openModalBtn));
        });



        function openModal(cell, openModalBtn) {
            const currentRating = parseInt(cell.getAttribute('data-rating'));
            starsContainer.innerHTML = ''; // Clear previous stars

            for (let i = 1; i <= 10; i++) {
                const star = document.createElement('span');
                star.className = `star ${i <= currentRating ? 'selected' : ''}`;
                star.innerHTML = '&#9733;'; // Unicode character for a star
                star.addEventListener('click', () => submitRating(cell, openModalBtn, i));
                starsContainer.appendChild(star);
            }

            modal.style.display = 'block';
        }


        function submitRating(currentCell, openModalBtn, rating) {
            const ideaId = openModalBtn.getAttribute('data-id');

            // AJAX call
            $.ajax({
                type: 'GET',
                url: '<?php echo e(route('ideas.rating')); ?>', // Replace with your actual endpoint
                data: {
                    ideaId: ideaId,
                    rating: rating
                },
                success: function(res) {
                    if (res) {
                        openModalBtn.innerHTML =
                            `${rating} <span class="ml-2 badge badge-warning" style="margin:5px !important;background-color: #bff03a;color: black;">&#9733</span>`;
                        modal.style.display = 'none';

                    }
                },
                error: function(error) {
                    console.error('Error submitting rating:', error);
                }
            });
        }


        modal.querySelector('.close').addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\ideaportal\resources\views/frontend/ideas/show_all_ideas.blade.php ENDPATH**/ ?>