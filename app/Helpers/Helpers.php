<?php

use PHPMailer\PHPMailer;
use App\Models\frontend\Cart;
use App\Models\backend\Company;
use Illuminate\Support\Facades\DB as FacadesDB;
// use App\Models\frontend\Orders;
use App\Models\frontend\Orders;
use App\Models\backend\Location;
use App\Models\backend\StateCodes;
use Spatie\Permission\Models\Role;
use App\Models\backend\ActivityLog;
use App\Models\backend\AdminNotification;
use App\Models\backend\AdminUsers;
use App\Models\backend\Designation;
use App\Models\frontend\Department;
use App\Models\frontend\CartCoupons;
use Illuminate\Support\Facades\Session;
use App\Models\backend\OrderCancelManagement;
use App\Models\backend\OrderReturnManagement;
use App\Models\frontend\Notification;
use App\Models\frontend\Users;
use App\Models\frontend\User;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer as PHPMailerPHPMailer;
use App\Models\backend\Filesetting;






if (!function_exists('captureActivity')) {
  function captureActivity($data)
  {
    $user_array = [];
    $id = Auth()->guard('admin')->user()->admin_user_id;
    $username = Auth()->guard('admin')->user()->first_name . ' ' . Auth()->guard('admin')->user()->last_name;
    $ses_id = Session::getId();
    $user_array = [
      'user_id' => $id,
      'user_name' => $username,
      'session_id' => $ses_id
    ];

    // dd($user_array);
    $row = array_merge($user_array, $data);
    // dd($row);
    $log = new ActivityLog();
    $log->fill($row);
    // dd($log->getChanges());
    $log->save();
  }
}

if (!function_exists('captureActivityupdate')) {
  function captureActivityupdate($upd, $data)
  {
    $user_array = [];
    $id = Auth()->guard('admin')->user()->admin_user_id;
    $username = Auth()->guard('admin')->user()->first_name . ' ' . Auth()->guard('admin')->user()->last_name;
    $ses_id = Session::getId();
    $user_array = ['user_id' => $id, 'user_name' => $username, 'session_id' => $ses_id];
    // dd($id_to_names);

    $dataAttributes = array_map(function ($value, $key) {
      return $key . '="' . $value . '" ,';
    }, array_values($upd), array_keys($upd));

    $dataAttributes = implode(' ', $dataAttributes);
    $dataAttributes = rtrim($dataAttributes, ' ,');;

    $data['description'] = $data['description'] . ' ' . $dataAttributes . ')';
    // dd($data['description']);

    $row = array_merge($user_array, $data);
    $log = new ActivityLog();
    $log->fill($row);
    $log->save();
  }
}
if (!function_exists('userCaptureActivityupdate')) {
  function userCaptureActivityupdate($upd, $data, $user_role)
  {
    // dd(count($id_to_names));
    // $id_to_names = $id_to_names ?? '';
    $user_array = [];
    $id = Auth()->guard('admin')->user()->admin_user_id;
    $username = Auth()->guard('admin')->user()->first_name . ' ' . Auth()->guard('admin')->user()->last_name;
    $ses_id = Session::getId();
    $user_array = ['user_id' => $id, 'user_name' => $username, 'session_id' => $ses_id];
    // dd($id_to_names);

    $dataAttributes = array_map(function ($value, $key, $user_role) {
      if ($key == 'department') {
        if (isset($value)) {
          $department = Department::where('department_id', $value)->first();
          $department_name = $department->name ?? '';
        }
        $value = $department_name ?? '';
        $key = 'Department';
      } elseif ($key == 'company_id') {
        if (isset($value)) {
          $company = Company::where('company_id', $value)->first();
          $company_name = $company->company_name ?? '';
        }
        $value = $company_name ?? '';
        $key = 'Company';
      } elseif ($key == 'location_id' || $key == 'location') {
        if (isset($value)) {
          $location = Location::where('location_id', $value)->first();
          $location_name = $location->location_name ?? '';
        }
        $value = $location_name ?? '';
        $key = 'Location';
      } elseif ($key == 'designation_id') {
        if (isset($value)) {
          $designation = Designation::where('designation_id', $value)->first();
          $designation_name = $designation->designation_name ?? '';
        }
        $value = $designation_name ?? '';
        $key = 'Designation';
      } elseif ($key == 'role' && $user_role != 1) {
        if (isset($value)) {
          $role = Role::where('id', $value)->first();
          $role_name = $role->name ?? '';
        }
        $value = $role_name ?? '';
        $key = 'Role';
      } elseif ($key == 'account_status' || $key == 'active_status') {
        if (isset($value)) {
          if ($value == '0') {
            $account_status = 'Inactive';
          } else {
            $account_status = 'Active';
          }
        }
        $value = $account_status ?? '';
        $key = 'Account Status';
      } elseif ($key == 'centralized_decentralized_type') {
        if (isset($value)) {
          if ($value == '1') {
            $centralized_decentralized_type = 'Centralized';
          } else {
            $centralized_decentralized_type = 'Decentralized';
          }
        }
        $value = $centralized_decentralized_type ?? '';
        $key = 'Centralized/Decentralized Type';
      }
      return $key . '="' . $value . '" ,';
    }, array_values($upd), array_keys($upd), $user_role);

    $dataAttributes = implode(' ', $dataAttributes);
    $dataAttributes = rtrim($dataAttributes, ' ,');;

    $data['description'] = $data['description'] . ' ' . $dataAttributes . ')';
    // dd($data['description']);

    $row = array_merge($user_array, $data);
    $log = new ActivityLog();
    $log->fill($row);
    $log->save();
  }
}

//mail --change when live
if (!function_exists('mailCommunication')) {
  function mailCommunication($subject, $body, $cc_mail_ids, $to_whom = null)
  {
    $all_mails = array();
    //dd($subject, $body, $cc_mail_ids, $to_whom,123);
    try {
      $mail = new PHPMailer\PHPMailer(true);
      $mail->IsSMTP();
      // $mail->IsMail();
      $mail->CharSet = "utf-8"; // set charset to utf8
      //for local start
      //for local end
      //$mail->SMTPDebug  = 4;
      $mail->SMTPAuth = true; // authentication enabled
      //$mail->SMTPKeepAlive = true;
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

      // $cc_mail_data = FacadesDB::table('cc_emails')->where(['assign_cc' => 1])->select('*')->get();
      // foreach ($cc_mail_data as $data) {
      //   $mail->addCC($data->cc_mail, 'Owner');
      // }

      // //whom to send
      // if (!empty($to_whom)) {
      //   $mail->addAddress($to_whom, 'User');
      // }

      //   $admin = AdminUsers::where(['role' => 1, 'account_status' => 1])->get();
      //   foreach ($admin as $data) {
      //       $mail->addAddress($data->email, 'Admin');
      //     }


      //     $central_ids = array();
      //     $admin = AdminUsers::where(['role' => 1, 'account_status' => 1,'centralized_decentralized_type'=>1])->get();
      //     foreach ($admin as $data) {
      //         $central_ids[] = $data->admin_user_id;
      //         $mail->addAddress($data->email, 'Admin');
      //       }


      //       $c_admin = AdminUsers::where(['role' => 1, 'account_status' => 1, 'company_id'=>Auth::user()->company_id])->WhereNotIN('admin_user_id',$central_ids)->get();
      //     foreach ($c_admin as $data) {
      //         $mail->addAddress($data->email, 'Admin');
      //       }

      // $cc_mail_data = FacadesDB::table('cc_emails')->where(['assign_cc' => 1])->select('*')->get();
      //         foreach ($cc_mail_data as $data) {
      //             $mail->addCC($data->cc_mail, 'Owner');
      //         }
      if (isset($cc_mail_ids) && count($cc_mail_ids) > 0) {
        foreach ($cc_mail_ids as  $index => $data) {

          //echo $data;
          //dd($data[$index]);
          $mail->addCC($data, 'Owner');
          $all_mails[] = $data;
        }
      }


      //whom to send
      if (!empty($to_whom)) {
        $idea_creator = User::where('email', $to_whom)->first();
        if ($idea_creator) {
          $mail->addAddress($idea_creator->email, "'" . (isset($idea_creator->name) ? $idea_creator->name : '') . ' ' . (isset($idea_creator->last_name) ? $idea_creator->last_name : '') . "'");
          //   $mail->addAddress($to_whom, 'User');
        }
      }

      //   $admin = AdminUsers::where(['role' => 1, 'account_status' => 1])->get();
      //   foreach ($admin as $data) {
      //       $mail->addAddress($data->email, 'Admin');
      //     }


      $admin = AdminUsers::where(['role' => 1, 'account_status' => 1, 'centralized_decentralized_type' => 1])->get();
      foreach ($admin as $data) {
        $central_ids[] = $data->admin_user_id;
        // $mail->addAddress($data->email, 'Admin');
        if (count($all_mails) > 0 && in_array($data->email, $all_mails)) {
          //dont add email twise
        } else {
          $mail->addAddress($data->email, "'" . (isset($data->first_name) ? $data->first_name : '') . ' ' . (isset($data->last_name) ? $data->last_name : '') . "'");
          $all_mails[] = $data->email;
        }
      }


      $c_admin = AdminUsers::where(['role' => 1, 'account_status' => 1, 'company_id' => Auth::user()->company_id])->WhereNotIN('admin_user_id', $central_ids)->get();
      foreach ($c_admin as $data) {
        // $mail->addAddress($data->email, 'Admin');
        if (count($all_mails) > 0 && in_array($data->email, $all_mails)) {
          //dont add email twise
        } else {
          $mail->addAddress($data->email, "'" . (isset($data->first_name) ? $data->first_name : '') . ' ' . (isset($data->last_name) ? $data->last_name : '') . "'");
          $all_mails[] = $data->email;
        }
      }
      $mail->Subject = $subject;
      $mail->Body = $body;
      //dd($mail);
      $mail->Send();
      // dd($all_mails,2);
      return 1;
    } catch (Exception $e) {
      // dd($e);
    }
  }
  // return 1;
}   //mail HElper END

//New Function for send maultple mails
//@Naresh D On May 26, 2023
//mail --change when live
if (!function_exists('mailCommunication_multple')) {
  function mailCommunication_multple($subject, $body, $cc_mail_ids, $to_whom)
  {

    $all_mails = array();

    try {
      $mail = new PHPMailer\PHPMailer(true);
      $mail->IsSMTP();
      // $mail->IsMail();
      $mail->CharSet = "utf-8"; // set charset to utf8
      //for local start
      //for local end
      //$mail->SMTPDebug  = 4;
      $mail->SMTPAuth = true; // authentication enabled
      $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
      $mail->Host = "smtp.gmail.com";
      //$mail->SMTPKeepAlive = true;
      $mail->SMTPAutoTLS = false;
      $mail->Port = 587; // port - 587/465
      $mail->Username = "ideaportal@jmbaxi.com";
      //   $mail->Password = "Zifq87GNHLz3B";
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

      //         $cc_mail_data = FacadesDB::table('cc_emails')->where(['assign_cc' => 1])->select('*')->get();
      //         foreach ($cc_mail_data as $data) {
      //           $mail->addCC($data->cc_mail, 'Owner');
      //         }

      //         //whom to send
      //         // if (!empty($to_whom)) {
      //         //   $mail->addAddress($to_whom, 'User');
      //         // }

      //         if(isset($to_whom) && count($to_whom) > 0){
      //             foreach($to_whom as $to_send){
      //                 $mail->addAddress($to_send, 'User');
      //             }
      //         }

      //         $central_ids = array();
      //         $admin = AdminUsers::where(['role' => 1, 'account_status' => 1,'centralized_decentralized_type'=>1])->get();
      //         foreach ($admin as $data) {
      //             $central_ids[] = $data->admin_user_id;
      //             $mail->addAddress($data->email, 'Admin');

      //           }

      //           $c_admin = AdminUsers::where(['role' => 1, 'account_status' => 1, 'company_id'=>Auth::user()->company_id])->WhereNotIN('admin_user_id',$central_ids)->get();
      //         foreach ($c_admin as $data) {
      //             $mail->addAddress($data->email, 'Admin');
      //           }

      //    $cc_mail_data = FacadesDB::table('cc_emails')->where(['assign_cc' => 1])->select('*')->get();
      //         foreach ($cc_mail_data as $data) {
      //             $cc_admin_user = AdminUsers::where('admin_user_id', $data->admin_user_id)->first();
      //             if ($cc_admin_user) {
      //                 $mail->addCC($cc_admin_user->email, "(" . (isset($cc_admin_user->first_name) ? $cc_admin_user->first_name : '') . ' ' . (isset($cc_admin_user->last_name) ? $cc_admin_user->last_name : '')."'");
      //             }
      //             // $mail->addCC($data->cc_mail, 'Owner');
      //         }

      if (isset($cc_mail_ids) && count($cc_mail_ids) > 0) {

        foreach ($cc_mail_ids as $data) {
          $mail->addCC($data, 'Owner');
          $all_mails[] = $data;
        }
      }

      //whom to send
      // if (!empty($to_whom)) {
      //   $mail->addAddress($to_whom, 'User');
      // }

      if (isset($to_whom) && count($to_whom) > 0) {
        foreach ($to_whom as $to_send) {
          $idea_creator = User::where('email', $to_send)->first();
          if ($idea_creator) {
            if (count($all_mails) > 0 && !in_array($idea_creator->email, $all_mails)) {
              $mail->addAddress($idea_creator->email, "'" . (isset($idea_creator->name) ? $idea_creator->name : '') . ' ' . (isset($idea_creator->last_name) ? $idea_creator->last_name : '') . "'");
              $all_mails[] = $idea_creator->email;
            }
          }
          // $mail->addAddress($to_send, 'User');
        }
      }

      $central_ids = array();
      $admin = AdminUsers::where(['role' => 1, 'account_status' => 1, 'centralized_decentralized_type' => 1])->get();
      foreach ($admin as $data) {
        $central_ids[] = $data->admin_user_id;
        if (count($all_mails) > 0 && !in_array($data->email, $all_mails)) {
          $mail->addAddress($data->email, "'" . (isset($data->first_name) ? $data->first_name : '') . ' ' . (isset($data->last_name) ? $data->last_name : '') . "'");
          $all_mails[] = $data->email;
        }
        // $mail->addAddress($data->email, 'Admin');
      }

      $c_admin = AdminUsers::where(['role' => 1, 'account_status' => 1, 'company_id' => Auth::user()->company_id])->WhereNotIN('admin_user_id', $central_ids)->get();
      foreach ($c_admin as $data) {
        if (count($all_mails) > 0 && !in_array($data->email, $all_mails)) {
          $mail->addAddress($data->email, "'" . (isset($data->first_name) ? $data->first_name : '') . ' ' . (isset($data->last_name) ? $data->last_name : '') . "'");
          $all_mails[] = $data->email;
        }
        // $mail->addAddress($data->email, 'Admin');
      }

      // dd($all_mails);

      $mail->Subject = $subject;
      $mail->Body = $body;
      //dd($mail);
      $mail->Send();


      return 1;
    } catch (Exception $e) {
      //   dd($e);
    }
  }
  // return 1;
}   //mail HElper END

if (!function_exists('send_backned_notification')) {
  function send_backned_notification($idea_uni_id, $title, $description, $user_id)
  {
    $data = AdminUsers::get();
    // dd($data->toArray());
    foreach ($data as $row) {
      $notification = new AdminNotification();
      $notification->user_id = $user_id;
      $notification->idea_uni_id = $idea_uni_id;
      $notification->title = $title;
      $notification->description = $description;
      $notification->receiver_id = $row->admin_user_id;
      $notification->save();
    }
  }
}

if (!function_exists('send_frontend_notification')) {
  function send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role)
  {
    $notification = new Notification();
    $notification->idea_uni_id = $idea_uni_id;
    $notification->title = $title;
    $notification->description = $description;
    $notification->receiver_id = $receiver_id;
    $notification->role = $role;
    $notification->save();
  }
}


if (!function_exists('restriction_filesize')) {
  function restriction_filesize($file,$ext =null)
  {
    $allowed = 1;
    $maxFileSize = 50 * 1024 * 1024; // Convert MB to KB

    $allowedExtensionsString = "jpg,jpeg,png,gif,bmp,tiff,webp,mp3,wav,ogg,flac,aac,mp4,avi,mkv,mov,flv,wmv,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar";
    $extensions = explode(',', $allowedExtensionsString);

    if ($file instanceof \Illuminate\Http\UploadedFile || $ext == null) {

      if ($file->getSize() > $maxFileSize) {
        $allowed = 0;
         redirect()->back()->with('error', 'File size exceeds 50 MB.');
      }

      $fileExtension = $file->getClientOriginalExtension();
      // Check if the extension is in the allowed list
      if (!in_array($fileExtension, $extensions)) {
        $allowed = 0;
         redirect()->back()->with('error', 'File extension not allowed.');
      }

      $index = array_search($fileExtension, $extensions);

      //check file size limit
      $file_size_limit = Filesetting::where('allowed_extetnsion', $index)->first();
      if (!empty($file_size_limit)) {
        $allowed_size = $file_size_limit->file_size;

        $maxFileSize_allowed = $allowed_size * 1024 * 1024; // Convert MB to KB
        if ($file->getSize() > $maxFileSize_allowed) {
          $allowed = 0;
           redirect()->back()->with('error', 'File size limit exceeds. ');
        }
      }
    } elseif (is_string($file)) {

      if (strlen($file) > $maxFileSize) {
        $allowed = 0;
         redirect()->back()->with('error', 'File size exceeds 50 MB.');
      }
      // $base64Data = explode(',', $file);
      // $fileInfo = finfo_open();
      // $mimeType = finfo_buffer($fileInfo, base64_decode($base64Data[1]), FILEINFO_MIME_TYPE);
      // finfo_close($fileInfo);
      $fileExtension =$ext;

      // dd($fileExtension);
      if (!in_array($fileExtension, $extensions)) {
        $allowed = 0;
         redirect()->back()->with('error', 'File extension not allowed.');
      }

      $index = array_search("mp4", $extensions);

      //check file size limit
      $file_size_limit = Filesetting::where('allowed_extetnsion', $index)->first();
      if (!empty($file_size_limit)) {
        $allowed_size = $file_size_limit->file_size;

        $maxFileSize_allowed = $allowed_size * 1024 * 1024; // Convert MB to KB
        if (strlen($file) > $maxFileSize_allowed) {
          $allowed = 0;
           redirect()->back()->with('error', 'File size limit exceeds. ');
        }
      }
    }

    return $allowed;
  }
}
