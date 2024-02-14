<?php
use App\Models\backend\Category;
use App\Models\frontend\IdeaImages;
$ALL_VIDEO_EXTENSIONS = ['flv','webm','avchd','mkv','3gpp','mpeg','mpeg-4','mts','hevc','ogg','proress','mp4'];
?>

<?php $__env->startSection('title', 'User Dashboard | Edit Idea'); ?>

<?php $__env->startSection('content'); ?>


<div class="container-fluid">

    <div class="row breadcrumbs-top mt-3">
        <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('user.dashboard')); ?>">Dashboard</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('ideas.index')); ?>">My Ideas</a>
                </li>

                <li class="breadcrumb-item active">Edit</li>

            </ol>
        </div>
    </div>
</div>


<div class="container-fluid">

    <div class="content-header row  pt-3 pb-3">
        <div class="content-header-left col-md-6 col-6">
            <h3 class="content-header-title">Edit Idea</h3>

        </div>
        <div class="content-header-left col-md-6 col-6">
            <div class="btn-group float-md-right  ms-2" style="float: right" role="group" aria-label="Button group with nested dropdown" margin-top:-10px;>
                <div class="btn-group" role="group">
                    <a class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Back" href="<?php echo e(route('ideas.index')); ?>">
                        <i style="margin-right:6px;font-size:1.1em;" class="fa fa-angle-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>


    <section id="basic-datatable">
        <div class="row">
            <?php echo $__env->make('frontend.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
             <div id="error_message" class="form-group">
                <div class="alert alert-danger">
                    <ul>
                        <li></li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <?php echo e(Form::model($idea,[
                            'method' => 'POST',
                            'url' => ['ideas/update'],
                            'files'=> true
                            ])); ?>

                            <?php echo csrf_field(); ?>
                            

                            <div class="form-body">
                                <input type="hidden" name="user_id" value="<?php echo Auth::user()->user_id ?>">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-6 col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('title', 'Title *')); ?>

                                            <?php echo e(Form::text('title', null, ['class' => 'form-control',
                                            'placeholder' => 'Enter Title here', 'required' => true,'id'=>'title'])); ?>

                                            <?php echo e(Form::hidden('idea', $idea->idea_id, ['class' =>
                                                'form-control'])); ?>

                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-6 col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('category_id', 'Select Category *')); ?>

                                            <?php echo Form::select('category_id',
                                            Category::whereIN('category_id', explode(',',Auth::user()->category_id))->pluck('category_name','category_id'), null,
                                            ['class' => 'form-select', 'placeholder' => 'Select Category',
                                            'required' => true,'id'=>'category_id']); ?>

                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-6 col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('description', 'Describe the  Idea   clearly & completely *')); ?>

                                            <?php echo e(Form::textarea('description', null, ['class' =>
                                            'form-control',
                                            'placeholder' => 'Describe your Idea here', 'rows'=>'4',
                                            'required'
                                            => true,'id'=>'description'])); ?>

                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-6 col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('idea_outcome', 'Describe the outcome of the idea clearly *')); ?>

                                            <?php echo e(Form::textarea('idea_outcome', null, ['class' =>
                                            'form-control',
                                            'placeholder' => 'Describe the Outcome of the idea', 'rows'=>'4',
                                            'required'
                                            => true,'id'=>'outcame'])); ?>

                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-6 col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('why_implemented', 'Describe why the idea should to be implemented/What makes your idea unique *')); ?>

                                            <?php echo e(Form::textarea('why_implemented', null, ['class' =>
                                            'form-control',
                                            'placeholder' => 'Describe  why the idea should be implemented', 'rows'=>'4',
                                            'required'
                                            => true,'id'=>'why_implemented'])); ?>

                                        </div>
                                    </div>

                                    
                                    <div class="col-12 col-sm-6 col-md-6 col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('challeges', 'The idea presented has no risks or challenges to the Business *')); ?>

                                            <?php echo e(Form::textarea('challeges', null, ['class' =>
                                            'form-control',
                                            'placeholder' => 'Describe The idea presented has no risks or challenges to the Business ', 'rows'=>'4',
                                            'required'
                                            => true,'id'=>'challeges'])); ?>

                                        </div>
                                    </div>

                                    
                                    <div class="col-12 col-sm-6 col-md-6 col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('already_implemented_or_no', 'This idea is new and  and not  implemented anywhere in JMB Group *')); ?>

                                            <?php echo e(Form::textarea('already_implemented_or_no', null, ['class' =>
                                            'form-control',
                                            'placeholder' => 'This idea is new and  and not  implemented anywhere in JMB Group ', 'rows'=>'4',
                                            'required'
                                            => true,'id'=>'already_implemented_or_no'])); ?>

                                        </div>
                                    </div>


                                    
                                    <div class="col-12 col-sm-6 col-md-6 col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('alternatives', 'This idea has no other  alternative *')); ?>

                                            <?php echo e(Form::textarea('alternatives', null, ['class' =>
                                            'form-control',
                                            'placeholder' => 'This idea has no other  alternative', 'rows'=>'4',
                                            'required'
                                            => true,'id'=>'alternatives'])); ?>

                                        </div>
                                    </div>

                                    
                                    <div class="col-12 col-sm-6 col-md-6 col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('cost_and_benifits', 'Describe Is the cost of implementing the idea is less than the benefit *')); ?>

                                            <?php echo e(Form::textarea('cost_and_benifits', null, ['class' =>
                                            'form-control',
                                            'placeholder' => 'Is the cost of implementing the idea is less than the benefit', 'rows'=>'4',
                                            'required'
                                            => true,'id'=>'cost_and_benifits'])); ?>

                                        </div>
                                    </div>

                                    
                                    <div class="col-12 col-sm-6 col-md-6 col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('benifits', 'Describe Benefits of Implementing the Idea *')); ?>

                                            <?php echo e(Form::select('benifits[]',$benifits ,(isset($idea->benifits)?explode(',',$idea->benifits):null), ['class' =>
                                            'form-control',
                                            'rows'=>'4',
                                            'required'
                                            => true,'id'=>'benifits','multiple'=>'multple'])); ?>  
                                        </div>
                                    </div>





                                    <div class="col-12 col-sm-6 col-md-6 col-6">
                                        <div class="dropzone-container">
                                            <label for="files">Upload your file here <span style="color:#777" >(only <?php echo e($all_extensions); ?> files are
                                                allowed)</span>
                                                <?php
                                                    $title_files = '';
                                                    if(isset($all_extensions_and_limit) && count($all_extensions_and_limit)>0){
                                                        foreach($all_extensions_and_limit as $ext_limit){
                                                            $title_files .= "".(isset($ext_limit['name'])?'.'.$ext_limit['name']:'--').(($ext_limit['limit'])?' ('.$ext_limit['limit'].'MB) ':'0')."|";
                                                        }

                                                    }
                                                ?>
                                            <span id="help" title="<?php echo e(strtoupper($title_files)); ?>" ><i class="fas fa-info-circle"></i></span>
                                            </label>
                                            <div class="drop-zone">
                                                
                                                <input type="file" class="form-control image-file" multiple="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col md-12">
                                        <input type="hidden" name="email" value="<?php echo e(Auth::user()->email); ?>">
                                        <?php echo e(Form::submit('Update', array('class' => 'btn btn-primary mr-1
                                        mb-1','id'=>'submit'))); ?>

                                        <button type="reset" class="btn btn-dark mr-1 mb-1" id="reset_file">Reset</button>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                                <div id="selected-images" class="mt-4 row g-2 idea_imgaes_container">
                                </div>

                                <fieldset style="border-color: #12c712;display:none;padding:2.3em;margin:1em 0px;">
                                    <legend style="font-size:1.3em">Preview</legend>
                                    <div id="selected-images" class="row g-2">
                                    </div>
                                </fieldset>
                                <?php
                                $images = IdeaImages::where('idea_uni_id',$idea->idea_uni_id)->get();
                                // dd($images);
                                ?>
                                <?php if(count($images) > 0): ?>
                                <fieldset style="border-color: #206bc4;padding:2.3em;margin:1em 0px;">
                                    <legend style="font-size:1.3em">Uploaded Files</legend>
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
                                        if($ext == 'doc' || $ext == 'docx') {
                                        $img_path = asset('storage/app/public/uploads/asset/doc.png');
                                        } elseif ($ext == 'pdf'){
                                        $img_path = asset('storage/app/public/uploads/asset/pdf.png');
                                        } else {
                                        $img_path = asset('storage/app/public/' . $image->image_path);
                                        }
                                        ?>
                                        <div class="col-lg-2 col-md-4 col-sm-6">
                                            <div class="card border-0 shadow">
                                                <div style="width:100%;height:150px;overflow:hidden;padding:15px 0px;">
                                                    <?php if(in_array(strtolower($ext),$ALL_VIDEO_EXTENSIONS )): ?>
                                                    <video style="width:100%;height:100px; object-fit:contain" controls>
                                                        <source src="<?php echo e($img_path); ?>" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>

                                                    <a style="margin-top:10px;"
                                                    class="card card-body shadow"
                                                    href="<?php echo e($file_path); ?>" target="_blank">Download</a>
                                                    <?php else: ?>
                                                    <img class="card-img-top" src="<?php echo e($img_path); ?>" alt="Card image cap" style="width:100%;height:100%;object-position:center;object-fit:contain">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="card-body">
                                                    <p style="text-overflow: ellipsis;overflow: hidden;width: 100%;white-space: nowrap;" class="card-text"><?php echo e($image->file_name); ?></p>
                                                    <a href="<?php echo e(route('ideas.delete_image',['id'=>$image->image_id])); ?>" class="btn btn-sm btn-danger cross-image
                                                        remove" style="margin:5px 8px 5px 0px;" onclick="return confirm('Are you sure you want to delete this File')">Remove</a>
                                                    <?php if($ext == 'doc' || $ext == 'pdf' || $ext == 'docx'): ?>
                                                    <a style="margin:5px 5px 5px 0px;" href="<?php echo e($file_path); ?>" class="btn btn-sm btn-primary <?php echo e($ext == 'pdf' || $ext == 'doc' || $ext == 'docx'?'':'test-popup-link'); ?>" target="_blank">View</a>
                                                    <?php else: ?>
                                                    <?php if(in_array(strtolower($ext),$ALL_VIDEO_EXTENSIONS )): ?>
                                                    <a style="margin:5px 5px 5px 0px;" href="<?php echo e($img_path); ?>" class="btn btn-sm btn-primary" target="_new">Download</a>
                                                    <?php else: ?>
                                                    <a style="margin:5px 5px 5px 0px;" href="<?php echo e($img_path); ?>" class="btn btn-sm btn-primary test-popup-link">View</a>
                                                    <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </fieldset>
                                <?php else: ?>
                                <div>
                                    <h2 class=" mt-4">Images not uploaded yet</h2>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
    </section>

</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
    var all_extensions_array = [];
    var extensions_size_array = [];
    <?php
            $title_files = '';
                if(isset($all_extensions_and_limit) && count($all_extensions_and_limit)>0){
                    foreach($all_extensions_and_limit as $ext_limit){
                    ?>
                    all_extensions_array.push("<?php echo e($ext_limit['name']); ?>");
                    extensions_size_array["<?php echo e($ext_limit['name']); ?>"]= "<?php echo e(((int)$ext_limit['limit'])); ?>";
                    <?php
                    }
                }
        ?>
    $(document).ready(function() {

         //seelect 2
         $('#benifits').select2();
         $('#help').tooltip();


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
                        if(all_extensions_array.includes(fn_ext[1])){
                            let current_size = (f.size/1024).toFixed(2);

                           // console.log(current_size+'Current');
                           // console.log((parseInt(extensions_size_array[fn_ext[1]])*1024)+'Set Sizw');
                            if((parseInt(extensions_size_array[fn_ext[1]])*1024) >= current_size){
                                if (fn_ext[1] == 'doc' || fn_ext[1] == 'docx') {
                                    img_src = '<?php echo e(asset("storage/app/public/uploads/asset/doc.png")); ?>';
                                } else if (fn_ext[1] == 'pdf') {
                                    img_src = '<?php echo e(asset("storage/app/public/uploads/asset/pdf.png")); ?>';
                                } else {
                                    img_src = e.target.result
                                }
                            }else{
                                $('#error_message li').empty();
                                $('.image-file').val('');
                                $("#error_message li").append(`File size is more that required size`);
                                $("#error_message").show();
                                return;
                            }

                        }else{
                            $('#error_message li').empty();
                            $('.image-file').val('');
                            $("#error_message li").append(`Select the specified type of files`);
                            $("#error_message").show();
                            return;
                        }

                        //$src_value =
                        $("#selected-images").append(`
                        <div class="pip boxDiv col-lg-2 col-md-4 col-sm-6">
                            <div class="card border-0 shadow">
                                <div style="width:100%;height:150px;overflow:hidden;padding:15px 0px;">
                                    <img class="card-img-top prescriptions" src="${img_src}" alt="Image to upload" style="width:100%;height:100%;object-position:center;object-fit:contain">
                                </div>
                                <div class="card-body">
                                    <p style="text-overflow: ellipsis;overflow: hidden;width: 100%;white-space: nowrap;" class="card-text">${value.name}</p>
                                    <p class="btn btn-sm btn-danger cross-image remove">Remove</p>
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
    $('document').ready(function(e) {
        $('.upload-image').click(function(e) {
            var imageDiv = $(".boxDiv").length;
            if (imageDiv == '') {
                alert('Please upload image'); // Check here image selected or not
                return false;
            } else if (imageDiv > 5) {
                alert('You can upload only 5 images'); //You can select only 5 images at a time to upload
                return false;
            } else if (imageDiv != '' && imageDiv < 6) { // image should not be blank or not greater than 5
                $("#upload_image").submit();
            }
        });
    });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ideaportal/resources/views/frontend/ideas/updateIdea.blade.php ENDPATH**/ ?>