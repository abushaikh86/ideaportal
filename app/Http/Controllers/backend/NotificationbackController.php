<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Category;
use App\Models\frontend\Ideas;
use App\Http\Controllers\Controller;
use App\Models\backend\AdminUsers;
use App\Models\frontend\Notification;
use App\Models\frontend\Users;
use Illuminate\Support\Facades\Auth;

class NotificationbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ajax_get_notifications_backend(Request $request)
    {
        // dd('in notify backend');
        $admin_id = Auth::id();


        $admin_data = AdminUsers::where(['admin_user_id' => $admin_id])->first();
        if ($admin_data->centralized_decentralized_type == 1) {
            $notifications = Users::with('user_notifications')->has('user_notifications')->get();
            // dd($notifications->toArray());
        } else {
            $notifications = Users::where('company_id', Auth::user()->company_id)->with('ideas')->with('user_notifications')->has('ideas')->has('user_notifications')->get();
        }





        // $notifications = Notification::orderBy('notification_id', 'desc')->get();
        $response["response"] = array();
        $response["notification_read_ids"] = array();
        $data = array();
        $notification_read_ids = array();
        // dd($notifications);
        $i = 0;
        foreach ($notifications as $notification) {


            // dd($notifications->user_notifications->toArray());
            // $notification_update = Notification::where('notification_id', $notification_id)->update(['notification_read' => 1]);
           $j=0;
            if ($notification->user_id == $notification->user_notifications[$j]->receiver_id) {
                $data['notification_id'] = $notification->user_notifications[$j]->notification_id;
                $idea = Ideas::where('idea_uni_id', $notification->user_notifications[$j]->idea_uni_id)->first();
                if ($idea) {
                    $data['idea_id'] = $idea->idea_id;
                } else {
                    $data['idea_id'] = '';
                }
                $data['notification_read'] = $notification->user_notifications[$j]->notification_read;
                $data['notification_title'] = $notification->user_notifications[$j]->title;
                $data['notification_description'] = $notification->user_notifications[$j]->description;
                if ($notification->user_notifications[$j]->notification_read == 0) {
                    $notification_read_ids[$i] = $notification->user_notifications[$j]->notification_id;
                }
                $j++;
            } else {
                continue;
            }
            array_push($response['response'], $data);
            $i++;
        }

        array_push($response["notification_read_ids"], $notification_read_ids);
        // dd($data);
        // dd($response["notification_read_ids"]);
        // dd($response);
        echo json_encode($response);
    }
    public function ajax_update_notification_backend($notification_id, $idea_id)
    {
        if ($notification_id) {
            if (Notification::where('notification_id', $notification_id)->update(['notification_read' => '1'])) {
                if (Auth::user()->role == 'Approving Authority') {
                    return redirect()->route('ideas.view_idea_approving_authority', ['id' => $idea_id]);
                } elseif (Auth::user()->role == 'Implementation') {
                    return redirect()->route('ideas.view_idea_implementation_team', ['id' => $idea_id]);
                } else {
                    return redirect()->route('ideas.view', ['id' => $idea_id]);
                }
            }
        }
    }
}
