@extends('frontend.layouts.app')
@section('title', 'User Dashboard')

@section('content')
@php
use App\Models\Rolesexternal;
use App\Models\frontend\Ideas;
$role = Auth::user()->role;


$roles_external = Rolesexternal::where(['id'=>Auth::user()->sub_role_final])->first();
$user_role = $roles_external->role_type;
// dd(Auth::user()->sub_role);

$roles_external1 = Rolesexternal::where(['role_type' => 'User'])->pluck('id')->toArray();
//dd($roles_external1);
//{{--  $curr_user_data = DB::table('users')->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external1])->where('user_id',Auth::user()->user_id)->get();  --}}
$curr_user_data = DB::table('users')->whereRaw('FIND_IN_SET(?, sub_role)', [3])->where('user_id',Auth::user()->user_id)->get();

 //dd($curr_user_data->toArray());



$buttons = [];
$menus = [];

if(!empty($roles_external)){
    $buttons = explode(',',$roles_external->button_values);
}
if (!empty($roles_external)) {
    $menus = explode(',', $roles_external->menu_values);
}
// dd($menus);
@endphp
{{-- <div class="card">
    <div class="card-body">
        <h3 class="mb-2">Welcome to Dashboard</h3>
        <a href="{{ route('user.logout') }}" class="btn btn-secondary">Logout</a>
    </div>
</div> --}}
@if(in_array('menu_values',$menus) && in_array('dashboard',$menus))
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-end">
                <div class="col-6 col-sm-6 col-md-6">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">Overview</div>
                    <h2 class="page-title">Welcome to Dashboard</h2>
                </div>


                @if((!$curr_user_data->isEmpty()) && $roles_external->role_type != 'User' && in_array('ideas_for_approval',$menus))
                <div class="col-6 col-sm-6 col-md-6" id="option_select_ideas">
                    <label for="idea_type">Select Idea Type</label>
                    <select class="form-control" id="idea_type" name="idea_type">
                        <option value="ideas">Ideas for Approval</option>
                        <option value="my ideas">My Ideas</option>
                    </select>
                </div>
                @endif
{{--  {{ dd($roles_external->role_type,$buttons,$menus) }}  --}}
                @if($roles_external->role_type== 'User')
                <div class="content-header-right col-6 col-sm-6 col-md-6">
                    <div class="btn-group float-md-right ms-2 " role="group"
                        aria-label="Button group with nested dropdown" style="float: right;">
                        <div class="btn-group " role="group">

                            @if(in_array('ideas_for_approval',$menus) && in_array('Add',$buttons))
                            <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Add New Idea"
                                href="{{ route('ideas.addIdea') }}">
                                <i class="feather icon-plus"></i> &nbsp;Add New Idea
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-fluid">
            <h2 id="head_ideas"></h2>

            {{-- for ideas --}}
            <div class="row row-deck row-cards" id="ideas_block">
                {{-- Total Ideas --}}
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="card">
                        {{--  <a href="<?php echo (in_array('my_ideas',$menus))? route('ideas.index'):'#';?>" style="text-decoration:none;color:black;">  --}}
                            <a href="<?php echo (in_array('ideas_for_approval',$menus))? route('ideas.index'):'#';?>" style="text-decoration:none;color:black;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Total Ideas</div>
                            </div>
                            <div class="h1">{{$total_ideas}}<span class="ideas-icon"><img
                                        src="{{asset('public/frontend-assets/images/icon1.png')}}"></span></div>
                        </div>
                    </a>
                    </div>

                </div>
                {{-- Pending Ideas --}}
                {{-- <div class="col-sm-3 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Pending Ideas</div>
                            </div>
                            <div class="h1">{{$pending}}<span class="ideas-icon"><img
                                        src="{{asset('public/frontend-assets/images/icon1.png')}}"></span>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="col-sm-3 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">On-hold</div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{$on_hold}}<span class="ideas-icon"><img
                                            src="{{asset('public/frontend-assets/images/icon10.png')}}"></span></div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}




                @if($roles_external->role_type == 'Assessment Team' || $roles_external->role_type == 'Approving Authority' ||
                $roles_external->role_type != 'Implementation')
                <div class="col-sm-3 col-lg-3">
                    <div class="card">
                        <a href="<?php echo (in_array('ideas_for_approval',$menus))? route('ideas.index'):'#';?>?st=revise_req" style="text-decoration:none;color:black;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Revise Request</div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{$revise_request}}<span class="ideas-icon"><img
                                            src="{{asset('public/frontend-assets/images/icon9.png')}}"></span></div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                @endif

                @if ($roles_external->role_type != 'Implementation')
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="card">
                        <a href="<?php echo (in_array('ideas_for_approval',$menus))? route('ideas.index'):'#';?>?st=under_asset" style="text-decoration:none;color:black;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                @if ($roles_external->role_type == 'Approving Authority')
                                        <div class="subheader">Approved Ideas</div>
                                    @else
                                        <div class="subheader">Under Assessment</div>
                                @endif

                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{$under_assessment}}<span class="ideas-icon"><img
                                            src="{{asset('public/frontend-assets/images/icon5.png')}}"></span></div>
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
                        <a href="<?php echo (in_array('ideas_for_approval',$menus))? route('ideas.index'):'#';?>?st=under_approv" style="text-decoration:none;color:black;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Under Approval</div>

                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{$under_approving}}<span class="ideas-icon"><img
                                            src="{{asset('public/frontend-assets/images/icon8.png')}}"></span></div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                @endif


                @if($roles_external->role_type != 'Assessment Team' || $roles_external->role_type != 'Approving Authority')
                @if ($roles_external->role_type != 'Implementation')
                @if ($roles_external->role_type != 'Assessment Team')
                @if ($roles_external->role_type != 'Approving Authority')

                <div class="col-sm-3 col-lg-3">
                    <div class="card">
                        <a href="<?php echo (in_array('ideas_for_approval',$menus))? route('ideas.index'):'#';?>?st=approved_ideas" style="text-decoration:none;color:black;">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Approved Ideas</div>
                                </div>
                                <div class="d-flex align-items-baseline">
                                    <div class="h1 mb-0 me-2">{{$approved_ideas}}<span class="ideas-icon"><img
                                        src="{{asset('public/frontend-assets/images/icon2.png')}}"></span></div>
                                        <div class="me-auto">
                                            <span class="text-green d-inline-flex align-items-center lh-1">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endif
                    @endif
                    @endif

                @endif

                @if($roles_external->role_type == 'Assessment Team' || $roles_external->role_type == 'Approving Authority' ||
                $roles_external->role_type == 'Implementation')
                <div class="col-sm-3 col-lg-3">
                    <div class="card">
                        <a href="<?php echo (in_array('my_ideas',$menus))? route('ideas.index'):'#';?>?st=implementation" style="text-decoration:none;color:black;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Implementation</div>

                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{$implementation}}<span class="ideas-icon"><img
                                            src="{{asset('public/frontend-assets/images/icon9.png')}}"></span></div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                @endif

                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="card">
                        <a href="<?php echo (in_array('ideas_for_approval',$menus))? route('ideas.index'):'#';?>?st=implemented" style="text-decoration:none;color:black;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Implemented Ideas</div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{$implemented}}<span class="ideas-icon"><img
                                            src="{{asset('public/frontend-assets/images/icon8.png')}}"></span></div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                @if($roles_external->role_type == 'Assessment Team' || $roles_external->role_type == 'Approving Authority' ||
                $roles_external->role_type != 'Implementation')
                <div class="col-sm-3 col-lg-3">
                    <div class="card">
                        <a href="<?php echo (in_array('ideas_for_approval',$menus))? route('ideas.index'):'#';?>?st=rejected" style="text-decoration:none;color:black;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Rejected</div>

                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{$rejected}}<span class="ideas-icon"><img
                                            src="{{asset('public/frontend-assets/images/icon7.png')}}"></span></div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                @endif


            </div>
            <br>
            {{-- for my ideas --}}
            @if($roles_external->role_type != 'User')
            <div class="row row-deck row-cards" id="myideas_block">
                {{-- Total Ideas --}}
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="card">
                        <a href="<?php echo (in_array('my_ideas',$menus))? route('myideas.index'):'#';?>" style="text-decoration:none;color:black;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Total Ideas</div>
                            </div>
                            <div class="h1">{{$total_ideas1}}<span class="ideas-icon"><img
                                        src="{{asset('public/frontend-assets/images/icon1.png')}}"></span></div>
                        </div>
                    </a>
                    </div>

                </div>
                {{-- Pending Ideas --}}
                {{-- <div class="col-sm-3 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Pending Ideas</div>
                            </div>
                            <div class="h1">{{$pending}}<span class="ideas-icon"><img
                                        src="{{asset('public/frontend-assets/images/icon1.png')}}"></span>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="col-sm-3 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">On-hold</div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{$on_hold}}<span class="ideas-icon"><img
                                            src="{{asset('public/frontend-assets/images/icon10.png')}}"></span></div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}




                @if($roles_external->role_type == 'Assessment Team' || $roles_external->role_type == 'Approving Authority' ||
                $roles_external->role_type == 'Implementation')
                <div class="col-sm-3 col-lg-3">
                    <div class="card">
                        <a href="<?php echo (in_array('my_ideas',$menus))? route('myideas.index'):'#';?>?st=revise_req" style="text-decoration:none;color:black;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Revise Request</div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{$revise_request1}}<span class="ideas-icon"><img
                                            src="{{asset('public/frontend-assets/images/icon9.png')}}"></span></div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                @endif

                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">

                    <div class="card">
                        <a href="<?php echo (in_array('my_ideas',$menus))? route('myideas.index'):'#';?>?st=under_asset" style="text-decoration:none;color:black;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Under Assessment</div>

                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{$under_assessment1}}<span class="ideas-icon"><img
                                            src="{{asset('public/frontend-assets/images/icon5.png')}}"></span></div>
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
                        <a href="<?php echo (in_array('my_ideas',$menus))? route('myideas.index'):'#';?>?st=under_approv" style="text-decoration:none;color:black;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Under Approval</div>

                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{$under_approving1}}<span class="ideas-icon"><img
                                            src="{{asset('public/frontend-assets/images/icon8.png')}}"></span></div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                @if($roles_external->role_type == 'Assessment Team' || $roles_external->role_type == 'Approving Authority' ||
                $roles_external->role_type == 'Implementation')
                <div class="col-sm-3 col-lg-3">
                    <div class="card">
                        <a href="<?php echo (in_array('my_ideas',$menus))? route('myideas.index'):'#';?>?st=approved_ideas" style="text-decoration:none;color:black;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Approved Ideas</div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{$approved_ideas1}}<span class="ideas-icon"><img
                                            src="{{asset('public/frontend-assets/images/icon2.png')}}"></span></div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                @endif

                @if($roles_external->role_type == 'Assessment Team' || $roles_external->role_type == 'Approving Authority' ||
                $roles_external->role_type == 'Implementation')
                <div class="col-sm-3 col-lg-3">
                    <div class="card">
                        <a href="<?php echo (in_array('my_ideas',$menus))? route('myideas.index'):'#';?>?st=implementation" style="text-decoration:none;color:black;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Implementation</div>

                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{$implementation1}}<span class="ideas-icon"><img
                                            src="{{asset('public/frontend-assets/images/icon9.png')}}"></span></div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                @endif

                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="card">
                        <a href="<?php echo (in_array('my_ideas',$menus))? route('myideas.index'):'#';?>?st=implemented" style="text-decoration:none;color:black;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Implemented Ideas</div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{$implemented1}}<span class="ideas-icon"><img
                                            src="{{asset('public/frontend-assets/images/icon8.png')}}"></span></div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                @if($roles_external->role_type == 'Assessment Team' || $roles_external->role_type == 'Approving Authority' ||
                $roles_external->role_type == 'Implementation')
                <div class="col-sm-3 col-lg-3">
                    <div class="card">
                        <a href="<?php echo (in_array('my_ideas',$menus))? route('myideas.index'):'#';?>?st=rejected" style="text-decoration:none;color:black;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Rejected</div>

                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{$rejected1}}<span class="ideas-icon"><img
                                            src="{{asset('public/frontend-assets/images/icon7.png')}}"></span></div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                @endif


            </div>
            @endif


            <br>

            <div class="col-lg-12">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="subheader">Ideas submitted this year </h3>
                                <div id="chart-mentions" class="chart-lg"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- {{dd($response)}} --}}
        </div>

    </div>
</div>
@endif
@endsection
@section('scripts')
{{-- tabler theme --}}
<script>
    function getNumber() {
        const arr_res = [];
        const obj_res = {!!json_encode($response) !!}
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
        //console.log(({!! json_encode($response) !!}));
        var options = {
            chart: {
                height: 350
                , type: 'bar'
            , }
            , dataLabels: {
                enabled: false
            }
            , series: [{
                name: 'Ideas',
                // data: [],
                data: {!!json_encode($response) !!}
            , }]
            , yaxis: {
                max : getNumber
            }
            , title: {
                text: 'Ideas'
            , }
            , noData: {
                text: 'Loading...'
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart-mentions")
            , options
        );

        chart.render();


        // url = '{{ url('ideas/getChartValues') }}';
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


        var user_data_exists  =  {!!json_encode($curr_user_data) !!} ;
        var role = '<?php echo $user_role ?>';
        if(user_data_exists == ''){
            localStorage.setItem('ideas', 'ideas');
        }




    if(role != 'User'){

        if(localStorage.getItem('ideas')){
            $('#idea_type option[value="'+localStorage.getItem('ideas')+'"]').attr('selected','selected');
        }else{
        var default_selected = $('#idea_type').find(":selected").val();
        if(default_selected == 'ideas'){
            localStorage.setItem('ideas', 'ideas');
        }else{
            localStorage.setItem('ideas', 'my ideas');
        }
        }

    var idea_type = localStorage.getItem('ideas');
    $('#idea_type option[value="'+idea_type+'"]').attr('selected','selected');

        $('#head_ideas').html(idea_type.toUpperCase());
        if(idea_type == 'ideas'){
        $('#ideas_block').show();
            $('#myideas_block').hide();
        }else{
            $('#myideas_block').show();
            $('#ideas_block').hide();
        }
    }
// }
});

$('#idea_type').change(function() {




    var default_selected = $('#idea_type').find(":selected").val();

    if(default_selected == 'ideas'){
            localStorage.setItem('ideas', 'ideas');
        }else{
            localStorage.setItem('ideas', 'my ideas');
        }


    var idea_type = localStorage.getItem('ideas');
    $('#idea_type option').attr('selected',false);
    $('#idea_type option[value="'+idea_type+'"]').attr('selected','selected');

    $("#option_select_ideas select").val(idea_type);
    // var idea_type = $(this).val();
    $('#head_ideas').html(idea_type.toUpperCase());
    if(idea_type == 'ideas'){
        $('#ideas_block').show();
            $('#myideas_block').hide();
        }else{
            $('#myideas_block').show();
            $('#ideas_block').hide();
        }
});

</script>
@endsection
