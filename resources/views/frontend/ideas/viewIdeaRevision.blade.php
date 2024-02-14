<?php
use App\Models\frontend\Users;
use App\Models\frontend\Ideas;
use App\Models\frontend\IdeaRevisionImages;

?>
@extends('frontend.layouts.app')
@section('title', 'User Dashboard | View Idea')

@section('content')

{{-- Breadcrumb --}}
<section class="cs-breadcrumb">
    <div class="container-fluid">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <h1>View Idea</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Idea Revisions</li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Back" @if (session()->has('sub_page')) href="{{ session('sub_page') }} " @else href="{{ route('ideas.index') }}" @endif >
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
                @php
                $image_path = $ideaRevision['image_path'];
                $full_image_path = 'storage/app/public/'.$image_path;
                $extArr = explode('.',$image_path);
                $ext = end($extArr);
                @endphp
                <div class="card-body">
                    <div class="position-sticky top-0">
                        <div id="idea_title">
                            @php
                            $og_ideas = Ideas::where('idea_id',$ideaRevision->idea_id)->first();
                            if(isset($og_ideas)) {
                            $user_id = $og_ideas->user_id;
                            $user = Users::where('user_id',$user_id)->first();
                            }
                            if(isset($ideaRevision['created_at'])){
                            $created_at_arr = explode(' ',$ideaRevision['created_at']);
                            $created_at ='| Submitted on : '.$created_at_arr[0];
                            } else {
                            $created_at ='';
                            }
                            @endphp
                            <h2 class="mb-3 heading">
                                <strong>{{ $ideaRevision->title }} </strong>
                            </h2>
                            <h3 class="mb-2">Idea Number: {{$ideaRevision->idea_id}}</h3>
                            <h5>
                                <b>
                                    Author : <span class="text-primary text-capitalize">{{ $user['name'] }} {{ $user['last_name'] }}</span>
                                    <span>{{$created_at}}</span>
                                </b>
                            </h5>
                        </div>

                        <div class="list mb-4">
                            <div class="item">
                                <div class="heading">
                                    <h5>Idea Description</h5>
                                </div>
                                <div class="content">
                                    <p class="mb-3">{{ (isset($ideaRevision->description)?$ideaRevision->description:'') }}</p>
                                </div>
                            </div>

                            <div class="item">
                                <div class="heading">
                                    <h5>Outcome of Idea</h5>
                                </div>
                                <div class="content">
                                    <p class="mb-3">{{ (isset($ideaRevision->idea_outcome)?$ideaRevision->idea_outcome :'') }}</p>
                                </div>
                            </div>

                            <div class="item">
                                <div class="heading">
                                    <h5>Describe why the idea should to be implemented/What makes your idea unique?</h5>
                                </div>
                                <div class="content">
                                    <p class="mb-3">{{ (isset($ideaRevision->why_implemented)?$ideaRevision->why_implemented:'') }}</p>
                                </div>
                            </div>

                            <div class="item">
                                <div class="heading">
                                    <h5>The idea presented has no risks or challenges to the Business</h5>
                                </div>
                                <div class="content">
                                    <p class="mb-3">{{ (isset($ideaRevision->challeges)?$ideaRevision->challeges:'') }}</p>
                                </div>
                            </div>

                            <div class="item">
                                <div class="heading">
                                    <h5>This idea is new and not implemented anywhere in JMB Group</h5>
                                </div>
                                <div class="content">
                                    <p class="mb-3">{{ (isset($ideaRevision->already_implemented_or_no)?$ideaRevision->already_implemented_or_no:'') }}</p>
                                </div>
                            </div>

                            <div class="item">
                                <div class="heading">
                                    <h5>This idea has no other alternative</h5>
                                </div>
                                <div class="content">
                                    <p class="mb-3">{{ (isset($ideaRevision->alternatives )?$ideaRevision->alternatives :'')}}</p>
                                </div>
                            </div>

                            <div class="item">
                                <div class="heading">
                                    <h5>Is the cost of implementing the idea is less than the benefit</h5>
                                </div>
                                <div class="content">
                                    <p class="mb-3">{{ (isset($ideaRevision->cost_and_benifits )?$ideaRevision->cost_and_benifits :'')}}</p>
                                </div>
                            </div>

                            <div class="item">
                                <div class="heading">
                                    <h5>Benefits of Implementing the Idea1</h5>
                                </div>
                                <div class="content">
                                    <p class="mb-3">{{(isset( $ideaRevision->benifits )? $ideaRevision->benifits :'')}}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Files --}}
                        @php
                        $idea_uni_id = $ideaRevision->idea_uni_id;
                        $idea_images = IdeaRevisionImages::where('idea_uni_id',$idea_uni_id)->whereNotNull('idea_uni_id')->get();
                        @endphp
                        @if(count($idea_images) > 0)
                        <div class="full-img-boxin">
                            <h3 class="heading mb-3">Attachment</h3>
                            <div class="row">
                                @foreach ($idea_images as $idea_image)
                                @php
                                $fileNameParts = explode('.', $idea_image->file_name);
                                $ext = end($fileNameParts);
                                // dd($ext);
                                $img_path = '';
                                $label_text = '';
                                $file_path = asset('storage/app/public/' . $idea_image->image_path);
                                if ($ext == 'doc' || $ext == 'docx' || $ext == 'txt' || $ext == 'xlsx') {
                                $label_text = 'Download DOC';
                                $img_path = asset('storage/app/public/uploads/asset/doc.png');
                                } elseif ($ext == 'pdf') {
                                $label_text = 'View PDF';
                                $img_path = asset('storage/app/public/uploads/asset/pdf.png');
                                }elseif ($ext == 'mp4' || $ext == 'mov' || $ext == 'avi') {
                                $img_path = asset('storage/app/public/uploads/asset/vid.png');
                                }else {
                                $label_text = 'View Image';
                                $img_path = asset('storage/app/public/' . $idea_image->image_path);
                                }
                                @endphp
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <a style="margin-top:10px;" class="card card-body shadow {{$ext == 'mp4' || $ext == 'mov' || $ext == 'avi' || $ext == 'pdf' || $ext == 'doc' ||$ext == 'txt' || $ext == 'xlsx'|| $ext == 'docx'?'':'test-popup-link'}}" href="{{ $file_path  }}" target="_blank">
                                        <img style="width:100%;height:100px; object-fit:contain" src="{{ $img_path }}" alt="{{ $image_path == 'null' ? 'Image not available': 'Idea Image' }} ">
                                        <p class="h5 text-center mt-2">{{$label_text}}</p>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
