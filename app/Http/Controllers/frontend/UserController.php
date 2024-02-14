<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Support\Facades\DB;
use Session;
use PHPMailer\PHPMailer;
use Illuminate\Http\Request;
use App\Models\frontend\Users;
use App\Models\backend\Company;
use App\Models\backend\Location;
use App\Models\backend\Designation;
use App\Models\frontend\Department;
use App\Http\Controllers\Controller;
use App\Models\backend\AdminUsers;
use App\Models\Rolesexternal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    public function register()
    {
        return view('frontend.account.registration');
    }
    public function store_old_2023_08(Request $request)
    {
        // $admin = AdminUsers::where('role_id',1)->get();
        // dd($admin);
        $validated =  $request->validate([
            'name' => 'required|alpha_spaces',
            'last_name' => 'required|alpha_spaces',
            'email' => 'email|required|unique:users',
            'mobile_no' => ['required', 'regex:/^(8|9|7|6)+[0-9]{9}$/'],
            // 'password' => 'required|confirmed',
            'password' => 'required|confirmed|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'department' => 'required',
            'location' => 'required',
            'company_id' => 'required',
            'designation_id' => 'required',

        ]);
        $user = new Users($validated);
        $user->fill($request->all());
        if ($user->save()) {

            // Verification mail
            try {
                $email = $request->email;
                // dd($email);
                $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = '';
                for ($i = 0; $i < 10; $i++) {
                    $index = rand(0, strlen($characters) - 1);
                    $randomString .= $characters[$index];
                }
                // dd($randomString);
                // return $randomString;

                // $mail = new PHPMailer\PHPMailer(true);
                // $mail->IsSMTP();
                // $mail->CharSet = "utf-8"; // set charset to utf8
                //for local start
                // $mail->SMTPAuth = true; // authentication enabled
                // $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
                // $mail->Host = "mail.parasightdemo.com";
                // $mail->Port = 587; // port - 587/465
                // $mail->Username = "jmbaxi@parasightdemo.com";
                // $mail->Password = 'parasight12@#';

                $mail = new PHPMailer\PHPMailer(true);
                $mail->IsSMTP();
                // $mail->IsMail();
                $mail->CharSet = "utf-8"; // set charset to utf8
                //for local start
                //for local end
                $mail->SMTPAuth = true; // authentication enabled
                $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAutoTLS = false;
                $mail->Port = 587; // port - 587/465
                $mail->Username = "ideaportal@jmbaxi.com";
                // $mail->Password = "Zifq87GNHLz3B";
                $mail->Password = 'hfaiylpdgtfsovag';



                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                $mail->isHTML(true);
                $mail->setFrom("ideaportal@jmbaxi.com", 'Jmbaxi');
                // $cc_mail_data = FacadesDB::table('cc_emails')->where(['assign_cc'=>1])->select('*')->get();
                // foreach ($cc_mail_data as $data) {
                //     $mail->addCC($data->cc_mail, 'Owner');
                // }
                $mail->addAddress($email);
                //admin users
                // $admin_users = AdminUsers::where(['role'=> '1', 'account_status' => 1])->get();
                // if (isset($admin_users) && count($admin_users) > 0) {
                //     foreach ($admin_users as $admin_user) {
                //         $mail->addAddress($admin_user->email);
                //     }
                // }

                $mail->Subject = "Jmbaxi Idea Submission Account Verification";
                // $mail->Body = 'Password reset <a href="url("resettoken/{token}")' . $randomString.'">Click Here to change Password</a>';
                $mail->Body = '
                            <p style="font-size:1.2em"><strong>Username : </strong>' . $request->name . ' ' . $request->last_name . '<br>
                           <strong>E-Mail : </strong>' . $request->email . '</p><br>
                            <a href="' . url("/verify_mail/" . $randomString) . '">Click Here to Verify Your mail</a>';
                $mail_status = $mail->Send();

                //sending mail to all admins and cc's
                if ($mail_status) {
                    // dd('verification mail done');

                    $Subject1 = "New User Notification";
                    // $mail->Body = 'Password reset <a href="url("resettoken/{token}")' . $randomString.'">Click Here to change Password</a>';
                    $Body1 = '
                <h4>New User Registered Just Now!</h4>
                <p>' . $request->name . ' ' . $request->last_name . ' Has Registered Successfully!</p>
                ';
                                   $cc_mails = array();
                    mailCommunication($Subject1, $Body1, $cc_mails,$email );
                }



                Session::put('email', $email);
                Session::put('user_id ', $user->user_id);

                if ($user->verify_token != null) {

                    $user = Users::where('email', $email)->update('verify_token', $randomString);
                } else {
                    $user->verify_token = $randomString;
                    $user->save();
                }
                return redirect()->route('user.login')->with('success', 'Registered successfully \n Verification Email has been sent to your mail');

                // return redirect()->to('/verify_mail/' . $randomString);
            } catch (phpmailerException $e) {
                echo $e->errorMessage();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            return redirect()->route('user.dashboard')->with('success', 'User Has Been Registered');
        } else {
            return redirect()->route('user.dashboard')->with('error', 'Failed to Register User');
        }
        // dd(route('frontend.users.dashbard'));

    }

 public function store(Request $request)
    {
        // $admin = AdminUsers::where('role_id',1)->get();
        // dd($admin);
        $validated =  $request->validate([
            'name' => 'required|alpha_spaces',
            'last_name' => 'required|alpha_spaces',
            'email' => 'email|required|unique:users',
            'mobile_no' => ['required', 'regex:/^(8|9|7|6)+[0-9]{9}$/'],
            // 'password' => 'required|confirmed',
            'password' => 'required|confirmed|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'department' => 'required',
            'location' => 'required',
            'company_id' => 'required',
            'designation_id' => 'required',

        ]);
        $user = new Users($validated);
        $user->fill($request->all());
        if ($user->save()) {
            $all_mails = array();
            // Verification mail
            try {
                $email = $request->email;
                // dd($email);
                $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = '';
                for ($i = 0; $i < 10; $i++) {
                    $index = rand(0, strlen($characters) - 1);
                    $randomString .= $characters[$index];
                }
                // dd($randomString);
                // return $randomString;

                // $mail = new PHPMailer\PHPMailer(true);
                // $mail->IsSMTP();
                // $mail->CharSet = "utf-8"; // set charset to utf8
                //for local start
                // $mail->SMTPAuth = true; // authentication enabled
                // $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
                // $mail->Host = "mail.parasightdemo.com";
                // $mail->Port = 587; // port - 587/465
                // $mail->Username = "jmbaxi@parasightdemo.com";
                // $mail->Password = 'parasight12@#';

                $mail = new PHPMailer\PHPMailer(true);
                $mail->IsSMTP();
                // $mail->IsMail();
                $mail->CharSet = "utf-8"; // set charset to utf8
                //for local start
                //for local end
                $mail->SMTPAuth = true; // authentication enabled
                $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAutoTLS = false;
                $mail->Port = 587; // port - 587/465
                $mail->Username = "ideaportal@jmbaxi.com";
                $mail->Password = "hfaiylpdgtfsovag";



                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                $mail->isHTML(true);
                $mail->setFrom("ideaportal@jmbaxi.com", 'Jmbaxi');
                // $cc_mail_data = FacadesDB::table('cc_emails')->where(['assign_cc'=>1])->select('*')->get();
                // foreach ($cc_mail_data as $data) {
                //     $mail->addCC($data->cc_mail, 'Owner');
                // }
                $mail->addAddress($email);
                $all_mails[] = $email;

              

                $mail->Subject = "Jmbaxi Idea Submission Account Verification";
                // $mail->Body = 'Password reset <a href="url("resettoken/{token}")' . $randomString.'">Click Here to change Password</a>';
                $mail->Body = '
                            <p style="font-size:1.2em"><strong>Username : </strong>' . $request->name . ' ' . $request->last_name . '<br>
                           <strong>E-Mail : </strong>' . $request->email . '</p><br>
                            <a href="' . url("/verify_mail/" . $randomString) . '">Click Here to Verify Your mail</a>';

                            $mail_status = $mail->Send();

                //sending mail to all admins and cc's
                if ($mail_status) {
                    // dd('verification mail done');
                    $Subject1 = "New User Notification";
                    // $mail->Body = 'Password reset <a href="url("resettoken/{token}")' . $randomString.'">Click Here to change Password</a>';
                    $Body1 = '
                    <h4>New User Registered Just Now!</h4>
                    <p>' . $request->name . ' ' . $request->last_name . ' Has Registered Successfully!</p>
                    <p> Email Id - ' . $email.'</p>
                    ';

                    //mailCommunication($Subject1, $Body1, $cc_mails, $email);
                    $this->user_register_mail_admin($Subject1,$Body1,$request->company_id);
                }



                Session::put('email', $email);
                Session::put('user_id ', $user->user_id);

                if ($user->verify_token != null) {

                    $user = Users::where('email', $email)->update('verify_token', $randomString);
                } else {
                    $user->verify_token = $randomString;
                    $user->save();
                }
                return redirect()->route('user.login')->with('success', 'Registered successfully \n Verification Email has been sent to your mail');

                // return redirect()->to('/verify_mail/' . $randomString);
            } catch (phpmailerException $e) {
                echo $e->errorMessage();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            return redirect()->route('user.dashboard')->with('success', 'User Has Been Registered');
        } else {
            return redirect()->route('user.dashboard')->with('error', 'Failed to Register User');
        }
        // dd(route('frontend.users.dashbard'));

    }

    public function verifyMailToken(Request $request)
    {
        $user = Users::where('verify_token', $request->token)->get();
        if (count($user) > 0) {
            // dd(count($user) > 0);
            $user = Users::where('verify_token', $request->token)->update(['email_verification' => 1]);
            if ($user) {
                return redirect()->route('verify_mail.success');
            } else {
                return redirect()->route('user.login')->with('error', 'Failed to verify the mail');
            }
        } else {
            return redirect()->route('user.login')->with('error', 'Failed to verify the mail');
        }
    }
    public function verifyMailSuccess()
    {
        return view('frontend.account.verified');
    }
    public function login()
    {
        return view('frontend.account.userLogin');
    }

public function logouttimeout(){
        Auth::logout();
        return redirect('/')->withErrors(['timeout'=>'Session timeout. Please login again']);
    }


    public function auth(Request $request)
    {
        // return $request->input('email');

        $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);




        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (auth()->user()->active_status && !empty(auth()->user()->sub_role)) {
                // dd(Auth::user()->sub_role_final);
                if (empty(Auth::user()->sub_role_final)) {
                    DB::table('users')->where('user_id', Auth::user()->user_id)->update(['sub_role_final' => Auth::user()->sub_role]);
                }
                $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
                $menus = [];
                if (!empty($roles_external)) {
                    $menus = explode(',', $roles_external->menu_values);
                }

                if (in_array('menu_values', $menus)) {
                    if (in_array('dashboard', $menus)) {
                        return redirect()->route('user.dashboard');
                    } else if (in_array('my_ideas', $menus)) {
                        return redirect()->route('ideas.index');
                    } else if (in_array('rewards', $menus)) {
                        return redirect()->route('rewards');
                    }
                }
                return redirect()->route('user.dashboard');
            } else {

                if (empty(Auth::user()->sub_role)) {
                    Auth::logout();
                    return redirect()->route('user.login', ['status' => 'errorRA']);
                } else {
                    Auth::logout();
                    return redirect()->route('user.login', ['status' => 'errorNA']);
                }
            }
        } else {
            // return redirect()->route('user.login', ['status' => 'error']);
            return redirect()->back()->with('error', 'The email or password is incorrect, please try again');
        }
    }


       public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
    // public function logouttimeout(){
    //     Auth::logout();
    //     return redirect('/')->withErrors(['timeout'=>'Session timeout. Please login again']);
    // }
    
    public function profile()
    {
        $id = Auth::id();
        $userdata = Users::where('user_id', $id)->first();
        $department = Department::pluck('name', 'department_id');
        $location = Location::pluck('location_name', 'location_id');
        $designation = Designation::pluck('designation_name', 'designation_id');
        $company = Company::pluck('company_name', 'company_id');
        return view('frontend.users.editProfile', compact('userdata', 'department', 'location', 'designation', 'company'));
    }
    public function updateProfile(Request $request)
    {
        $validated =  $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'email|required',
            'mobile_no' => 'required|numeric|digits:10',
            // 'email' => 'email|required',
            // 'mobile_no' => 'required',
            'department' => 'required',
            'location' => 'required',
            'company_id' => 'required',
            'designation_id' => 'required',
        ]);
        $form_data = $request->all();
        unset($form_data['email']);
        $data = Users::where('user_id', $request->user_id)->first();
        if (count($data->toArray()) > 0) {
            $data->fill($form_data);
            if ($data->save()) {
                return redirect()->back()->with('success', 'User Has Been Updated');
            }
        }
    }

    public function changePassword()
    {
        $id = Auth::id();
        $userdata = Users::where('user_id', $id)->first();
        return view('frontend.users.user_change_password', compact('userdata'));
    }


    public function changeRole()
    {
        $id = Auth::id();
        $userdata = Users::where('user_id', $id)->first();
        $multi_role = explode(",", $userdata->sub_role);
        $role = Rolesexternal::whereIn('id', $multi_role)->pluck('role_name', 'id');
        return view('frontend.users.change_role', compact('userdata', 'role', 'multi_role'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|required_with:password_confirmation|same:password_confirmation|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);
        $data = Users::where('user_id', $request->user_id)->first();
        if (count($data->toArray()) > 0) {
            if (Hash::check($request->old_password, $data->password)) {
                // dd('password matches');

                $data->password = $request->new_password;
                if ($data->save()) {
                    return redirect()->back()->with('success', 'Password Has Been Updated');
                }
            } else {
                // dd("Password doesn't match");
                return redirect()->route('user.changePassword')->with('error', "Password doesn't match");
            }
        }
    }
    public function forgot_password()
    {
        return view('frontend.account.forgot_password');
    }
    public function sendotp(Request $request)
    {


        // dd($request->all());
        $this->validate(request(), [
            'email' => 'required',
        ]);
        $user = Users::where('email', $request->email)->first();
        // dd($user->toarray());
        //   $user = $request->admin_user_id;

        if ($user == null) {
            return redirect()->route('user.forgot_password')->withErrors(['Inavlid Email!!!Please Try with Valid Email']);
        }
        try {
            //             $token = random();
            // dd($token);
            $email = $request->email;
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < 10; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
            // dd($randomString);
            // return $randomString;
            $mail = new PHPMailer\PHPMailer(true);
            $mail->IsSMTP();
            $mail->CharSet = "utf-8"; // set charset to utf8
            //for local start
            // $mail->SMTPAuth = true; // authentication enabled
            // $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
            // $mail->Host = "mail.parasightdemo.com";
            // $mail->Port = 587; // port - 587/465
            // $mail->Username = "jmbaxi@parasightdemo.com";
            // $mail->Password = 'parasight12@#';
            //
            // $mail->SMTPAuth = true; // authentication enabled
            // $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
            // $mail->Host = "smtp.gmail.com";
            // $mail->Port = 587; // port - 587/465
            // $mail->Username = env('MAIL_FROM');
            // $mail->Password = env('MAIL_PASS');

            $mail = new PHPMailer\PHPMailer(true);
            $mail->IsSMTP();
            // $mail->IsMail();
            $mail->CharSet = "utf-8"; // set charset to utf8
            //for local start
            //for local end
            $mail->SMTPDebug = 3;
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "smtp.gmail.com";
            //$mail->SMTPAutoTLS = false;
            $mail->Port = 587; // port - 587/465
            $mail->Username = "ideaportal@jmbaxi.com";
            $mail->Password =  'hfaiylpdgtfsovag'; // "Zifq87GNHLz3B";//"acvyqwlrafchmrul";

            //for local end
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->isHTML(true);
            $mail->setFrom("ideaportal@jmbaxi.com", 'Jmbaxi');
            $mail->AddAddress($email);
            $mail->Subject = "Passowrd Reset link";
            // $mail->Body = 'Password reset <a href="url("resettoken/{token}")' . $randomString.'">Click Here to change Password</a>';
            $mail->Body = 'Password reset <a href="' . url("/resettoken/" . $randomString) . '">Click Here to change Password</a>';
            // dd($mail->Body);
            $mail->Send();

            Session::put('email', $email);
            Session::put('admin_user_id ', $user->admin_user_id);

            if ($user->token != null) {
                // $user = DB::table('admin_users')
                //     ->where('email', $email)
                //     ->update(array(
                //         'token' => $randomString
                //     ));
                $user = Users::where('email', $email)->update(['token' => $randomString]);
            } else {
                $user->token = $randomString;
                $user->save();
            }

            return redirect()->to('/thankyou')->with('success', 'Email has been sent');

            // return redirect()->to('/resettoken/' . $randomString)->with('success', 'Email has been sent');
        } catch (phpmailerException $e) {
            echo $e->errorMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function forthankyou()
    {
        return view('frontend.account.thankyou');
    }
    public function showResetPasswordForm(request $request)
    {
        // echo"hello";
        $resetdata = Users::where('token', $request->token)->get();
        // dd($resetdata);
        if (isset($request->token) && count($resetdata) > 0) {
            $user = Users::where('email', $resetdata[0]['email'])->get();
        }
        return view('frontend.account.setpasswordform', compact('user'));
    }
    public function changeforgotpassword(request $request)
    {
        // dd($request->all());
        $this->validate(request(), [
            'password' => 'required|required_with:password_conformation|same:password_conformation|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_conformation' => 'required',
        ]);
        $user = Users::find($request->id);
        $user->password = ($request->password);
        $user->save();
        // Session::flash('success','The password has been changed Successfully');
        return redirect()->route('user.login')->with('success', 'The password has been changed Successfully');
    }

public function user_register_mail_admin($Subject1,$Body1, $cid){
        $all_mails = array();
        try {
            $mail = new PHPMailer\PHPMailer(true);
            $mail->IsSMTP();
            $mail->CharSet = "utf-8"; // set charset to utf8
            //for local start
            //for local end
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAutoTLS = false;
            $mail->Port = 587; // port - 587/465
            $mail->Username = "ideaportal@jmbaxi.com";
            $mail->Password = "hfaiylpdgtfsovag";

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->isHTML(true);
            $mail->setFrom("ideaportal@jmbaxi.com", 'Jmbaxi');
             $admin = AdminUsers::where(['role' => 1, 'account_status' => 1, 'centralized_decentralized_type' => 1])->get();
              foreach ($admin as $data) {
                  $central_ids[] = $data->admin_user_id;
                  // $mail->addAddress($data->email, 'Admin');
                  if(count($all_mails) > 0 && in_array($data->email,$all_mails)){
                      //dont add email twise
                  }else{
                      $mail->addAddress($data->email, "'" . (isset($data->first_name) ? $data->first_name : '') . ' ' . (isset($data->last_name) ? $data->last_name : '') . "'");
                      $all_mails[] = $data->email;
                  }
              }
             $c_admin = AdminUsers::where(['role' => 1, 'account_status' => 1, 'company_id' => $cid])->WhereNotIN('admin_user_id', $central_ids)->get();
              foreach ($c_admin as $data) {
                  // $mail->addAddress($data->email, 'Admin');
                  if(count($all_mails) > 0 && in_array($data->email,$all_mails)){
                      //dont add email twise
                  }else{
                      $mail->addAddress($data->email, "'" . (isset($data->first_name) ? $data->first_name : '') . ' ' . (isset($data->last_name) ? $data->last_name : '') . "'");
                      $all_mails[] = $data->email;
                  }
              }

            $mail->Subject = $Subject1;
            $mail->Body = $Body1;

            $mail->Send();
            // return redirect()->to('/verify_mail/' . $randomString);
        } catch (phpmailerException $e) {
            echo $e->errorMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }


    }
}
