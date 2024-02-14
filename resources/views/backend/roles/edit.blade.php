@extends('backend.layouts.app')
@section('title', 'Update Roles')

@section('content')
@php

use App\Models\backend\BackendMenubar;
use App\Models\backend\BackendSubMenubar;
use Spatie\Permission\Models\Permission;


$user_id = Auth()->guard('admin')->user()->id;
//$user_master = UserMaster::where('user_id',$user_id)->first();

//$menu_ids=explode(",",$user_master->menu_master);
//$submenu_ids=explode(",",$user_master->submenu_master);
//$sub_submenu_ids=explode(",",$user_master->sub_sub_master);
//$child_sub_submenu_ids=explode(",",$user_master->child_sub_sub_master);
//$backend_menubar = DB::select("SELECT * FROM backend_menubar_sublink bms, backend_menubar bm where bms.menu_id=bm.menu_id and bm.visibility=1 group by bm.menu_id");
$backend_menubar = BackendMenubar::Where(['visibility'=>1])->orderBy('sort_order')->get();
@endphp
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-2">
        <h3 class="content-header-title">Internal User</h3>

        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Internal User</li>
                </ol>
            </div>
        </div>
    </div>

</div>
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        @include('backend.includes.errors')
                        {!! Form::model($role, [
                        'method' => 'POST',
                        'url' => ['admin/roles/update'],
                        'class' => 'form'
                        ]) !!}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12 col-12 col-1">
                                    <div class="form-label-group">
                                        {{ Form::label('name', 'Role Name *') }}
                                        {{ Form::hidden('id', $role->id) }}
                                        {{ Form::text('name', $role->name, ['class' => 'form-control', 'placeholder' => 'Enter Role Name', 'required' => true]) }}

                                    </div>
                                </div>
                                @php
                                //dd($has_permissions);
                                foreach($backend_menubar as $menu)
                                {
                                @endphp
                                <div class="col-md-12 col-12 internal-user">
                                    @php
                                    if($menu->has_submenu == 1)
                                    {
                                    $backend_menu_permission = explode(',',$role->menu_ids);
                                    $backend_submenu_permission = explode(',',$role->submenu_ids);
                                    $backend_submenubar = BackendSubMenubar::Where(['menu_id'=>$menu->menu_id])->get();
                                    if($backend_submenubar)
                                    {
                                    @endphp
                                    <!-- <h4 class="card-title">{{$menu->menu_name}}</h4> -->
                                    <h4 class="card-title">
                                        <div class="checkbox checkbox-primary">
                                            {{ Form::checkbox('menu_id[]', $menu->menu_id, in_array($menu->menu_id,$backend_menu_permission), ['id'=>'menu['.$menu->menu_id.']']) }}
                                            {{ Form::label('menu['.$menu->menu_id.']', $menu->menu_name) }}
                                        </div>
                                    </h4>

                                    @php
                                    foreach($backend_submenubar as $submenu)
                                    {
                                    @endphp
                                    <div class="col-md-12 col-12 ">
                                        <!-- <h5 class="">{{ $submenu->submenu_name }}</h5> -->
                                        <h3 class="card-title">
                                            <div class="checkbox checkbox-primary">
                                                {{ Form::checkbox('submenu_id[]', $submenu->submenu_id, in_array($submenu->submenu_id,$backend_submenu_permission), ['id'=>'submenu['.$menu->menu_id.']['.$submenu->submenu_id.']']) }}
                                                {{ Form::label('submenu['.$menu->menu_id.']['.$submenu->submenu_id.']', $submenu->submenu_name) }}
                                                <!-- </div> -->
                                        </h3>
                                        <div class="col-md-12 col-12 mt-2 menu_permissions">
                                            <ul class="list-unstyled mb-0">
                                                @php
                                                $backend_permission = explode(',',$submenu->submenu_permissions);
                                                $permissions = Permission::where('menu_id',$menu->menu_id)->where('submenu_id',$submenu->submenu_id)->get();
                                                $permissions = collect($permissions)->mapWithKeys(function ($item, $key) {
                                                return [$item['base_permission_id'] => ['id'=>$item['id'],'name'=>$item['name']]];
                                                });
                                                //dd($permissions);
                                                @endphp
                                                @foreach($backend_permission as $permission)
                                                @if(isset($permissions[$permission]))
                                                <li class="d-inline-block mr-2 mb-1">
                                                    <fieldset>
                                                        <div class="checkbox checkbox-primary">
                                                            {{ Form::checkbox('permissions['.$permissions[$permission]['id'].']', $permissions[$permission]['id'], in_array($permissions[$permission]['id'],$has_permissions), ['id'=>'permissions['.$permissions[$permission]['id'].']']) }}
                                                            {{ Form::label('permissions['.$permissions[$permission]['id'].']', $permissions[$permission]['name']) }}
                                                        </div>
                                                    </fieldset>
                                                </li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    @php

                                    }
                                    }
                                    }
                                    else
                                    {


                                    $backend_menu_permission = explode(',',$role->menu_ids);
                                    @endphp

                                    <h4 class="card-title">
                                        <div class="checkbox checkbox-primary">
                                            {{ Form::checkbox('menu_id[]', $menu->menu_id, in_array($menu->menu_id,$backend_menu_permission), ['id'=>'menu['.$menu->menu_id.']']) }}
                                            {{ Form::label('menu['.$menu->menu_id.']', $menu->menu_name) }}
                                        </div>
                                    </h4>
                                    <div class="col-md-12 col-12 mt-2 menu_permissions">
                                        <ul class="list-unstyled mb-0">
                                            @php
                                            $backend_permission = explode(',',$menu->permissions);
                                            $permissions = Permission::where('menu_id',$menu->menu_id)->get();
                                            $permissions = collect($permissions)->mapWithKeys(function ($item, $key) {
                                            return [$item['base_permission_id'] => ['id'=>$item['id'],'name'=>$item['name']]];
                                            });
                                            //dd($permissions);
                                            @endphp
                                            @foreach($backend_permission as $permission)

                                            @if(isset($permissions[$permission]))
                                            <li class="d-inline-block mr-2 mb-1">
                                                <fieldset>
                                                    <div class="checkbox checkbox-primary">
                                                        {{ Form::checkbox('permissions['.$permissions[$permission]['id'].']', $permissions[$permission]['id'], in_array($permissions[$permission]['id'],$has_permissions), ['id'=>'permissions['.$permissions[$permission]['id'].']']) }}
                                                        {{ Form::label('permissions['.$permissions[$permission]['id'].']', $permissions[$permission]['name']) }}
                                                    </div>
                                                </fieldset>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    @php
                                    }
                                    @endphp
                                </div>
                                @php
                                }
                                @endphp



                                <div class="col-12 d-flex justify-content-start">
                                    <!-- <button type="submit" class="btn btn-primary mr-1 mb-1">Update</button> -->
                                    {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1 mb-1')) }}
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</div>
@endsection
