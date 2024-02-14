@php
use App\Models\backend\Category;
@endphp
@extends('frontend.layouts.app')
@section('title', 'User Dashboard | Add Idea')

@section('content')

{{-- Breadcrumb --}}
<section class="cs-breadcrumb">
    <div class="container-fluid">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <h1>Add Idea</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('ideas.index') }}">My Ideas</a>
                    </li>
                    <li class="breadcrumb-item active">Add</li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Back" href="{{ route('ideas.index') }}">
                        <i style="margin-right:6px;font-size:1.1em;" class="fa fa-angle-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Content --}}
<section class="cs-content">
    <div class="container-fluid">
        <div id="basic-datatable">
            <div class="card">
                <div class="card-body">
                    <!-- Errors -->
                    @include('frontend.includes.errors')
                    <div id="error_message" class="form-group">
                        <div class="alert alert-danger">
                            <ul>
                                <li></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Form -->
                    {{ Form::open(['url' => url('/ideas/storeIdea'),'method'=>'POST','files' => true]) }}
                    @csrf
                    <input type="hidden" name="user_id" value="<?php echo Auth::user()->user_id ?>">

                    <div class="row g-4">
                        <div class="col-12 col-sm-6 col-md-6 col-6">
                            <div class="form-group mb-0">
                                {{ Form::label('title', 'Title *') }}
                                {{ Form::text('title', null, ['class' => 'form-control',
                                'placeholder' => 'Enter Title here', 'required' => true,'id'=>'title']) }}
                                {{ Form::hidden('idea', (isset($idea->idea_id)? $idea->idea_id:null), ['class' =>
                                    'form-control']) }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- {{dd(Auth::user())}} --}}
                            <div class="form-group mb-0">
                                {{ Form::label('category_id', 'Select Category *') }}
                                {!! Form::select('category_id',
                                Category::whereIN('category_id', explode(',',Auth::user()->category_id))->pluck('category_name','category_id'), null,
                                ['class' => 'form-select', 'placeholder' => 'Select Category',
                                'required' => true,'id'=>'category_id']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                {{ Form::label('description', 'Describe the  Idea   clearly & completely *') }}
                                {{ Form::textarea('description', null, ['class' =>
                                'form-control',
                                'placeholder' => 'Describe your Idea here', 'rows'=>'4',
                                'required'
                                => true,'id'=>'description']) }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                {{ Form::label('idea_outcome', 'Describe the outcome of the idea clearly *') }}
                                {{ Form::textarea('idea_outcome', null, ['class' =>
                                'form-control',
                                'placeholder' => 'Describe the Outcome of the idea', 'rows'=>'4',
                                'required'
                                => true,'id'=>'outcame']) }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                {{ Form::label('why_implemented', 'Describe why the idea should to be implemented/What makes your idea unique *') }}
                                {{ Form::textarea('why_implemented', null, ['class' =>
                                'form-control',
                                'placeholder' => 'Describe  why the idea should be implemented', 'rows'=>'4',
                                'required'
                                => true,'id'=>'why_implemented']) }}
                            </div>
                        </div>

                        {{--  The idea presented has no risks or challenges to the Business  --}}
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                {{ Form::label('challeges', 'The idea presented has no risks or challenges to the Business *') }}
                                {{ Form::textarea('challeges', null, ['class' =>
                                'form-control',
                                'placeholder' => 'Describe The idea presented has no risks or challenges to the Business ', 'rows'=>'4',
                                'required'
                                => true,'id'=>'challeges']) }}
                            </div>
                        </div>

                        {{--  This idea is new and  and not  implemented anywhere in JMB Group  --}}
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                {{ Form::label('already_implemented_or_no', 'This idea is new and  and not  implemented anywhere in JMB Group *') }}
                                {{ Form::textarea('already_implemented_or_no', null, ['class' =>
                                'form-control',
                                'placeholder' => 'This idea is new and  and not  implemented anywhere in JMB Group ', 'rows'=>'4',
                                'required'
                                => true,'id'=>'already_implemented_or_no']) }}
                            </div>
                        </div>


                        {{--  This idea has no other  alternative   --}}
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                {{ Form::label('alternatives', 'This idea has no other  alternative *') }}
                                {{ Form::textarea('alternatives', null, ['class' =>
                                'form-control',
                                'placeholder' => 'This idea has no other  alternative', 'rows'=>'4',
                                'required'
                                => true,'id'=>'alternatives']) }}
                            </div>
                        </div>

                        {{--  Is the cost of implementing the idea is less than the benefit  --}}
                        <div class="col-md-12">
                            <div class="form-group mb-0">
                                {{ Form::label('cost_and_benifits', 'Describe Is the cost of implementing the idea is less than the benefit *') }}
                                {{ Form::textarea('cost_and_benifits', null, ['class' =>
                                'form-control',
                                'placeholder' => 'Is the cost of implementing the idea is less than the benefit', 'rows'=>'4',
                                'required'
                                => true,'id'=>'cost_and_benifits']) }}
                            </div>
                        </div>

                        {{--  Benefits of Implementing the Idea  --}}
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                {{ Form::label('benifits', 'Describe Benefits of Implementing the Idea *') }}
                                {{ Form::select('benifits[]',$benifits ,(isset($idea->benifits)?explode(',',$idea->benifits):null), ['class' =>
                                'form-control',
                                'rows'=>'4',
                                'required'
                                => true,'id'=>'benifits','multiple'=>'multple']) }}  {{--  'placeholder' => ' Benefits of Implementing the Idea ', --}}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="dropzone-container">
                                <label for="files">Upload your file here <span style="color:#777" >(only {{ $all_extensions }} files are
                                        allowed)</span>
                                        @php
                                            $title_files = '';
                                            if(isset($all_extensions_and_limit) && count($all_extensions_and_limit)>0){
                                                foreach($all_extensions_and_limit as $ext_limit){
                                                    $title_files .= "".(isset($ext_limit['name'])?'.'.$ext_limit['name']:'--').(($ext_limit['limit'])?' ('.$ext_limit['limit'].'MB) ':'0')."|";
                                                }

                                            }
                                        @endphp
                                    <span id="help" title="{{ strtoupper($title_files) }}" ><i class="fas fa-info-circle"></i></span>
                                    </label>
                                <div class="drop-zone">
                                    {{-- <span class="drop-zone__prompt d-inline-block my-1">Drop file here
                                        or click to upload</span>
                                    <input type="file" class="form-control" name="images[]" multiple
                                        id="upload-img" /> --}}
                                    <input type="file" class="form-control image-file" multiple="">
                                </div>
                            </div>
                        </div>
                        <div id='hidden_files'></div>

                        <div class="col-12">
                            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                            {{ Form::submit('Create', array('class' => 'btn btn-primary mr-1 mb-1','id'=>'submit')) }}
                            <button type="reset" class="btn btn-dark mr-1 mb-1" id="reset_file">Reset</button>
                        </div>
                    </div>

                    {{ Form::close() }}
                    <div id="selected-images" class="mt-4 row g-2 idea_imgaes_container"></div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('scripts')

<script type="text/javascript">
    var all_extensions_array = [];
    var extensions_size_array = [];
    @php
            $title_files = '';
                if(isset($all_extensions_and_limit) && count($all_extensions_and_limit)>0){
                    foreach($all_extensions_and_limit as $ext_limit){
                    @endphp
                    all_extensions_array.push("{{ $ext_limit['name'] }}");
                    extensions_size_array["{{ $ext_limit['name'] }}"]= "{{ ((int)$ext_limit['limit'])}}";
                    @php
                    }
                }
        @endphp
//console.log(all_extensions_array);
    $(document).ready(function() {
        $('#error_message').hide();
        if (window.File && window.FileList && window.FileReader) {
            $(".image-file").on("change", function(e) {
                $("#error_message").hide();
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
                                    img_src = '{{asset("storage/app/public/uploads/asset/doc.png")}}';
                                } else if (fn_ext[1] == 'pdf') {
                                    img_src = '{{asset("storage/app/public/uploads/asset/pdf.png")}}';
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
                                    <p class="btn btn-sm btn-danger cross-image remove" data-name="${value.name.replace(/ /g, "_")}" >Remove</p>
                                </div>
                            </div>
                                <input type="hidden" name="file[]" value="${e.target.result}">
                                <input type="hidden" name="fileName[]" value="${value.name}">
                        </div>`);

                        $('#hidden_files').append(`<input type="hidden" name="file[]" value="${e.target.result}" class="${value.name.replace(/ /g, "_")}">
                        <input type="hidden" name="fileName[]" value="${value.name}" class="${value.name.replace(/ /g, "_")}">`);
                        $(".remove").click(function() {

                            $(this).parent().parent().parent(".pip").remove();
                            cls_name = $(this).attr('data-name');
                            var elementsByClass = document.getElementsByClassName(cls_name);

                            for (var i = 0; i < elementsByClass.length; i++) {
                                // Do something with each element (elementsByClass[i])
                                $(document).find(elementsByClass[i]).remove();

                            }

                        });
                    });
                    fileReader.readAsDataURL(f);
                    i++;
                });
            });
        } else {
            alert("Your browser doesn't support to File API")
        }


        $('#help').tooltip();
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


        //seelect 2
        $('#benifits').select2();
    });






</script>


{{-- <script>
    var imgUpload = document.getElementById('upload-img')
        , imgPreview = document.getElementById('img-preview')
        , imgUploadForm = document.getElementById('form-upload')
        , totalFiles
        , previewTitle
        , previewTitleText
        , img;

    imgUpload.addEventListener('change', previewImgs, true);

    function previewImgs(event) {

        totalFiles = imgUpload.files.length;

        if (totalFiles) {
            imgPreview.classList.remove('img-thumbs-hidden');
        }

        for (var i = 0; i < totalFiles; i++) {
            var fileName = imgUpload.files[i].name
            var patternFileExtension = /\.([0-9a-z]+)(?:[\?#]|$)/i;
            var fileExtension = (fileName).match(patternFileExtension);

            wrapper = document.createElement('div');
            wrapper.classList.add('wrapper-thumb');
            removeBtn = document.createElement("span");
            nodeRemove = document.createTextNode('x');
            removeBtn.classList.add('remove-btn');
            removeBtn.appendChild(nodeRemove);
            fileNameLabel = document.createElement("span");
            nodeFileNameLabel = document.createTextNode(fileName);
            fileNameLabel.classList.add('file_name_label');
            fileNameLabel.appendChild(nodeFileNameLabel);
            img = document.createElement('img');
            if (fileExtension[1] == 'doc') {
                img.src = '{{asset("/storage/app/public/uploads/asset/doc_old.png")}}';
} else if (fileExtension[1] == 'pdf') {
img.src = '{{asset("/storage/app/public/uploads/asset/pdf_old.png")}}';
} else {
img.src = URL.createObjectURL(event.target.files[i]);
}
img.classList.add('img-preview-thumb');
wrapper.appendChild(img);
wrapper.appendChild(removeBtn);
imgPreview.appendChild(wrapper);
wrapper.appendChild(fileNameLabel);

$('.remove-btn').click(function() {
$(this).parent('.wrapper-thumb').remove();
imgPreview.contains('.wrapper-thumb');
});

}


}

</script> --}}

@endsection
