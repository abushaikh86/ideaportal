<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Models\backend\Category;
use App\Http\Controllers\Controller;
use App\Models\frontend\Ideas;
use App\Models\Rolesexternal;
use Illuminate\Support\Facades\Auth;

class RewardsController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('common');
    }
    public function index()
    {

        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        // $user_role = Auth::user()->role;
        $user_role = $roles_external->role_type;
        // dd($user_role);
        // dd($user_role);
       // dd(Auth::user()->role);
        ///if (Auth::user()->role == 'user') {
        //    if(isset($user_role ) && $user_role == 'User'){
        //    $ideas = Ideas::where('certificate', 1)->where('implemented', 1)->where('active_status', 'implemented')->where('user_id', Auth::user()->user_id)->orderBy('idea_id', 'DESC')->get();
        //    return view('frontend.rewards.index', compact('ideas'));
        //} else {
        //    return redirect()->route('user.dashboard');
        //}
        $ideas = Ideas::where('certificate', 1)->where('implemented', 1)->where('active_status', 'implemented')->where('user_id', Auth::user()->user_id)->orderBy('idea_id', 'DESC')->get();
            return view('frontend.rewards.index', compact('ideas'));
    }
    public function view($id)
    {
        $idea = Ideas::where('idea_id', $id)->where('certificate', 1)->where('implemented', 1)->first();
        return view('frontend.rewards.view', compact('idea'));
    }
    public function approveCertificate($id)
    {
        $idea =  Ideas::where('idea_id', $id)->first();
        if (isset($idea)) {
            if ($idea->certificate != 1) {
                $idea->certificate = 1;
                if ($idea->save()) {
                    return redirect()->route('ideas.view_idea_implementation_team', ['id' => $id])->with('success', 'Idea certificate has been generated');
                } else {
                    return redirect()->route('ideas.view_idea_implementation_team', ['id' => $id])->with('error', 'Failed to generate the Idea Certificate');
                }
            }
        }
    }
}
