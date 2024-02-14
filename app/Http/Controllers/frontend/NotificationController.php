<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Models\frontend\Ideas;
use App\Models\backend\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\frontend\Notification;
use App\Models\frontend\Users;
use App\Models\Rolesexternal;
use Illuminate\Support\Facades\DB;
use Session;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ajax_get_notifications(Request $request)
    {

        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        $notifications = Notification::where('role', $roles_external->role_type)->where('notification_read', '!=', 1)->orderBy('notification_id', 'desc')->get();
        //dd($notifications->toArray());
        $response["response"] = array();
        $response["notification_read_ids"] = array();
        $data = array();
        $notification_read_ids = array();
        $i = 0;
        foreach ($notifications as $notification) {
            // $notification_update = Notification::where('notification_id', $notification_id)->update(['notification_read' => 1]);
            if (Auth::user()->user_id == $notification->receiver_id) {
                $data['notification_id'] = $notification->notification_id;
                $idea = Ideas::where(['idea_uni_id' => $notification->idea_uni_id])->first();

                if ($idea) {
                    $data['idea_id'] = $idea->idea_id;
                } else {
                    $data['idea_id'] = '';
                }
                $data['notification_read'] = $notification->notification_read;
                $data['notification_title'] = $notification->title;
                $data['notification_description'] = $notification->description;
                if ($notification->notification_read == 0) {
                    $notification_read_ids[$i] = $notification->notification_id;
                }
            } else {
                continue;
            }
            array_push($response['response'], $data);
            $i++;
        }
        // dd($response);

        array_push($response["notification_read_ids"], $notification_read_ids);
        echo json_encode($response);
    }
    public function ajax_update_notification($notification_id, $idea_id)
    {
        session::put('main_page', url('/').'/user/notifications/show');
        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        $menus = [];
        if (!empty($roles_external)) {
            $menus = explode(',', $roles_external->menu_values);
        }



        $ideas = Ideas::where('idea_id', $idea_id)->where('user_id', '!=', Auth::id())->get();
        // dd($ideas);
        // dd($roles_external->role_type);
        if ($notification_id) {
            if (Notification::where('notification_id', $notification_id)->update(['notification_read' => '1'])) {
                if ($roles_external->role_type == 'Approving Authority') {
                    if ($ideas->isEmpty() &&  in_array('ideas_for_approval', $menus)) {
                        return redirect()->route('myideas.view_idea_approving_authority', ['id' => $idea_id]);
                    } else {
                        return redirect()->route('ideas.view_idea_approving_authority', ['id' => $idea_id]);
                    }
                } elseif ($roles_external->role_type == 'Implementation') {
                    if ($ideas->isEmpty() &&  in_array('ideas_for_approval', $menus)) {
                        return redirect()->route('myideas.view_idea_implementation_team', ['id' => $idea_id]);
                    } else {
                        return redirect()->route('ideas.view_idea_implementation_team', ['id' => $idea_id]);
                    }
                } else {
                    if ($ideas->isEmpty() &&  in_array('ideas_for_approval', $menus)) {
                        return redirect()->route('myideas.view', ['id' => $idea_id]);
                    } else {
                        return redirect()->route('ideas.view', ['id' => $idea_id]);
                    }
                }
            }
        }
    }

    public function ajax_clear_notification(Request $request)
    {

        if (isset($request->id)) {
            $notifications = Notification::where('receiver_id', $request->id)->where('notification_read','!=',1)->where('role',$request->user_role)->update(['notification_read' => 1]);
              return  true;
        }
    }

    public function show_all_notification(){
		$user_id = Auth::user()->user_id;
        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        $notifications = Notification::with('notification_ideas')->where('role', $roles_external->role_type)->orderBy('notification_id', 'desc')->where('receiver_id',$user_id)->get();
        return view('frontend.notifications.index', compact('notifications'));
    }
}   // end of class
