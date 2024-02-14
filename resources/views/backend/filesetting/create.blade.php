@extends('backend.layouts.app')
@section('title', 'Add File Setting')
@php
    use Spatie\Permission\Models\Role;
@endphp
@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">Add File Setting</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.filesetting') }}">File Setting</a>
                        </li>

                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <a class="btn btn-outline-primary" href="{{ route('admin.filesetting') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>


    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            {{-- @php
                        $role = Role::get(['id','name'])->toArray();
                        @endphp --}}
                            @include('backend.includes.errors')
                            {{ Form::open([
                                'url' => 'admin/filesetting/store',
                                'method' => 'post',
                            ]) }}
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    @php
                                     $allowedExtensionsString = "jpg,jpeg,png,gif,bmp,tiff,webp,mp3,wav,ogg,flac,aac,mp4,avi,mkv,mov,flv,wmv,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar";
                                     $extensions = explode(',', $allowedExtensionsString);
                                    @endphp
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            {{ Form::label('allowed_extetnsion', 'Extension *') }}
                                            {!! Form::select('allowed_extetnsion',$extensions ,
                                            null, ['class' => 'form-control ','id'=>'tags']) !!}
                                            
                                            {{-- {{ Form::select('allowed_extetnsion[]', $extensions, null, ['class' => 'select2 form-control','multiple'=>true, 'placeholder' => 'Select Extension', 'required' => true]) }} --}}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            {{ Form::label('file_size', 'File Size (In mb) *') }}
                                            {{ Form::number('file_size', null, ['class' => 'form-control', 'placeholder' => 'Enter File Size', 'required' => true]) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col md-12">
                                    {{ Form::submit('Add', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                                    <button type="reset" class="btn btn-dark mr-1 mb-1">Reset</button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>

    </section>



@endsection
