<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\frontend\Ideas;
use App\Models\frontend\Users;
use App\Models\backend\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\backend\AdminNotification;
use App\Models\backend\AdminUsers;

class AdminNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ajax_get_notifications(Request $request)
    {
        $admin_id = Auth::id();
        $data_admin = AdminUsers::where(['admin_user_id' => $admin_id, 'account_status' => 1, 'centralized_decentralized_type' => 2])->first();
        if (!empty($data_admin)) {
            $user_data = Users::where(['active_status' => 1, 'company_id' => $data_admin->company_id])->pluck('user_id');
            $notifications = AdminNotification::whereIn('user_id', $user_data)->where('notification_read','!=',1)->orderBy('notification_id', 'desc')->get();
        } else {
            $notifications = AdminNotification::where('notification_read','!=',1)->orderBy('notification_id', 'desc')->get();
        }
        $response["response"] = array();
        $response["notification_read_ids"] = array();
        $data = array();
        $notification_read_ids = array();
        // dd($notifications);
        // dd(Auth()->guard('admin')->user()->admin_user_id);
        $i = 0;
        foreach ($notifications as $notification) {
            // $notification_update = Notification::where('notification_id', $notification_id)->update(['notification_read' => 1]);
            if (Auth()->guard('admin')->user()->admin_user_id ==  $notification->receiver_id) {
                $data['notification_id'] = $notification->notification_id;

                // $user_aa = Users::where('user_id', Auth::id())->first();
                // $id_name_flag = '';
                // dump(isset($notification->user_id));
                $notification_data = '';
                // if (isset($notification->user_id)) {
                //     // dump($notification->user_id);
                //     $id_flag = 'user_id';
                //     $notification_data = Users::where('user_id', $notification->user_id)->first();
                // } else {
                    // dump($notification->idea_id);
                    //$id_flag = 'idea_id';
                    $notification_data = Ideas::where('idea_uni_id', $notification->idea_uni_id)->first();
                // }
                // dump($notification_data->toArray());
                if ($notification_data) {
                    $data['status'] = 'success';
                    // if ($id_flag == 'user_id') {
                    //     $data['notification_id'] = $notification->notification_id;
                    //     $data['notification_for'] = 'user_id';
                    //     $data['user_id'] = $notification_data->user_id;
                    //     $data['idea_id'] = '';
                    // } else {
                        $data['notification_id'] = $notification->notification_id;
                        $data['notification_for'] = 'idea_id';
                        $data['idea_id'] = $notification_data->idea_id;
                        $data['user_id'] = '';
                    // }
                    $data['notification_read'] = $notification->notification_read;
                    $data['notification_title'] = $notification->title;
                    $data['notification_description'] = $notification->description;
                    if ($notification->notification_read == 0) {
                        $notification_read_ids[$i] = $notification->notification_id;
                    }
                } else {
                    $data['status'] = 'failed';
                }
            } else {
                continue;
            }
            array_push($response['response'], $data);
            $i++;
        }

        array_push($response["notification_read_ids"], $notification_read_ids);
        // dd($response["notification_read_ids"]);
        // dd($data);
        echo json_encode($response);
    }
    public function ajax_update_notification($notification_id, $idea_id)
    {
        if ($notification_id) {
            if (AdminNotification::where('notification_id', $notification_id)->update(['notification_read' => '1'])) {
                // if (Auth::user()->role == 'Approving Authority') {
                //     return redirect()->route('ideas.view_idea_approving_authority', ['id' => $idea_id]);
                // } elseif (Auth::user()->role == 'Implementation') {
                //     return redirect()->route('ideas.view_idea_implementation_team', ['id' => $idea_id]);
                // } else {
                return redirect()->route('admin.ideaView', ['id' => $idea_id]);
                // }
            }
        }
    }

    public function ajax_clear_notification(Request $request)
    {
        if (isset($request->id)) {
            $notifications = AdminNotification::where('receiver_id', $request->id)->where('notification_read','!=',1)->update(['notification_read' => 1]);
            return  true;
        }
    }

    public function show_all_notification(){
        $admin_id = Auth::id();
        $data_admin = AdminUsers::where(['admin_user_id' => $admin_id, 'account_status' => 1, 'centralized_decentralized_type' => 2])->first();
        if (!empty($data_admin)) {
            $user_data = Users::where(['active_status' => 1, 'company_id' => $data_admin->company_id])->pluck('user_id');
            $notifications = AdminNotification::with('notification_ideas')->whereIn('user_id', $user_data)->orderBy('notification_id', 'desc')->get();
        } else {
            $notifications = AdminNotification::with('notification_ideas')->orderBy('notification_id', 'desc')->get();
        }
        return view('backend.notifications.all_notification', compact('notifications'));
    }
}//end of class
