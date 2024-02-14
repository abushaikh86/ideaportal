<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\RolesController;
use App\Http\Controllers\backend\RolesexternalController;
use App\Http\Controllers\frontend\IdeaController;
use App\Http\Controllers\frontend\MyideasController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\backend\AccountController;
use App\Http\Controllers\backend\CompanyController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\LocationController;
use App\Http\Controllers\frontend\RewardsController;
use App\Http\Controllers\backend\AdminusersController;
use App\Http\Controllers\backend\CategoriesController;
use App\Http\Controllers\backend\DepartmentController;
use App\Http\Controllers\backend\IdeaController as IC;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\ActivityLogController;
use App\Http\Controllers\backend\BackendmenuController;
use App\Http\Controllers\backend\DesignationController;
use App\Http\Controllers\backend\EmailConfigController;
use App\Http\Controllers\backend\ExternalusersController;
use App\Http\Controllers\backend\InternalUsersController;
use App\Http\Controllers\backend\RewardsController as RC;
use App\Http\Controllers\frontend\NotificationController;
use App\Http\Controllers\backend\AdminNotificationController;
use App\Http\Controllers\backend\BackendsubmenuController;
use App\Http\Controllers\backend\SubCategorydetailsController;
use App\Http\Controllers\frontend\UsersController;
use App\Http\Controllers\backend\ImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/otp', 'frontend.users.otp');
// User
Route::get('/', [UserController::class, 'login'])->name('user.login');
Route::get('/user/register', [UserController::class, 'register'])->name('user.register');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::post('/user/auth', [UserController::class, 'auth'])->name('user.auth');
Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('/user/dashboard', [IdeaController::class, 'dashboard'])->name('user.dashboard');
Route::get('/user/profile/{id}', [UserController::class, 'profile'])->name('user.profile');
Route::post('/user/updateProfile', [UserController::class, 'updateProfile'])->name('user.updateProfile');

// Password
Route::get('/user/changePassword', [UserController::class, 'changePassword'])->name('user.changePassword');
Route::get('/user/changeRole', [UserController::class, 'changeRole'])->name('user.changeRole');
Route::get('/users/updaterole/{role}', [UsersController::class, 'updaterole'])->name('users.updaterole');

Route::post('/user/updatePassword', [UserController::class, 'updatePassword'])->name('user.updatePassword');

// Forgot password
Route::get('/user/forgot_password', [UserController::class, 'forgot_password'])->name('user.forgot_password');
Route::post('/sendotp', [UserController::class, 'sendotp'])->name('sendotp.store');
Route::get('/thankyou', [UserController::class, 'forthankyou'])->name('forthankyou');

Route::get('resettoken/{token}', [UserController::class, 'showResetPasswordForm'])->name('resettoken');
Route::post('/changeforgotpassword', [UserController::class, 'changeforgotpassword'])->name('changeforgotpassword.store');

// Verification mail
// Route::get('/verify_mail', [UserController::class, 'verifyMail'])->name('verify_mail');
Route::get('/verify_mail/{token}', [UserController::class, 'verifyMailToken'])->name('verify_mail.token');
Route::get('/verify_mail_success', [UserController::class, 'verifyMailSuccess'])->name('verify_mail.success');

// Ideas
Route::get('/ideas', [IdeaController::class, 'index'])->name('ideas.index');
Route::get('/ideas/addIdea', [IdeaController::class, 'addIdea'])->name('ideas.addIdea');
Route::post('/ideas/storeImageTmp', [IdeaController::class, 'storeImageTmp'])->name('ideas.storeImageTmp');
Route::post('/ideas/storeIdea', [IdeaController::class, 'storeIdea'])->name('ideas.storeIdea');
Route::get('/ideas/delete/{id}', [IdeaController::class, 'distroyIdea'])->name('ideas.delete');
Route::get('/ideas/edit/{id}', [IdeaController::class, 'edit'])->name('ideas.edit');
Route::post('/ideas/update', [IdeaController::class, 'update'])->name('ideas.update');

//my ideas
Route::get('/myideas', [MyideasController::class, 'index'])->name('myideas.index');
Route::get('/myideas/addIdea', [MyideasController::class, 'addIdea'])->name('myideas.addIdea');
Route::post('/myideas/storeImageTmp', [MyideasController::class, 'storeImageTmp'])->name('myideas.storeImageTmp');
Route::post('/myideas/storeIdea', [MyideasController::class, 'storeIdea'])->name('myideas.storeIdea');
Route::get('/myideas/delete/{id}', [MyideasController::class, 'distroyIdea'])->name('myideas.delete');
Route::get('/myideas/edit/{id}', [MyideasController::class, 'edit'])->name('myideas.edit');
Route::post('/myideas/update', [MyideasController::class, 'update'])->name('myideas.update');

// For user and assessment team
Route::get('/ideas/view/{id}', [IdeaController::class, 'view'])->name('ideas.view');

// Idea View for Approving Authority
Route::get('/ideas/view_idea_approving_authority/{id}', [IdeaController::class, 'view_idea_approving_authority'])->name('ideas.view_idea_approving_authority');

// Idea View for implementation team
Route::get('/ideas/view_idea_implementation_team/{id}', [IdeaController::class, 'view_idea_implementation_team'])->name('ideas.view_idea_implementation_team');

// Get chart values
Route::get('/ideas/getChartValues', [IdeaController::class, 'getChartValues'])->name('ideas.getChartValues');

Route::post('/ideas/feedback', [IdeaController::class, 'storeFeedback'])->name('ideas.storeFeedback');
Route::get('/ideas/ideaRevision/{id}', [IdeaController::class, 'ideaRevision'])->name('ideas.ideaRevision');
Route::get('/ideas/viewIdeaRevision/{id}', [IdeaController::class, 'viewIdeaRevision'])->name('ideas.viewIdeaRevision');
Route::post('/ideas/updateIdeaStatus', [IdeaController::class, 'updateIdeaStatus'])->name('ideas.updateIdeaStatus');
Route::get('/ideas/approveIdeaBAU/{id}', [IdeaController::class, 'approveIdeaBAU'])->name('ideas.approveIdeaBAU');
Route::get('/ideas/approveIdeaBAA/{id}', [IdeaController::class, 'approveIdeaBAA'])->name('ideas.approveIdeaBAA');
Route::get('/ideas/idea_implemented/{id}', [IdeaController::class, 'idea_implemented'])->name('ideas.idea_implemented');


// for my ideas

// For user and assessment team
Route::get('/myideas/view/{id}', [MyideasController::class, 'view'])->name('myideas.view');

// Idea View for Approving Authority
Route::get('/myideas/view_idea_approving_authority/{id}', [MyideasController::class, 'view_idea_approving_authority'])->name('myideas.view_idea_approving_authority');

// Idea View for implementation team
Route::get('/myideas/view_idea_implementation_team/{id}', [MyideasController::class, 'view_idea_implementation_team'])->name('myideas.view_idea_implementation_team');

// Get chart values
Route::get('/myideas/getChartValues', [MyideasController::class, 'getChartValues'])->name('myideas.getChartValues');

Route::post('/myideas/feedback', [MyideasController::class, 'storeFeedback'])->name('myideas.storeFeedback');
Route::get('/myideas/ideaRevision/{id}', [MyideasController::class, 'ideaRevision'])->name('myideas.ideaRevision');
Route::get('/myideas/viewIdeaRevision/{id}', [MyideasController::class, 'viewIdeaRevision'])->name('myideas.viewIdeaRevision');
Route::post('/myideas/updateIdeaStatus', [MyideasController::class, 'updateIdeaStatus'])->name('myideas.updateIdeaStatus');
Route::get('/myideas/approveIdeaBAU/{id}', [MyideasController::class, 'approveIdeaBAU'])->name('myideas.approveIdeaBAU');
Route::get('/myideas/approveIdeaBAA/{id}', [MyideasController::class, 'approveIdeaBAA'])->name('myideas.approveIdeaBAA');
Route::get('/myideas/idea_implemented/{id}', [MyideasController::class, 'idea_implemented'])->name('myideas.idea_implemented');




// Ajax call
Route::post('idea/ajax_get_images_modal', [IdeaController::class, 'ajax_get_images_modal'])->name('ideas.ajax_get_images_modal');
Route::post('idea/ajax_get_idea_revision_images_modal', [IdeaController::class, 'ajax_get_idea_revision_images_modal'])->name('ideas.ajax_get_idea_revision_images_modal');
Route::post('myideas/ajax_get_images_modal', [MyideasController::class, 'ajax_get_images_modal'])->name('myideas.ajax_get_images_modal');
Route::post('myideas/ajax_get_idea_revision_images_modal', [MyideasController::class, 'ajax_get_idea_revision_images_modal'])->name('myideas.ajax_get_idea_revision_images_modal');

// Delete single image of idea
Route::get('ideas/delete_image/{id}', [IdeaController::class, 'delete_image'])->name('ideas.delete_image');
Route::get('ideas/update_revision_status_on_user/{id}', [IdeaController::class, 'update_revision_status_on_user'])->name('ideas.update_revision_status_on_user');
Route::get('myideas/delete_image/{id}', [MyideasController::class, 'delete_image'])->name('myideas.delete_image');
Route::get('myideas/update_revision_status_on_user/{id}', [MyideasController::class, 'update_revision_status_on_user'])->name('myideas.update_revision_status_on_user');

// Notifications
Route::get('ideas/ajax_get_notifications', [NotificationController::class, 'ajax_get_notifications'])->name('ideas.ajax_get_notifications');
Route::get('ideas/ajax_update_notification/{notification_id}/{idea_id}', [NotificationController::class, 'ajax_update_notification'])->name('ideas.ajax_update_notification');


// Ideas rewards module
Route::get('/rewards', [RewardsController::class, 'index'])->name('rewards');
Route::get('/rewards/view/{id}', [RewardsController::class, 'view'])->name('rewards.view');
// Generate Certificate
Route::get('ideas/approve_certificate/{id}', [RewardsController::class, 'approveCertificate'])->name('ideas.approve_certificate');
Route::get('myideas/approve_certificate/{id}', [RewardsController::class, 'approveCertificate'])->name('myideas.approve_certificate');

Route::get('/clear-cache', function () {
  $exitCode = Artisan::call('cache:clear');
  // return what you want
});
//Clear configurations:
Route::get('/config-clear', function () {
  $status = Artisan::call('config:clear');
  return '<h1>Configurations cleared</h1>';
});

//Clear cache:
Route::get('/cache-clear', function () {
  $status = Artisan::call('cache:clear');
  return '<h1>Cache cleared</h1>';
});

//Clear configuration cache:
Route::get('/config-cache', function () {
  $status = Artisan::call('config:cache');
  return '<h1>Configurations cache cleared</h1>';
});

//Clear route cache:
Route::get('/route-cache', function () {
  $status = Artisan::call('route:cache');
  return '<h1>Route cache cleared</h1>';
});

//Clear view cache:
Route::get('/view-clear', function () {
  $status = Artisan::call('view:clear');
  return '<h1>View cache cleared</h1>';
});

//dump autoload:
Route::get('/dump-autoload', function () {
  $status = Artisan::call('dump-autoload');
  return '<h1>Dumped Autoload</h1>';
});


// Route::get('/', 'HomeController@index');
// Route::get('/', function () {
// return  'Welcome';
// });


Route::prefix('admin')->group(function () {

  Route::group(['middleware' => 'admin.guest'], function () {
    Route::get('/login', [AccountController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AccountController::class, 'login'])->name('admin.login.submit');

    //backend forgot password
    Route::get('/forgot_password', [AccountController::class, 'forgot_password'])->name('admin.forgot_password');
    Route::post('/sendotp', [AccountController::class, 'sendotp'])->name('admin.sendotp');
    Route::get('/thankyou', [AccountController::class, 'forthankyou'])->name('admin.forthankyou');

    Route::get('/resettoken/{token}', [AccountController::class, 'showResetPasswordForm'])->name('admin.resettoken');
    Route::post('/changeforgotpassword', [AccountController::class, 'changeforgotpassword'])->name('admin.changeforgotpassword');
  });

  // Route::name('user.')->group(function () {

  // });






  Route::group(['middleware' => 'admin.auth'], function () {

    // Route::get('/', [AdminController::class,'index'])->name('admin');
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile/{id}', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/update_profile', [AdminController::class, 'updateProfile'])->name('admin.update_profile');
    Route::get('/changepassword', [AdminController::class, 'changePassword'])->name('admin.changepassword');
    Route::post('/updatepassword', [AdminController::class, 'updatePassword'])->name('admin.updatepassword');
    Route::get('/logout', [AccountController::class, 'logout'])->name('admin.logout');


    // Notifications
    Route::get('ideas/ajax_get_notifications', [AdminNotificationController::class, 'ajax_get_notifications'])->name('ideas.ajax_get_notifications_backend');
    Route::get('ideas/ajax_update_notification/{notification_id}/{idea_id}', [AdminNotificationController::class, 'ajax_update_notification'])->name('ideas.ajax_update_notification_backend');





    Route::get('/permissions', [PermissionController::class, 'index'])->name('admin.permissions');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('admin.permissions.create');
    Route::post('/permissions/store', [PermissionController::class, 'store'])->name('admin.permissions.store');
    Route::get('/permissions/edit/{id}', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
    Route::post('/permissions/update', [PermissionController::class, 'update'])->name('admin.permissions.update');
    Route::get('/permissions/delete/{id}', [PermissionController::class, 'destroy'])->name('admin.permissions.delete');
    Route::resource('admin/permission', 'PermissionController');
    Route::get('/backendmenu', [BackendmenuController::class, 'index'])->name('admin.backendmenu');
    Route::get('/backendmenu/create', [BackendmenuController::class, 'create'])->name('admin.backendmenu.create');
    Route::post('/backendmenu/store', [BackendmenuController::class, 'store'])->name('admin.backendmenu.store');
    Route::get('/backendmenu/edit/{id}', [BackendmenuController::class, 'edit'])->name('admin.backendmenu.edit');
    Route::post('/backendmenu/update', [BackendmenuController::class, 'update'])->name('admin.backendmenu.update');
    Route::get('/backendmenu/delete/{id}', [BackendmenuController::class, 'destroy'])->name('admin.backendmenu.delete');
    Route::get('/backendmenu/view/{id}', [BackendmenuController::class, 'show'])->name('admin.backendmenu.view');
    Route::resource('admin/backendmenu', 'BackendmenuController');
    Route::get('/backendsubmenu', [BackendsubmenuController::class, 'index'])->name('admin.backendsubmenu');
    Route::get('/backendsubmenu/menu/{menu_id}', [BackendsubmenuController::class, 'menu'])->name('admin.backendsubmenu.menu');
    Route::get('/backendsubmenu/create/{menu_id?}', [BackendsubmenuController::class, 'create'])->name('admin.backendsubmenu.create');
    Route::post('/backendsubmenu/store', [BackendsubmenuController::class, 'store'])->name('admin.backendsubmenu.store');
    Route::get('/backendsubmenu/edit/{id}', [BackendsubmenuController::class, 'edit'])->name('admin.backendsubmenu.edit');
    Route::post('/backendsubmenu/update', [BackendsubmenuController::class, 'update'])->name('admin.backendsubmenu.update');
    Route::get('/backendsubmenu/delete/{id}', [BackendsubmenuController::class, 'destroy'])->name('admin.backendsubmenu.delete');
    Route::get('/backendsubmenu/view/{id}', [BackendsubmenuController::class, 'show'])->name('admin.backendsubmenu.view');
    Route::resource('admin/backendsubmenu', 'BackendsubmenuController');

    Route::get('/adminusers', [AdminusersController::class, 'index'])->name('admin.adminusers');
    Route::get('/adminusers/create', [AdminusersController::class, 'create'])->name('admin.adminusers.create');
    Route::post('/adminusers/store', [AdminusersController::class, 'store'])->name('admin.adminusers.store');
    Route::get('/adminusers/edit/{id}', [AdminusersController::class, 'edit'])->name('admin.adminusers.edit');
    Route::post('/adminusers/update', [AdminusersController::class, 'update'])->name('admin.adminusers.update');
    Route::get('/adminusers/delete/{id}', [AdminusersController::class, 'destroy'])->name('admin.adminusers.delete');
    Route::get('/adminusers/view/{id}', [AdminusersController::class, 'show'])->name('admin.adminusers.view');
    Route::get('/adminusers/editstatus/{id}', [AdminusersController::class, 'editstatus'])->name('admin.adminusers.editstatus');
    Route::post('/adminusers/updatestatus', [AdminusersController::class, 'updatestatus'])->name('admin.adminusers.updatestatus');
    Route::resource('admin/adminusers', 'AdminusersController');

    //admin.roles
    Route::get('/roles', [RolesController::class, 'index'])->name('admin.roles');
    Route::get('/rolesexternal', [RolesexternalController::class, 'index'])->name('admin.rolesexternal');
    Route::get('/ideaManagement', [IC::class, 'ideaManagement'])->name('admin.ideaManagement');
    Route::post('/storeFeedback', [IC::class, 'storeFeedback'])->name('admin.storeFeedback');
    Route::get('/ideaView/{id}', [IC::class, 'view'])->name('admin.ideaView');
    Route::post('/updateIdeaStatus', [IC::class, 'updateIdeaStatus'])->name('admin.updateIdeaStatus');

    // Certificate
    Route::get('/rewards/view/{id}', [RC::class, 'view'])->name('admin.rewards.view');
    Route::get('/approve_certificate/{id}', [IC::class, 'approveCertificate'])->name('admin.approve_certificate');





    Route::get('/roles/create', [RolesController::class, 'create'])->name('admin.roles.create');
    Route::post('/roles/store', [RolesController::class, 'store'])->name('admin.roles.store');
    Route::get('/roles/edit/{id}', [RolesController::class, 'edit'])->name('admin.roles.edit');
    Route::post('/roles/update', [RolesController::class, 'update'])->name('admin.roles.update');
    Route::get('/roles/delete/{id}', [RolesController::class, 'destroy'])->name('admin.roles.delete');
    Route::get('/roles/view/{id}', [RolesController::class, 'show'])->name('admin.roles.view');
    Route::resource('admin/roles', 'RolesController');

    Route::get('/rolesexternal/create', [RolesexternalController::class, 'create'])->name('admin.rolesexternal.create');
    Route::post('/rolesexternal/store', [RolesexternalController::class, 'store'])->name('admin.rolesexternal.store');
    Route::get('/rolesexternal/edit/{id}', [RolesexternalController::class, 'edit'])->name('admin.rolesexternal.edit');
    Route::post('/rolesexternal/update', [RolesexternalController::class, 'update'])->name('admin.rolesexternal.update');
    Route::get('/rolesexternal/delete/{id}', [RolesexternalController::class, 'destroy'])->name('admin.rolesexternal.delete');
    Route::get('/rolesexternal/view/{id}', [RolesexternalController::class, 'show'])->name('admin.rolesexternal.view');
    Route::resource('admin/rolesexternal', 'RolesexternalController');



    //admin.internalusers  //September
    //Route::get('/internalusers', [InternalUsersController::class,'index'])->name('admin.internalusers');
    Route::get('/users', [AdminController::class, 'showusers'])->name('admin.users');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/user/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/user/delete/{id}', [AdminController::class, 'destroyUser'])->name('admin.user.delete');
    Route::get('/user/edit/{id}', [AdminController::class, 'edit'])->name('admin.user.edit');
    Route::post('/user/update', [AdminController::class, 'update'])->name('admin.user.update');
    Route::post('/user/statusAndRole', [AdminController::class, 'updateStatusAndRole'])->name('admin.user.statusAndRole');
    Route::get('/user/change/password/{id}', [AdminController::class, 'change_password'])->name('admin.user.change.password');
    Route::post('/user/update/password', [AdminController::class, 'admin_update_password'])->name('admin.user.update.password');

    // Department
    Route::get('/departmentManagement', [DepartmentController::class, 'departmentManagement'])->name('admin.departmentManagement');
    Route::get('/addDepartment', [DepartmentController::class, 'addDepartment'])->name('admin.addDepartment');
    Route::post('/storeDepartment', [DepartmentController::class, 'storeDepartment'])->name('admin.storeDepartment');
    Route::get('/editDepartment/{id}', [DepartmentController::class, 'editDepartment'])->name('admin.editDepartment');
    Route::post('/updateDepartment', [DepartmentController::class, 'updateDepartment'])->name('admin.updateDepartment');
    Route::get('/deleteDepartment/{id}', [DepartmentController::class, 'deleteDepartment'])->name('admin.deleteDepartment');

    //External Users 30/10/2022
    Route::get('/externalusers', [ExternalusersController::class, 'index'])->name('admin.externalusers');
    Route::get('/externalusers/create', [ExternalusersController::class, 'create'])->name('admin.externalusers.create');
    Route::post('externalusers/store', [ExternalusersController::class, 'store'])->name('admin.externalusers.store');
    Route::get('/externalusers/edit/{id}', [ExternalusersController::class, 'edit'])->name('admin.externalusers.edit');
    Route::post('/externalusers/update', [ExternalusersController::class, 'update'])->name('admin.externalusers.update');
    Route::post('/externalusers/status', [ExternalusersController::class, 'updatestatus'])->name('admin.externalusers.updatestatus');
    Route::get('/externalusers/delete/{id}', [ExternalusersController::class, 'destroyUser'])->name('admin.externalusers.delete');
    Route::get('/externalusers/changepassword/{id}', [ExternalusersController::class, 'changepassword'])->name('admin.externalusers.changepassword');
    Route::post('/externalusers/changepassword', [ExternalusersController::class, 'update_new_password'])->name('admin.externalusers.update_password');

    // company master
    Route::get('/company', [CompanyController::class, 'index'])->name('admin.company');
    Route::get('/company/create', [CompanyController::class, 'create'])->name('admin.company.create');
    Route::post('/company/store', [CompanyController::class, 'store'])->name('admin.company.store');
    Route::get('/company/edit/{id}', [CompanyController::class, 'edit'])->name('admin.company.edit');
    Route::post('/company/update', [CompanyController::class, 'update'])->name('admin.company.update');
    Route::get('/company/delete/{id}', [CompanyController::class, 'destroy'])->name('admin.company.delete');


    // location master
    Route::get('/location', [LocationController::class, 'index'])->name('admin.location');
    Route::get('/location/create', [LocationController::class, 'create'])->name('admin.location.create');
    Route::post('/location/store', [LocationController::class, 'store'])->name('admin.location.store');
    Route::get('/location/edit/{id}', [LocationController::class, 'edit'])->name('admin.location.edit');
    Route::post('/location/update', [LocationController::class, 'update'])->name('admin.location.update');
    Route::get('/location/delete/{id}', [LocationController::class, 'destroy'])->name('admin.location.delete');

    // designation master
    Route::get('/designation', [DesignationController::class, 'index'])->name('admin.designation');
    Route::get('/designation/create', [DesignationController::class, 'create'])->name('admin.designation.create');
    Route::post('/designation/store', [DesignationController::class, 'store'])->name('admin.designation.store');
    Route::get('/designation/edit/{id}', [DesignationController::class, 'edit'])->name('admin.designation.edit');
    Route::post('/designation/update', [DesignationController::class, 'update'])->name('admin.designation.update');
    Route::get('/designation/delete/{id}', [DesignationController::class, 'destroy'])->name('admin.designation.delete');

    // Category master
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.delete');


    // Email master
    Route::get('/email_config', [EmailConfigController::class, 'index'])->name('admin.email_config');
    Route::post('/email_config/update', [EmailConfigController::class, 'update'])->name('admin.email_config.update');

    // Email master
    Route::get('/activity_log', [ActivityLogController::class, 'index'])->name('admin.activity_log');

    // Chart JS
    Route::get('/chart', [ChartJSController::class, 'index']);


    route::get('/sheet/import', [ImportController::class,'index'])->name('sheet.import');
    route::post('/sheet/import/external/users', [ImportController::class,'external_customer'])->name('sheet.import.external');
    Route::get('/import/result', [ImportController::class,'display_result'])->name('import_result.data');
  });
}); //End if Admin Group
