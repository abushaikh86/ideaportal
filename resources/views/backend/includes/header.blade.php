@php

use App\Models\backend\BackendMenubar;
use App\Models\backend\BackendSubMenubar;
use App\Models\backend\AdminUsers;
use App\Models\backend\UserMaster;
use Spatie\Menu\Laravel\Menu;
use Spatie\Permission\Models\Role;
$user_id = Auth()->guard('admin')->user()->admin_user_id;
//dd(Auth()->guard('admin')->user()->role);
$role_id = Auth()->guard('admin')->user()->role;

$user = Auth()->guard('admin')->user();

$user_role = Role::where('id',$role_id)->first();
//dd($user_role->submenu_ids);
$menu_ids=explode(",",$user_role->menu_ids);
$submenu_ids=explode(",",$user_role->submenu_ids);

$backend_menubar = BackendMenubar::WhereIn('menu_id',$menu_ids)->Where(['visibility'=>1])->orderBy('sort_order')->get();
// dd($submenu_ids);
@endphp





<div class="horizontal-menu  text-center  " style="position: relative !important;">
    <nav class="navbar top-navbar col-lg-12 col-12 p-0" id="navbar_top">
        <div class="container-fluid">
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                <ul class="navbar-nav navbar-nav-left">
                    <li>
                        <!-- <img src="..\public\backend-assets\images\jm-main-logo.svg" class="logo-img" alt="profile"/> -->
                        <img src="{{ asset('public/backend-assets/images/jm-main-logo.png') }}" class="img-fluid logo-img">

                    </li>


                </ul>
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">

                    <h3 class="logo-name">IDEA SUBMISSION PORTAL</h3>
                </div>
                <ul class="navbar-nav navbar-nav-right" id="NavBar">
                    <li class="nav-item dropdown  d-lg-flex d-none">
                    </li>
                    <li class="nav-item dropdown d-lg-flex d-none">
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="nreportDropdown">

                        </div>
                    </li>
                    <li class="nav-item dropdown d-lg-flex d-none">
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
                        id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                        <i class="mdi mdi-bell mx-0"></i>
                        <span style="position: absolute;top:7px;right:-4px;display:none;line-height:1.5em;justify-content:center;align-items:center;height:15px;width:15px;border-radius:100%;background:red;color:#fff;font-size:0.7em"
                          id="count_unread"></span>
                      </a>

                      <div id="notifications_lists"
                        class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list notification-list"
                        aria-labelledby="notificationDropdown"
                        style="width:340px;left:-170px !important;max-height: 500px;overflow-x: auto">

                        <h2 id="no_notifications" class="mb-0 font-weight-normal float-left dropdown-header"
                          style="display:none;"></h2>

                      </div>
                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                            <span class="nav-profile-name">{{ $user->first_name}} {{$user->last_name}}</span></span>
                            <span class="online-status"></span>

                            <img src="{{ asset('public\backend-assets\images\dummy.png') }}" class="img-fluid">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ route('admin.profile',['id' => $user_id]) }}">
                                <i class="mdi mdi-account-settings text-primary"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.changepassword') }}">
                                <i class="mdi mdi-textbox-password text-primary"></i>
                                Change Password
                            </a>

                            <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                <i class="mdi mdi-logout"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </div>
    </nav>
    @php
    $menu_lists = ['id'=>1,'name'=>'Dashboard'];

    // Code for active class
    $current_route = Route::current()->getName();
    $home_active = $current_route == 'admin.dashboard'?'active':'';
    $submenu_active = '';

    $user_management_active = $current_route == 'admin.users' || $current_route == 'admin.externalusers'?'active':'';
    @endphp
    <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
                <li class="nav-item {{$home_active}}">
                    <a class="nav-link" href="{{route('admin.dashboard')}}">
                        <i class="mdi mdi-file-document-box menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                @php
                foreach($backend_menubar as $menu)
                {
                  // dd($menu->toArray());
                if($menu->has_submenu == 1)
                {
                $backend_submenubar = BackendSubMenubar::WhereIn('submenu_id',$submenu_ids)->Where(['menu_id'=>$menu->menu_id])->get();
                if($backend_submenubar)
                {
                @endphp
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="mdi mdi-account-multiple menu-icon"></i>
                        <span class="menu-title">{{$menu->menu_name}}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            @php
                            foreach($backend_submenubar as $submenu)
                            {
                            $suburl = ($submenu->submenu_controller_name != "#" && $submenu->submenu_controller_name != '')?route($submenu->submenu_controller_name):'#';
                            @endphp
                            <li class="nav-item">
                                <a class="nav-link" href="{{$suburl}}">{{$submenu->submenu_name}}</a>
                            </li>
                            @php
                            }
                            @endphp
                        </ul>
                    </div>
                </li>
                @php
                }
                }else
                {
                $url = ($menu->menu_controller_name != "#" && $menu->menu_controller_name != '')?route($menu->menu_controller_name):'#';
                $route_condition = $menu->menu_controller_name == $current_route ? 'active': '';

                // dump($route_condition);
                @endphp
                <li class="nav-item {{$route_condition}}">
                    <a class="nav-link" href="{{ $url }}">
                        <i class="mdi mdi-file-document-box menu-icon"></i>

                        <span class="menu-title">{{$menu->menu_name}}</span>
                    </a>
                </li>
                @php
                }
                }
                @endphp
            </ul>
        </div>
    </nav>
</div>


<!-- <div class="horizontal-menu"> -->
<!-- <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <ul class="navbar-nav navbar-nav-left">
              <li class="nav-item ms-0 me-5 d-lg-flex d-none">
                <a href="#" class="nav-link horizontal-nav-left-menu"><i class="mdi mdi-format-list-bulleted"></i></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                  <i class="mdi mdi-bell mx-0"></i>
                  <span class="count bg-success">2</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-success">
                          <i class="mdi mdi-information mx-0"></i>
                        </div>
                    </div>
                    <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-normal">Application Error</h6>
                        <p class="font-weight-light small-text mb-0 text-muted">
                          Just now
                        </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-warning">
                          <i class="mdi mdi-settings mx-0"></i>
                        </div>
                    </div>
                    <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-normal">Settings</h6>
                        <p class="font-weight-light small-text mb-0 text-muted">
                          Private message
                        </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-info">
                          <i class="mdi mdi-account-box mx-0"></i>
                        </div>
                    </div>
                    <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-normal">New user registration</h6>
                        <p class="font-weight-light small-text mb-0 text-muted">
                          2 days ago
                        </p>
                    </div>
                  </a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
                  <i class="mdi mdi-email mx-0"></i>
                  <span class="count bg-primary">4</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                        </h6>
                        <p class="font-weight-light small-text text-muted mb-0">
                          The meeting is cancelled
                        </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                        </h6>
                        <p class="font-weight-light small-text text-muted mb-0">
                          New product launch
                        </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                        </h6>
                        <p class="font-weight-light small-text text-muted mb-0">
                          Upcoming board meeting
                        </p>
                    </div>
                  </a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link count-indicator "><i class="mdi mdi-message-reply-text"></i></a>
              </li>
              <li class="nav-item nav-search d-none d-lg-block ms-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="search">
                        <i class="mdi mdi-magnify"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control" placeholder="search" aria-label="search" aria-describedby="search">
                </div>
              </li>
            </ul>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.svg" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
            </div>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown  d-lg-flex d-none">
                  <button type="button" class="btn btn-inverse-primary btn-sm">Product </button>
                </li>
                <li class="nav-item dropdown d-lg-flex d-none">
                  <a class="dropdown-toggle show-dropdown-arrow btn btn-inverse-primary btn-sm" id="nreportDropdown" href="#" data-bs-toggle="dropdown">
                  Reports
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="nreportDropdown">
                      <p class="mb-0 font-weight-medium float-left dropdown-header">Reports</p>
                      <a class="dropdown-item">
                        <i class="mdi mdi-file-pdf text-primary"></i>
                        Pdf
                      </a>
                      <a class="dropdown-item">
                        <i class="mdi mdi-file-excel text-primary"></i>
                        Exel
                      </a>
                  </div>
                </li>
                <li class="nav-item dropdown d-lg-flex d-none">
                  <button type="button" class="btn btn-inverse-primary btn-sm">Settings</button>
                </li>
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <span class="nav-profile-name">Johnson</span>
                    <span class="online-status"></span>
                    <img src="images/faces/face28.png" alt="profile"/>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                      <a class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i>
                        Settings
                      </a>
                      <a class="dropdown-item">
                        <i class="mdi mdi-logout text-primary"></i>
                        Logout
                      </a>
                  </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>

    </div> -->
<!-- END: Header-->
