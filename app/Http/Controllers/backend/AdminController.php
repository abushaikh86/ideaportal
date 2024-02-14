<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\backend\AdminUsers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\frontend\Ideas;
use App\Models\frontend\Users;
use Exception;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB as FacadesDB;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // dd('dsgd');
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_role = Auth::user()->role;
        $response = array();
        $data = array();
        $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
        foreach ($months as $key => $month) {
            $ideas = Ideas::whereMonth('created_at', $key)->whereYear('created_at', date('Y'))->get();
            $data['x'] = $month;
            $data['y'] = count($ideas);

            array_push($response, $data);
        }
        // dd($response);


        $total_ideas = '';
        $approved_ideas = '';
        $under_approving = '';
        $revise_request = '';
        $implementation = '';
        $rejected = '';
        $under_assessment = '';
        // $on_hold = '';
        // $pending = '';
        $implemented = '';

        $admin_id = Auth::id();
        //if it decentralized
        $data = AdminUsers::where(['admin_user_id' => $admin_id, 'centralized_decentralized_type' => 2])->first();
        // dd($data->toArray());
        if (!empty($data)) {
            $user_data = Users::where(['active_status' => 1,'company_id' => $data->company_id])->pluck('user_id');
            // $user_data = Users::where(['active_status' => 1, 'role' => 'User', 'company_id' => $data->company_id])->get();
            // dd($user_data->toArray());
            // foreach ($user_data as $row) {
                $idea_data = Ideas::whereIn('user_id', $user_data)->get();
        // dd($idea_data->toArray());
                $approved_ideas = Ideas::where(['approving_authority_approval'=>1])->whereIn('user_id', $user_data)->get();
                $under_approving = Ideas::where(['active_status'=>'under_approving_authority'])->whereIn('user_id', $user_data)->get();
                $revise_request = Ideas::where(['active_status'=>'resubmit'])->whereIn('user_id', $user_data)->get();
                $implementation = Ideas::where(['active_status'=>'implementation'])->whereIn('user_id', $user_data)->get();
                $rejected = Ideas::where(['active_status'=>'reject','rejected'=>1])->whereIn('user_id', $user_data)->get();
                $under_assessment = Ideas::where(['active_status'=>'in_assessment'])->whereIn('user_id', $user_data)->get();
                $implemented = Ideas::where(['active_status'=>'implemented'])->whereIn('user_id', $user_data)->get();
                // dd($implemented);
            // }
            // dd($idea_data);
        } else {
            $idea_data = Ideas::all();
            $approved_ideas = Ideas::where('approving_authority_approval', 1)->get();
            $under_approving = Ideas::where('active_status', 'under_approving_authority')->get();
            $revise_request = Ideas::where('active_status', 'resubmit')->get();
            $implementation = Ideas::where('active_status', 'implementation')->get();
            $rejected = Ideas::where('rejected', 1)->where('active_status', 'reject')->get();
            $under_assessment = Ideas::where('active_status', 'in_assessment')->get();
            $implemented = Ideas::where('active_status', 'implemented')->get();
        }

        // dd($idea_data->toArray());

        $total_ideas = count($idea_data);
        $approved_ideas = count($approved_ideas);
        $under_approving = count($under_approving);
        $revise_request = count($revise_request);
        $implementation = count($implementation);
        $rejected = count($rejected);
        $under_assessment = count($under_assessment);
        // $on_hold = count(Ideas::where('active_status', 'on_hold')->get());
        // $pending = count(Ideas::where('active_status', 'pending')->get());
        $implemented = count($implemented);

        return view('backend.admin.dashboard', compact('total_ideas', 'under_approving', 'revise_request', 'rejected', 'under_assessment', 'approved_ideas', 'implementation', 'implemented', 'response'));
    }

    public function showusers()
    {
        $adminusers = AdminUsers::where('admin_user_id','!=',Auth::user()->admin_user_id)->orderBy('admin_user_id', 'DESC')->get();
        return view('backend.admin.index', compact('adminusers'));
    }

    public function create()
    {
        $role = Role::get(['id', 'name'])->toArray();
        return view('backend.admin.create', compact('role'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:admin_users,email,NULL,admin_user_id,deleted_at,NULL',
            'role' => 'required',
            // 'mobile_no' => 'required|numeric|digits:10',
            'password' => 'required|confirmed|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'department' => 'required',
            'company_id' => 'required',
            'location_id' => 'required',
            'designation_id' => 'required',
            'centralized_decentralized_type' => 'required',
        ]);
        $user = new AdminUsers;
        $user->fill($request->all());
        if ($user->save()) {
            // Activity Log
            $log = ['module' => 'Internal Users', 'action' => 'Add User', 'description' => 'Internal User added : ' . $request->first_name . ' ' . $request->last_name];
            captureActivity($log);
            return redirect('/admin/users')->with('success', 'New User Registered');
        } else {
            return redirect('/admin/users')->with('error', 'Failed to add user');
        }
    }

    public function edit($id)
    {
        $userdata = AdminUsers::where('admin_user_id', $id)->first();
        $cc_mail_data = FacadesDB::table('cc_emails')->where('admin_user_id',$id)->select('assign_cc')->get();
        // dd($cc_mail_data->toArray());
        // dd($userdata);
        $role = Role::pluck('name', 'id');
        return view('backend.admin.edit', compact('userdata', 'role','cc_mail_data'));
    }
    public function update(Request $request)
    {
        $update_data = $request->all();
        //unset($update_data['_token']);
        //  dd($update_data);
        $data = AdminUsers::where('admin_user_id', $request->admin_user_id)->get();
        if (count($data) > 0) {
            // $userdata = InternalUser::where('user_id', $request->id)->update($update_data);
            $userdata = AdminUsers::where('admin_user_id', $request->admin_user_id)->first();
            $original_user = $userdata->first_name . ' ' . $userdata->last_name;
            $userdata->fill($request->all());
            if ($userdata->save()) {
                $user_role = [];
                if ($userdata->getChanges()) {
                    // dd();
                    // $upd = json_encode($school->getChanges());

                    //activity Log
                    $upd = $userdata->getChanges();
                    // dd($upd);
                    unset($upd['updated_at']);
                    // dd($upd);
                    $str = ['module' => 'Internal Users', 'action' => 'Edit User', 'description' => 'Internal User Edited  : ' . $original_user . ' : ('];

                    userCaptureActivityupdate($upd, $str, $user_role);
                }
                return redirect()->route('admin.users')->with('success', 'User Has Been Updated');
            } else {
                return redirect('/admin/users')->with('error', 'Failed to update the User');
            }
        }
    }

    //delete user
    public function destroyUser($id)
    {
        $user = AdminUsers::where('admin_user_id', $id)->get();
        if (count($user) > 0) {
            $user = AdminUsers::where('admin_user_id', $id)->first();
            $original_user = $user->first_name . ' ' . $user->last_name;
            if ($user->delete()) {

                // Activity Log
                $log = ['module' => 'Internal User', 'action' => 'Delete User', 'description' => 'User Deleted : ' . $original_user];
                captureActivity($log);

                return redirect('/admin/users')->with('success', 'User Has Been Deleted');
            } else {
                return redirect('/admin/users')->with('error', 'Failed to delete User');
            }
        }
    }

    //update Status
    public function  updateStatusAndRole(Request $request)
    {
        // dd($request->all());
        $data = AdminUsers::where('admin_user_id', $request->admin_user_id)->get();
        if (count($data) > 0) {
            $userdata = AdminUsers::where('admin_user_id', $request->admin_user_id)->first();
            $original_user = $userdata->first_name . ' ' . $userdata->last_name;
            $userdata->fill($request->all());
            $user_role = [];
            // dd($request->assign_cc);
            if ($userdata->save()) {

                if($request->assign_cc=="1"){
                    // dd('safgg');
                    try{
                        DB::table('cc_emails')->insert(
                            ['admin_user_id'=>$request->admin_user_id,'cc_mail'=>$request->email,'assign_cc'=>1]);
                    }catch(Exception $e){
                        DB::table('cc_emails')->where('admin_user_id',$request->admin_user_id)->update(
                            ['assign_cc'=>1]);
                    }
                }else{
                    DB::table('cc_emails')->where('admin_user_id',$request->admin_user_id)->update(
                        ['assign_cc'=>0]);
                }
                if ($userdata->getChanges()) {
                    //activity Log
                    $upd = $userdata->getChanges();

                    unset($upd['updated_at']);
                    // dd($upd);
                    $str = ['module' => 'Internal Users', 'action' => 'Edit Status and Role', 'description' => 'Internal User Status and Role Edited  : ' . $original_user . ' : ('];

                    userCaptureActivityupdate($upd, $str, $user_role);
                }
                return redirect('/admin/users')->with('success', 'User Status and Role Been Updated');
            } else {
                return redirect('/admin/users')->with('error', 'Failed to update User Status and Role');
            }
        }
    }
    public function profile($id)
    {
        $adminuser = AdminUsers::where('admin_user_id', $id)->first();
        $role = Role::pluck('name', 'id');
        return view('backend.admin.myprofile', compact('adminuser', 'role'));
    }
    public function  updateProfile(Request $request)
    {
        $data = AdminUsers::where('admin_user_id', $request->admin_user_id)->get();
        if (count($data) > 0) {
            $userdata = AdminUsers::where('admin_user_id', $request->admin_user_id)->first();
            $original_user = $userdata->first_name . ' ' . $userdata->last_name;
            $userdata->fill($request->all());
            if ($userdata->save()) {
                $user_role = [];
                if ($userdata->getChanges()) {
                    //activity Log
                    $upd = $userdata->getChanges();

                    unset($upd['updated_at']);
                    // dd($upd);
                    $str = ['module' => 'Edit Profile', 'action' => 'Edit Profile', 'description' => 'Profile Edited  : ' . $original_user . ' : ('];

                    userCaptureActivityupdate($upd, $str, $user_role);
                }
                return redirect('/admin/users')->with('success', 'Profile has been updated');
            }
        }
    }
    public function changePassword()
    {
        $id = Auth()->guard('admin')->id();
        // dd($id);
        $userdata = AdminUsers::where('admin_user_id', $id)->first();
        return view('backend.admin.changepassword', compact('userdata'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|required_with:password_confirmation|same:password_confirmation|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);
        $data = AdminUsers::where('admin_user_id', $request->user_id)->first();
        if (count($data->toArray()) > 0) {
            if (Hash::check($request->old_password, $data->password)) {
                // dd('Password matches');
                // dd($request->new_password);
                $data->password = $request->new_password;
                if ($data->save()) {

                    // Activity Log
                    $log = ['module' => 'Change Password', 'action' => 'Change Password', 'description' => 'Account Password Changed '];
                    captureActivity($log);

                    return redirect()->back()->with('success', 'Password Has Been Updated');
                } else {
                    return redirect()->back()->with('error', 'Unable to change the password');
                }
            } else {
                // dd("Password doesn't match");
                return redirect()->route('admin.changepassword')->with('error', "Password doesn't match");
            }
        }
    }


    public function change_password($id){
        $user = AdminUsers::where('admin_user_id',$id)->first();
        if($user){
            return view('backend.admin.admin_change_password', compact('user'));
        }else{
            return redirect()->route('admin.users')->with('error', 'User not found');
        }
    }

    public function admin_update_password(Request $request){
       // dd($request->all());
        $request->validate([
            'password' => 'required|confirmed|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
           ]);
           $user = AdminUsers::where('admin_user_id',$request->user_id)->first();
           if($user){
            $user->password = $request->password;
            if($user->save()){
                return redirect()->route('admin.users')->with('success','Password has been Changed');
            }else{
                return redirect()->route('admin.users')->with('info','failed to update password');
            }
           }else{
            return redirect()->route('admin.users')->with('error','user not found');
           }
    }


}//end of class
//  $2y$10$uP3kg6DjPlGtDoQTSgpOouHGwo/9mBWc9fJkd/1JwwlHRC924JIqS
