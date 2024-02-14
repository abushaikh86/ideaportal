<?php
    use App\Models\frontend\Notification;
    use App\Models\frontend\Users;
    use App\Models\Rolesexternal;
    $user_id = Auth()->user()->user_id;
    $user = Auth()->user();

    $menus = [];

    $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
    $roles_external1 = Rolesexternal::where(['role_type' => 'User'])
        ->pluck('id')
        ->toArray();

   $curr_user_data = DB::table('users')
   ->whereRaw('FIND_IN_SET(?, sub_role)', 3)
   ->where('user_id', Auth::user()->user_id)
   ->get();
   
    $userdata = Users::where('user_id', Auth::id())->first();
    $multi_role = explode(',', $userdata->sub_role);
    $role_data = Rolesexternal::whereIn('id', $multi_role)
        ->pluck('role_name', 'id')
        ->toArray();

    if (!empty($roles_external)) {
        $menus = explode(',', $roles_external->menu_values);
    }
?>

<header class="navbar navbar-expand-md d-print-none cs-header">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="<?php echo e(url('/')); ?>/user/dashboard"class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <img src="<?php echo e(asset('/public/frontend-assets/images/logo.png')); ?>" alt=""
                class="navbar-brand-image" />
        </a>

        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown d-md-flex me-3">
                <a href="#" id="bell_icon" class="nav-link px-0" data-toggle="dropdown" tabindex="-1"
                    aria-label="Show notifications">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                        <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                    </svg>
                    <span style="display:none;line-height:15px;height:15px; min-width:10px;border-radius:100%"
                        id="count_unread" class="badge bg-red"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-card">
                    <h2 id="no_notifications" style="display:none;"></h2>
                    <div class="col-sm-12 px-2 text-right clear_notification_btn_div text-end">
                        <a href="<?php echo e(url('/')); ?>/user/notifications/show" class="btn btn-primary btn-sm btn_show_notif m-1 " style='float-right;' data="<?php echo e(Auth::user()->user_id); ?>">Show All</a>
                        <span class="btn btn-info btn-sm  btn_clear_notif m-1" style='float-right;' data="<?php echo e(Auth::user()->user_id); ?>">Clear</span>
                    </div>
                    <ul id="notifications_lists" class="list-group" style="max-height: 500px;overflow-x: auto">
                    </ul>
                </div>
            </div>

            <?php if(count($role_data) > 1): ?>
                <div class="nav-item dropdown">
                    <div class="form-group mb-0">
                        <select name="role" id="role_global" class="form-select">
                            <?php
                            foreach ($role_data as $key => $val) {
                                if (Auth::user()->sub_role_final == $key) {
                                    echo "<option value='$key' selected>$val</option>";
                                } else {
                                    echo "<option value='$key'>$val</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            <?php endif; ?>

            <div class="nav-item dropdown">
                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="<?php echo e(asset('/public/frontend-assets/images/user.png')); ?>" alt="avatar">
                    </div>
                    <span class="user-name ps-2"><?php echo e($user->name); ?> <?php echo e($user->last_name); ?> <i><?php echo e($user->designation); ?></i></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a class="dropdown-item" href="<?php echo e(route('user.profile', ['id' => $user_id])); ?>">
                        <i class="feather icon-user"></i>  Edit Profile
                    </a>
                    <a class="dropdown-item" href="<?php echo e(route('user.changePassword')); ?>">
                        <i class="feather icon-check-square"></i>  Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="<?php echo e(route('user.logout')); ?>">
                        <i class="feather icon-power"></i>  Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="navbar-expand-md cs-navbar">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-fluid">
                <?php if(in_array('menu_values', $menus)): ?>
                    <ul class="navbar-nav">
                        <?php
                            $current_route = Route::current()->getName();
                           // dd($current_route);
                            $ideaManagement_active =  $current_route == 'ideas.index' || $current_route == 'ideas.view' || $current_route == 'ideas.addIdea' || $current_route == 'ideas.edit' || $current_route == 'ideas.view_idea_implementation_team' || $current_route == 'ideas.ideaRevision' || $current_route == 'ideas.view_idea_approving_authority' || $current_route == 'ideas.viewIdeaRevision' ? 'active' : '';
                            $ideaManagement_active_myideas = $current_route == 'myideas.index' || $current_route == 'myideas.view' || $current_route == 'myideas.addIdea' || $current_route == 'myideas.edit' || $current_route == 'myideas.view_idea_implementation_team' || $current_route == 'myideas.ideaRevision' || $current_route == 'myideas.view_idea_approving_authority' || $current_route == 'myideas.viewIdeaRevision' ? 'active' : '';
                            $home_active = $current_route == 'user.dashboard' ? 'active' : '';
                            $rewards_active = $current_route == 'rewards' || $current_route == 'rewards.view' ? 'active' : '';
                            $all_idea_active = $current_route == 'all.ideas' ? 'active':'';
                        ?>
                        <?php if(in_array('dashboard', $menus)): ?>
                            <li class="nav-item <?php echo e($home_active); ?>">
                                <a class="nav-link" href="<?php echo e(url('/')); ?>/user/dashboard">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title"> Home </span>
                                </a>
                            </li>
                        <?php endif; ?>


                        <?php if(in_array('all ideas',$menus)): ?>
                        <li class="nav-item <?php echo e($all_idea_active); ?>">
                            <a class="nav-link" href="<?php echo e(url('/')); ?>/all/ideas">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                        <line x1="9" y1="9" x2="10" y2="9" />
                                        <line x1="9" y1="13" x2="15" y2="13" />
                                        <line x1="9" y1="17" x2="15" y2="17" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">All Ideas</span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if(strtolower($roles_external->role_type) == 'user'): ?>
                            <?php if(in_array('ideas_for_approval', $menus)): ?>
                                <li class="nav-item <?php echo e($ideaManagement_active); ?>">
                                    <a class="nav-link" href="<?php echo e(url('/')); ?>/ideas">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path
                                                    d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                <line x1="9" y1="9" x2="10" y2="9" />
                                                <line x1="9" y1="13" x2="15" y2="13" />
                                                <line x1="9" y1="17" x2="15" y2="17" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">Ideas</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php else: ?>
                            <?php if(in_array('ideas_for_approval',$menus)): ?>
                            <li class="nav-item <?php echo e($ideaManagement_active); ?>">
                                <a class="nav-link" href="<?php echo e(url('/')); ?>/ideas">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <line x1="9" y1="9" x2="10" y2="9" />
                                            <line x1="9" y1="13" x2="15" y2="13" />
                                            <line x1="9" y1="17" x2="15" y2="17" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">Ideas for Approval</span>
                                </a>
                            </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        <?php if(!$curr_user_data->isEmpty() && $roles_external->role_type != 'User' && in_array('my_ideas', $menus)): ?>
                            <li class="nav-item <?php echo e($ideaManagement_active_myideas); ?>">
                                <a class="nav-link" href="<?php echo e(url('/myideas')); ?>">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <line x1="9" y1="9" x2="10" y2="9" />
                                            <line x1="9" y1="13" x2="15" y2="13" />
                                            <line x1="9" y1="17" x2="15" y2="17" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">My Ideas</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if(!$curr_user_data->isEmpty() && in_array('rewards', $menus)): ?>
                            <li class="nav-item <?php echo e($rewards_active); ?>">
                                <a class="nav-link" href="<?php echo e(url('/')); ?>/rewards">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <line x1="9" y1="9" x2="10" y2="9" />
                                            <line x1="9" y1="13" x2="15" y2="13" />
                                            <line x1="9" y1="17" x2="15" y2="17" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">Rewards and Recognition</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    
                    <div class="status">Logged in as : 
                        <strong><?php echo e($roles_external->role_name); ?></strong>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/ideaportal/resources/views/frontend/includes/header.blade.php ENDPATH**/ ?>