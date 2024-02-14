<?php

namespace App\Http\Controllers\frontend;

use PHPMailer\PHPMailer;
use Illuminate\Http\Request;
use App\Models\frontend\Ideas;
use Illuminate\Support\Facades\DB;
use App\Models\frontend\Users;
use App\Models\frontend\Feedback;
use App\Models\frontend\IdeaImages;
use App\Models\frontend\IdeaRevisionImages;
use App\Models\frontend\IdeaStatus;
use App\Http\Controllers\Controller;
use App\Models\backend\AdminUsers;
use App\Models\frontend\EmailConfig;
use Illuminate\Support\Facades\Auth;
use App\Models\frontend\IdeaRevision;
use Illuminate\Support\Facades\Storage;
use App\Models\frontend\IdeaActiveStatus;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Models\frontend\Notification;
use App\Models\backend\AdminNotification;
use App\Models\backend\IdeaBenifits;
use App\Models\frontend\IdeaJourney;
use App\Models\backend\Filesetting;
use App\Models\backend\Company;
use App\Models\backend\Category;
use App\Models\backend\SLA;




use App\Models\Rolesexternal;
use Exception;
use phpmailerException;
use Session;

class IdeaController extends Controller
{
    public function __construct()
    {

        //$this->middleware('auth');
        $this->middleware('auth', ['except' => ['ajax_get_images_modal']]);
        $this->middleware('common', ['except' => ['ajax_get_images_modal']]);
    }
    public function dashboard()
    {


        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        // $user_role = Auth::user()->role;
        $user_role = $roles_external->role_type;



        $response = array();
        $data = array();
        $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
        foreach ($months as $key => $month) {
            if ($user_role == 'User') {
                $ideas = Ideas::whereMonth('created_at', $key)->whereYear('created_at', date('Y'))->where('user_id', Auth::user()->user_id)->get();
                $data['x'] = $month;
                $data['y'] = count($ideas);
            } elseif ($user_role == 'Assessment Team') {
                $ideas = Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id);
                })->whereMonth('created_at', $key)->get();
                $data['x'] = $month;
                $data['y'] = count($ideas);
            } elseif ($user_role == 'Approving Authority') {
                $ideas = Ideas::whereMonth('created_at', $key)->get();
                $data['x'] = $month;
                $data['y'] = count($ideas);
            } elseif ($user_role == 'Implementation') {
                $ideas = Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id);
                })->whereMonth('created_at', $key)->get();
                $data['x'] = $month;
                $data['y'] = count($ideas);
            }
            array_push($response, $data);
        }

        // $response = json_encode($response,JSON_FORCE_OBJECT);

        $total_ideas = '';
        $approved_ideas = '';
        $under_approving = '';
        $revise_request = '';
        $implementation = '';
        $rejected = '';
        $under_assessment = '';
        $on_hold = '';
        $pending = '';
        $implemented = '';

        // if want to hide count
        // $menus = [];
        // $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role])->first();
        // if (!empty($roles_external)) {
        //     $menus = explode(',', $roles_external->menu_values);
        // }
        // if (in_array('my_ideas', $menus)) {
        if ($user_role == 'User') {
            $total_ideas = count(Ideas::where('user_id', Auth::user()->user_id)->get());
            $approved_ideas = count(Ideas::where('approving_authority_approval', 1)
                ->where('active_status', 'implementation')
                ->where('implemented', 0)
                ->where('user_id', Auth::user()->user_id)
                ->get());
            //dd($approved_ideas,Auth::user()->user_id);
            $under_approving = count(Ideas::where('active_status', 'under_approving_authority')->where('user_id', Auth::user()->user_id)->get());
            //$revise_request = count(Ideas::where('active_status', 'resubmit')->where('user_id', Auth::user()->user_id)->get());
            $revise_request = count(Ideas::where('active_status', 'resubmit')->where('asstmnt_rev_status', 1)->where('user_id', Auth::user()->user_id)->get());

            $implementation = count(Ideas::where('active_status', 'implementation')->where('user_id', Auth::user()->user_id)->get());
            $rejected = count(Ideas::where('rejected', 1)->where('active_status', 'reject')->where('user_id', Auth::user()->user_id)->get());
            $under_assessment = count(Ideas::where('active_status', 'in_assessment')->where('assessment_team_approval', '!=', 1)->where('user_id', Auth::user()->user_id)->get());
            $on_hold = count(Ideas::where('active_status', 'on_hold')->where('user_id', Auth::user()->user_id)->get());
            $pending = count(Ideas::where('active_status', 'pending')->where('user_id', Auth::user()->user_id)->get());
            $implemented = count(Ideas::where('active_status', 'implemented')->where('user_id', Auth::user()->user_id)->get());
        } elseif ($user_role == 'Assessment Team') {

            $total_ideas = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
            })->get());
            $approved_ideas = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
            })->where('approving_authority_approval', 1)
                ->where('active_status', 'implementation')
                ->where('implemented', 0)
                ->get());
            $under_approving = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
            })->where('active_status', 'under_approving_authority')->get());
            $revise_request = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
            })->where(['active_status' => 'resubmit'])->get());
            //   dd($revise_request);
            //   $ideas = Ideas::whereHas('user', function ($q) {
            //     $q->where('company_id', '=', Auth::user()->company_id);
            // })->where('active_status', $filter)->where('user_id', '!=', Auth::user()->user_id)->orderBy('ideas.idea_id', 'DESC')->get();
            $implementation = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
            })->where('active_status', 'implementation')->get());
            $rejected = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
            })->where('rejected', 1)->where('active_status', 'reject')->get());
            $under_assessment = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
            })->where('active_status', 'in_assessment')->where('assessment_team_approval', '!=', 1)->get());
            // dd(Auth::user()->user_id);
            // dd($under_assessment->toArray());
            $on_hold = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
            })->where('active_status', 'on_hold')->get());
            $pending = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
            })->where('active_status', 'pending')->get());
            $implemented = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
            })->where('active_status', 'implemented')->get());

            // for my ideas

            $total_ideas1 = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
            })->get());
            $approved_ideas1 = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
            })->where('active_status', 'implementation')
                ->where('implemented', 0)
                ->where('approving_authority_approval', 1)->get());
            // dd($approved_ideas1);
            $under_approving1 = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
            })->where('active_status', 'under_approving_authority')->get());
            $revise_request1 = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
            })->where(['active_status' => 'resubmit', 'asstmnt_rev_status' => 1])->get());
            //    dd($revise_request->toArray());

            $implementation1 = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
            })->where('active_status', 'implementation')->get());
            $rejected1 = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
            })->where('rejected', 1)->where('active_status', 'reject')->get());
            $under_assessment1 = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
            })->where('active_status', 'in_assessment')->where('assessment_team_approval', '!=', 1)->where('user_id', '=', Auth::user()->user_id)->get());
            $on_hold1 = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
            })->where('active_status', 'on_hold')->get());
            $pending1 = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
            })->where('active_status', 'pending')->get());
            $implemented1 = count(Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
            })->where('active_status', 'implemented')->get());
        } elseif ($user_role == 'Approving Authority') {
            if (Auth::user()->centralized_decentralized_type == 1 || Auth::user()->centralized_decentralized_type == '') {

                $total_ideas = count(Ideas::where('user_id', '!=', Auth::user()->user_id)->where('assessment_team_approval', 1)->whereNotIN('active_status', ['reject', 'resubmit'])->get());

                $approved_ideas = count(Ideas::where('approving_authority_approval', 1)->where('user_id', '!=', Auth::user()->user_id)->where('assessment_team_approval', 1)->get());

                $under_approving = count(
                    Ideas::where('active_status', 'under_approving_authority')
                        ->where('user_id', '!=', Auth::user()->user_id)
                        ->where('assessment_team_approval', 1)
                        ->where('active_status', 'implementation')
                        ->where('implemented', 0)
                        ->get()
                );

                $revise_request = count(Ideas::where('active_status', 'resubmit')->where('user_id', '!=', Auth::user()->user_id)->where('assessment_team_approval', 1)->get());
                $implementation = count(Ideas::where('active_status', 'implementation')->where('user_id', '!=', Auth::user()->user_id)->where('assessment_team_approval', 1)->get());
                $rejected = count(Ideas::where('rejected', 1)->where(['active_status' => 'reject'])->where('user_id', '!=', Auth::user()->user_id)->where('assessment_team_approval', 1)->get());
                $under_assessment = count(Ideas::where('active_status', 'in_assessment')->where('user_id', '!=', Auth::user()->user_id)->where('assessment_team_approval', '!=', 1)->get());
                $on_hold = count(Ideas::where('active_status', 'on_hold')->where('user_id', '!=', Auth::user()->user_id)->where('assessment_team_approval', 1)->get());
                $pending = count(Ideas::where('active_status', 'pending')->where('user_id', '!=', Auth::user()->user_id)->where('assessment_team_approval', 1)->get());
                $implemented = count(Ideas::where('active_status', 'implemented')->where('user_id', '!=', Auth::user()->user_id)->where('assessment_team_approval', 1)->get());

                $total_ideas1 = count(Ideas::where('user_id', '=', Auth::user()->user_id)->get());
                $approved_ideas1 = count(
                    Ideas::where('approving_authority_approval', 1)
                        ->where('user_id', '=', Auth::user()->user_id)
                        ->where('active_status', 'implementation')
                        ->where('implemented', 0)
                        ->get()
                );
                $under_approving1 = count(Ideas::where('active_status', 'under_approving_authority')->where('user_id', '=', Auth::user()->user_id)->get());
                $revise_request1 = count(Ideas::where('active_status', 'resubmit')->where('user_id', '=', Auth::user()->user_id)->get());
                $implementation1 = count(Ideas::where('active_status', 'implementation')->where('user_id', '=', Auth::user()->user_id)->get());
                $rejected1 = count(Ideas::where('rejected', 1)->where(['active_status' => 'reject'])->where('user_id', '=', Auth::user()->user_id)->get());
                $under_assessment1 = count(Ideas::where('active_status', 'in_assessment')->where('assessment_team_approval', '!=', 1)->where('user_id', '=', Auth::user()->user_id)->get());
                $on_hold1 = count(Ideas::where('active_status', 'on_hold')->where('user_id', '=', Auth::user()->user_id)->get());
                $pending1 = count(Ideas::where('active_status', 'pending')->where('user_id', '=', Auth::user()->user_id)->get());
                $implemented1 = count(Ideas::where('active_status', 'implemented')->where('user_id', '=', Auth::user()->user_id)->get());
            } else {
                //for ideas
                $total_ideas = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('assessment_team_approval', 1)
                        ->where('user_id', '!=', Auth::user()->user_id);
                })->whereNotIN('active_status', ['reject', 'resubmit'])->get());

                $approved_ideas = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where('approving_authority_approval', 1)
                    ->where('assessment_team_approval', 1)
                    ->where('active_status', 'implementation')
                    ->where('implemented', 0)
                    ->get());


                $under_approving = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where('active_status', 'under_approving_authority')->where('assessment_team_approval', 1)->get());
                $revise_request = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where(['active_status' => 'resubmit'])->where('assessment_team_approval', 1)->get());
                $implementation = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where('active_status', 'implementation')->where('assessment_team_approval', 1)->get());
                $rejected = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where('rejected', 1)->where(['active_status' => 'reject'])->where('assessment_team_approval', 1)->get());
                // dd(Auth::user()->user_id);
                $under_assessment = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where('active_status', 'in_assessment')->where('assessment_team_approval', 1)->get());
                // dd($under_assessment->toArray());
                $on_hold = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where('active_status', 'on_hold')->where('assessment_team_approval', 1)->get());
                $pending = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where('active_status', 'pending')->where('assessment_team_approval', 1)->get());
                $implemented = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where('active_status', 'implemented')->where('assessment_team_approval', 1)->get());

                // for my ideas
                $total_ideas1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)
                        ->where('user_id', '=', Auth::user()->user_id);
                })->get());


                $approved_ideas1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('approving_authority_approval', 1)
                    ->where('active_status', 'implementation')
                    ->where('implemented', 0)
                    ->get());


                $under_approving1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('active_status', 'under_approving_authority')->get());
                $revise_request1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where(['active_status' => 'resubmit'])->get());
                $implementation1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('active_status', 'implementation')->get());
                $rejected1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('rejected', 1)->where(['active_status' => 'reject'])->get());
                $under_assessment1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('active_status', 'in_assessment')->get());
                // dd($under_assessment->toArray());
                $on_hold1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('active_status', 'on_hold')->get());
                $pending1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('active_status', 'pending')->get());
                $implemented1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('active_status', 'implemented')->get());
            }
        } elseif ($user_role == 'Implementation') {

            if (Auth::user()->centralized_decentralized_type == 1 || Auth::user()->centralized_decentralized_type == '') {
                // for ideas
                $total_ideas = count(Ideas::where('approving_authority_approval', 1)->get());
                //    dd($total_ideas->toArray());
                $approved_ideas = count(Ideas::where('approving_authority_approval', 1)->where('active_status', 'implementation')
                    ->where('implemented', 0)->get());
                $under_approving = count(Ideas::where(['active_status' => 'under_approving_authority'])->where('approving_authority_approval', 1)->get());
                $revise_request = count(Ideas::where(['active_status' => 'resubmit'])->where('approving_authority_approval', 1)->get());
                // dd($revise_request->toArray());
                $implementation = count(Ideas::where('active_status', 'implementation')->where('approving_authority_approval', 1)->get());
                $rejected = count(Ideas::where(['rejected' => 1])->where('active_status', 'reject')->where('approving_authority_approval', 1)->get());
                // dd($rejected);
                $under_assessment = count(Ideas::where(['active_status' => 'in_assessment'])->where('assessment_team_approval', '!=', 1)->get());
                $on_hold = count(Ideas::where('active_status', 'on_hold')->where('approving_authority_approval', 1)->get());
                $pending = count(Ideas::where('active_status', 'pending')->where('approving_authority_approval', 1)->get());
                $implemented = count(Ideas::where('active_status', 'implemented')->where('approving_authority_approval', 1)->get());
                // dd($implemented);

                // for my ideas
                $total_ideas1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->get());
                //    dd($total_ideas);
                $approved_ideas1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })
                    ->where('approving_authority_approval', 1)
                    ->where('active_status', 'implementation')
                    ->where('implemented', 0)
                    ->get());
                $under_approving1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where(['active_status' => 'in_assessment'])->where('assessment_team_approval', '!=', 1)->get());
                $revise_request1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where(['active_status' => 'resubmit'])->get());
                // dd($revise_request->toArray());
                $implementation1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('active_status', 'implementation')->get());
                $rejected1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where(['rejected' => 1])->where('active_status', 'reject')->get());
                $under_assessment1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where(['active_status' => 'in_assessment'])->where('assessment_team_approval', '!=', 1)->get());
                $on_hold1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('active_status', 'on_hold')->get());
                $pending1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('active_status', 'pending')->get());
                $implemented1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('active_status', 'implemented')->get());

                //-----------------------
            } else {
                // for ideas
                $total_ideas = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where('approving_authority_approval', 1)->get());
                //    dd($total_ideas->toArray());
                $approved_ideas = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })
                    ->where('approving_authority_approval', 1)
                    ->where('active_status', 'implementation')
                    ->where('implemented', 0)
                    ->get());
                $under_approving = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where(['active_status' => 'under_approving_authority'])->where('approving_authority_approval', 1)->get());
                $revise_request = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where(['active_status' => 'resubmit'])->where('approving_authority_approval', 1)->get());
                // dd($revise_request->toArray());
                $implementation = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where('active_status', 'implementation')->where('approving_authority_approval', 1)->get());
                $rejected = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where(['rejected' => 1])->where('active_status', 'reject')->where('approving_authority_approval', 1)->get());
                // dd($rejected);
                $under_assessment = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where(['active_status' => 'in_assessment'])->where('assessment_team_approval', '!=', 1)->get());
                $on_hold = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where('active_status', 'on_hold')->where('approving_authority_approval', 1)->get());
                $pending = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where('active_status', 'pending')->where('approving_authority_approval', 1)->get());
                $implemented = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                })->where('active_status', 'implemented')->where('approving_authority_approval', 1)->get());
                // dd($implemented);

                // for my ideas
                $total_ideas1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->get());
                //    dd($total_ideas);
                $approved_ideas1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('approving_authority_approval', 1)
                    ->where('active_status', 'implementation')
                    ->where('implemented', 0)
                    ->get());
                $under_approving1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where(['active_status' => 'under_approving_authority'])->get());
                $revise_request1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where(['active_status' => 'resubmit'])->get());
                // dd($revise_request->toArray());
                $implementation1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('active_status', 'implementation')->get());
                $rejected1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where(['rejected' => 1])->where('active_status', 'reject')->get());
                $under_assessment1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where(['active_status' => 'in_assessment'])->get());
                $on_hold1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('active_status', 'on_hold')->get());
                $pending1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('active_status', 'pending')->get());
                $implemented1 = count(Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->where('active_status', 'implemented')->get());
            }
        }
        // }
        if ($user_role != 'User') {
            return view('frontend.users.dashboard', compact('total_ideas', 'approved_ideas', 'under_approving', 'revise_request', 'implementation', 'rejected', 'under_assessment', 'on_hold', 'pending', 'implemented', 'total_ideas1', 'approved_ideas1', 'under_approving1', 'revise_request1', 'implementation1', 'rejected1', 'under_assessment1', 'on_hold1', 'pending1', 'implemented1', 'response'));
        } else {
            return view('frontend.users.dashboard', compact('total_ideas', 'approved_ideas', 'under_approving', 'revise_request', 'implementation', 'rejected', 'under_assessment', 'on_hold', 'pending', 'implemented', 'response'));
        }
    }

    public function redirect_from_dash($get_status)
    {
        $status = '';
        if ($get_status == 'under_asset') {
            $status =  'in_assessment';
        } else if ($get_status == 'under_approv') {
            $status = 'under_approving_authority';
        } else if ($get_status == 'implemented') {
            $status = 'implemented';
        } else if ($get_status == 'revise_req') {
            $status = 'resubmit';
        } else if ($get_status == 'approved_ideas') {
            $status = 'approved_ideas';
        } else if ($get_status == 'implementation') {
            $status = 'implementation';
        } else if ($get_status == 'rejected') {
            $status = 'reject';
        } else if ($get_status == 'all_ideas_approved') {
            $status = 'all_ideas_approved';
        }

        return $status;
    }
    public function index()
    {
        session::put('main_page', url()->full());
        $role = Auth::user()->role;
        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        // dd($roles_external->role_name);
        // dd($_GET);
        if (!empty($_GET)) {
            $filter = !empty($this->redirect_from_dash($_GET['st'])) ? $this->redirect_from_dash($_GET['st']) : '';
        }

        if ($roles_external->role_type == 'User' || $roles_external->role_type == 'user') {


            if (!empty($filter)) {
                if ($filter == 'approved_ideas') {
                    $ideas = Ideas::where('approving_authority_approval', 1)
                        ->where('implemented', 0)
                        ->where('user_id', Auth::user()->user_id)->get();
                } else if ($filter == 'resubmit') {
                    $ideas = Ideas::where(['user_id' => Auth::id(), 'active_status' => 'resubmit', 'asstmnt_rev_status' => 1])->orderBy('idea_id', 'DESC')->get();
                } else if ($filter == 'in_assessment') {
                    $ideas = Ideas::where(['user_id' => Auth::id(), 'active_status' => $filter])->where('assessment_team_approval', '!=', 1)->orderBy('idea_id', 'DESC')->get();
                } else if ($filter == 'all_ideas_approved') {
                    //dd($all_company_users->toArray());
                    //$ideas = Ideas::where('approving_authority_approval', '=', 1)->whereNull('failed_to_implement')->whereIn('user_id', $all_company_users)->orderBy('idea_id', 'DESC')->get();
                } else {

                    $ideas = Ideas::where(['user_id' => Auth::id(), 'active_status' => $filter])->orderBy('idea_id', 'DESC')->get();
                }
            } else {
                $ideas = Ideas::where('user_id', Auth::id())->orderBy('idea_id', 'DESC')->get();
            }

            return view('frontend.ideas.index', ['ideas' => $ideas]);
            // where('active_status', 'implementation')->orWhere('active_status', 'implemented')
        } elseif ($roles_external->role_type == 'Assessment Team') {

            $category_ids = Category::whereIn('category_name', explode(",", $roles_external->category_values))
                ->pluck('category_id')
                ->toArray();
            // dd($category_ids);


            if (!empty($filter)) {
                if ($filter == 'approved_ideas') {
                    $ideas = Ideas::whereHas('user', function ($q) {
                        $q->where('company_id', '=', Auth::user()->company_id);
                    })->where(function ($query) {
                        $query->where('active_status', 'implementation')
                            ->where('implemented', 0);
                    })->where('user_id', '!=', Auth::user()->user_id)->orderBy('ideas.idea_id', 'DESC')->get();
                } else if ($filter == 'in_assessment') {
                    $ideas = Ideas::whereHas('user', function ($q) {
                        $q->where('company_id', '=', Auth::user()->company_id);
                    })->where('active_status', 'in_assessment')->where('assessment_team_approval', '!=', 1)->where('user_id', '!=', Auth::user()->user_id)->orderBy('ideas.idea_id', 'DESC')->get();
                } else {
                    $ideas = Ideas::whereHas('user', function ($q) {
                        $q->where('company_id', '=', Auth::user()->company_id);
                    })->where('active_status', $filter)->where('user_id', '!=', Auth::user()->user_id)->orderBy('ideas.idea_id', 'DESC')->get();
                }
            } else {
                $ideas = Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id);
                })->where('user_id', '!=', Auth::user()->user_id)->orderBy('ideas.idea_id', 'DESC')->get();
            }
            if (!empty($category_ids)) {
                $ideas = Ideas::where('user_id', '!=', Auth::user()->user_id)->whereIn('category_id', $category_ids)->get();
                // dd($ideas->toArray());
            }
            return view('frontend.ideas.index', ['ideas' => $ideas]);
        } elseif ($roles_external->role_type == 'Approving Authority') {

            $category_ids = Category::whereIn('category_name', explode(",", $roles_external->category_values))
                ->pluck('category_id')
                ->toArray();

            // dd($roles_external);

            if (isset(Auth::user()->centralized_decentralized_type) && Auth::user()->centralized_decentralized_type == 1) {
                // dd(Auth::user()->user_id);
                if (!empty($filter)) {

                    if ($filter == 'approved_ideas') {

                        $ideas = Ideas::where(['approving_authority_approval' => 1])->where(function ($query) {
                            $query->where('active_status', 'implementation')->where('implemented', 0);
                        })->where('user_id', '!=', Auth::user()->user_id)->whereNotIN('active_status', ['reject', 'resubmit'])->orderBy('idea_id', 'DESC')->get();
                    } else if ($filter == 'resubmit') {
                        $ideas = Ideas::where(['assessment_team_approval' => 1, 'active_status' => $filter])->where('user_id', '!=', Auth::user()->user_id)->orderBy('idea_id', 'DESC')->get();
                    } else if ($filter == 'reject') {
                        $ideas = Ideas::where(['assessment_team_approval' => 1, 'active_status' => $filter])->where('active_status', 'reject')->where('user_id', '!=', Auth::user()->user_id)->orderBy('idea_id', 'DESC')->get();
                    } else if ($filter == 'in_assessment') {
                        $ideas = Ideas::whereHas('user', function ($q) {
                            $q->where('company_id', '=', Auth::user()->company_id);
                        })->where('active_status', 'in_assessment')->where('assessment_team_approval', '!=', 1)->where('user_id', '!=', Auth::user()->user_id)->orderBy('ideas.idea_id', 'DESC')->get();
                    } else if ($filter == 'under_approving_authority') {
                        $ideas = Ideas::whereHas('user', function ($q) {
                            $q->where('company_id', '=', Auth::user()->company_id);
                        })->where('active_status', 'under_approving_authority')->where('assessment_team_approval', '!=', 1)->where('user_id', '!=', Auth::user()->user_id)->orderBy('ideas.idea_id', 'DESC')->get();
                    } else {

                        $ideas = Ideas::where(['assessment_team_approval' => 1, 'active_status' => $filter])->whereNotIN('active_status', ['reject', 'resubmit'])->where('user_id', '!=', Auth::user()->user_id)->orderBy('idea_id', 'DESC')->get();
                    }
                } else {

                    $ideas = Ideas::where('assessment_team_approval', 1)->whereNotIN('active_status', ['reject', 'resubmit'])->orderBy('idea_id', 'DESC')->where('user_id', '!=', Auth::user()->user_id)->get();
                }
                // dd($ideas->toArray());

            } else {
                if (!empty($filter)) {
                    if ($filter == 'approved_ideas') {

                        $ideas = Ideas::whereHas('user', function ($q) {
                            $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                        })->where(['approving_authority_approval' => 1])->where(function ($query) {
                            $query->where('active_status', 'implementation')->orWhere('active_status', 'implemented');
                        })->orderBy('ideas.idea_id', 'DESC')->get();
                        //    dd($ideas->toArray());
                    } else if ($filter == 'reject') {
                        //    $ideas = Ideas::where(['assessment_team_approval' => 1, 'active_status' => $filter])->where('active_status', 'reject')->where('user_id', '!=', Auth::user()->user_id)->orderBy('idea_id', 'DESC')->get();
                        $ideas = Ideas::whereHas('user', function ($q) {
                            $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                        })->where('rejected', 1)->where(['active_status' => 'reject'])->where('assessment_team_approval', 1)->get();
                    } else if ($filter == 'in_assessment') {
                        $ideas = Ideas::whereHas('user', function ($q) {
                            $q->where('company_id', '=', Auth::user()->company_id);
                        })->where('active_status', 'in_assessment')->where('assessment_team_approval', '!=', 1)->where('user_id', '!=', Auth::user()->user_id)->orderBy('ideas.idea_id', 'DESC')->get();
                    } else if ($filter == 'under_approving_authority') {
                        $ideas = Ideas::whereHas('user', function ($q) {
                            $q->where('company_id', '=', Auth::user()->company_id);
                        })->where('active_status', 'under_approving_authority')->where('assessment_team_approval', '!=', 1)->where('user_id', '!=', Auth::user()->user_id)->orderBy('ideas.idea_id', 'DESC')->get();
                    } else {
                        $ideas = Ideas::whereHas('user', function ($q) {
                            $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                        })->where(['assessment_team_approval' => 1, 'active_status' => $filter])->orderBy('ideas.idea_id', 'DESC')->get();
                        //  })->where(['assessment_team_approval' => 1, 'active_status' => $filter])->whereNotIN('active_status',['reject','resubmit'])->orderBy('ideas.idea_id', 'DESC')->get();
                    }
                } else {

                    $ideas = Ideas::whereHas('user', function ($q) {
                        $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                    })->where('assessment_team_approval', 1)->whereNotIN('active_status', ['reject', 'resubmit'])->orderBy('ideas.idea_id', 'DESC')->get();
                }
            }
            if (!empty($category_ids)) {
                $ideas = Ideas::where('user_id', '!=', Auth::user()->user_id)->whereIn('category_id', $category_ids)->get();
            }
            return view('frontend.ideas.index', ['ideas' => $ideas]);
        } elseif ($roles_external->role_type == 'Implementation') {

            $category_ids = Category::whereIn('category_name', explode(",", $roles_external->category_values))
                ->pluck('category_id')
                ->toArray();


            if (Auth::user()->centralized_decentralized_type == '' || Auth::user()->centralized_decentralized_type == 1) {
                if (!empty($filter)) {
                    if ($filter == 'approved_ideas') {
                        $ideas = Ideas::where(['ideas.approving_authority_approval' => 1])->where(function ($query) {
                            $query->where('active_status', 'implementation')->where('implemented', 0);;
                        })->orderBy('ideas.idea_id', 'DESC')->get();
                    } else if ($filter == 'in_assessment') {
                        $ideas = Ideas::whereHas('user', function ($q) {
                            $q->where('company_id', '=', Auth::user()->company_id);
                        })->where('active_status', 'in_assessment')->where('assessment_team_approval', '!=', 1)->where('user_id', '!=', Auth::user()->user_id)->orderBy('ideas.idea_id', 'DESC')->get();
                    } else {
                        $ideas = Ideas::where(['ideas.approving_authority_approval' => 1, 'active_status' => $filter])->orderBy('ideas.idea_id', 'DESC')->get();
                    }
                } else {
                    $ideas = Ideas::where('ideas.approving_authority_approval', 1)->orderBy('ideas.idea_id', 'DESC')->get();
                    //    dd($ideas->toArray());
                }
            } else {
                if (!empty($filter)) {
                    if ($filter == 'approved_ideas') {
                        $ideas = Ideas::whereHas('user', function ($q) {
                            $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                        })->where(['ideas.approving_authority_approval' => 1])->where(function ($query) {
                            $query->where('active_status', 'implementation')->where('implemented', 0);
                        })->orderBy('ideas.idea_id', 'DESC')->get();
                    } else if ($filter == 'in_assessment') {
                        $ideas = Ideas::whereHas('user', function ($q) {
                            $q->where('company_id', '=', Auth::user()->company_id);
                        })->where('active_status', 'in_assessment')->where('assessment_team_approval', '!=', 1)->where('user_id', '!=', Auth::user()->user_id)->orderBy('ideas.idea_id', 'DESC')->get();
                    } else {
                        $ideas = Ideas::whereHas('user', function ($q) {
                            $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                        })->where(['ideas.approving_authority_approval' => 1, 'active_status' => $filter])->orderBy('ideas.idea_id', 'DESC')->get();
                    }
                } else {
                    $ideas = Ideas::whereHas('user', function ($q) {
                        $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '!=', Auth::user()->user_id);
                    })->where('ideas.approving_authority_approval', 1)->orderBy('ideas.idea_id', 'DESC')->get();
                    //    dd($ideas->toArray());
                }
            }

            if (!empty($category_ids)) {
                $ideas = Ideas::where('user_id', '!=', Auth::user()->user_id)->whereIn('category_id', $category_ids)->get();
            }

            return view('frontend.ideas.index', ['ideas' => $ideas]);
        }
    }

    public function show_all_ideas()
    {
        $role = Auth::user()->role;
        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        //for get all ideas from
        $current_user_company = (isset(Auth::user()->company_id)) ? Auth::user()->company_id : 0;
        $all_company_users = Users::where('company_id', $current_user_company)->get('user_id');
        // dd($role, $roles_external->toArray());
        if (isset($roles_external->role_type) && in_array($roles_external->role_type, ['Approving Authority', 'Implementation'])) {
            $query = Ideas::where('approving_authority_approval', '=', 1)->whereNull('failed_to_implement');
            if (Auth::user()->centralized_decentralized_type == '' || Auth::user()->centralized_decentralized_type != 1) {
                $query->whereIn('user_id', $all_company_users);
            }
            $ideas = $query->get();
        } else {
            $ideas = Ideas::where('approving_authority_approval', '=', 1)->whereNull('failed_to_implement')->whereIn('user_id', $all_company_users)->orderBy('idea_id', 'DESC')->get();
        }

        return view('frontend.ideas.show_all_ideas', compact('ideas'));
    }

    public function myideas()
    {

        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();

        if ($roles_external->role_name == 'Assessment Team') {
            $ideas = Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', Auth::id());
            })->orderBy('ideas.idea_id', 'DESC')->get();

            return view('frontend.ideas.index_my_ideas', ['ideas' => $ideas]);
        } elseif ($roles_external->role_name == 'Approving Authority') {

            if (Auth::user()->centralized_decentralized_type == '' || Auth::user()->centralized_decentralized_type == 1) {
                $ideas = Ideas::where(['user_id' => Auth::id()])->orderBy('idea_id', 'DESC')->get();
                // dd($ideas->toArray());
            } else {
                $ideas = Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', Auth::id());
                })->where(['assessment_team_approval' => 1])->orderBy('ideas.idea_id', 'DESC')->get();
            }
            return view('frontend.ideas.index_my_ideas', ['ideas' => $ideas]);
        } elseif ($roles_external->role_name == 'Implementation') {

            $ideas = Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', Auth::id());
            })->orderBy('ideas.idea_id', 'DESC')->get();
            return view('frontend.ideas.index_my_ideas', ['ideas' => $ideas]);
        }
    }

    public function addIdea()
    {
        $benifits = IdeaBenifits::pluck('idea_benifit', 'idea_benifit');
        $extensions = Filesetting::get();

        $allowedExtensionsString = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'webp', 'mp3', 'wav', 'ogg', 'flac', 'aac', 'mp4', 'avi', 'mkv', 'mov', 'flv', 'wmv', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'zip', 'rar'];
        $all_extensions = array();
        $all_extensions_and_limit = array();
        if (isset($extensions)  && count($extensions) > 0) {
            foreach ($extensions as $key => $ext) {
                $all_extensions[] = $allowedExtensionsString[$ext->allowed_extetnsion];
                $all_extensions_and_limit[] = ['name' => $allowedExtensionsString[$ext->allowed_extetnsion], 'limit' => $ext->file_size];
            }
        }
        $all_extensions = implode(',', $all_extensions);
        return view('frontend.ideas.addIdea_new', compact('benifits', 'all_extensions', 'all_extensions_and_limit'));
    }


    public function storeIdea(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:500',
            'description' => 'required',
            'category_id' => 'required',
            'idea_outcome' => 'required',
            'why_implemented' => 'required',
            'challeges' => 'required',
            'already_implemented_or_no' => 'required',
            'alternatives' => 'required',
            'cost_and_benifits' => 'required',
            'benifits' => 'required'
            // 'images' =>  'mimes:jpg,png,jpeg,pdf,doc,docx'
        ]);

        $idea = new Ideas($validated);
        $ideaRevision = new IdeaRevision();

        // Code to create idea_uni_id
        //  $idea->user_id = Auth::id();
        // $idea->title = $request->title;
        //$idea->description = $request->description;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        $randomString = $randomString . time();
        //  $idea->idea_uni_id = $randomString;
        $benifits = null;
        if (isset($request->benifits) && count($request->benifits) > 0) {
            $benifits = implode(',', $request->benifits);
        }
        $data_array = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'idea_uni_id' => $randomString,
            'idea_outcome' => $request->idea_outcome,
            'why_implemented' => $request->why_implemented,
            'challeges' => $request->challeges,
            'already_implemented_or_no' => $request->already_implemented_or_no,
            'alternatives' => $request->alternatives,
            'cost_and_benifits' => $request->cost_and_benifits,
            'benifits' => $benifits,
            'company_id' => Auth::user()->company_id,
        ];

        //save the idea
        $idea->fill($data_array);
        if ($idea->save()) {

            if ($request->file > 0 && $request->fileName > 0) {

                $countfiles = implode(' @$ ', $request->file);
                $imgaeview = explode(' @$ ', $countfiles);
                foreach ($imgaeview as $key => $val) {

                    $ideaImages = new IdeaImages();
                    $ideaRevisionImages = new IdeaRevisionImages();
                    $image_parts = explode(";base64,", $val);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    // $image_type = $image_type_aux[1];
                    $image_base64 = base64_decode($image_parts[1]);

                    // if (restriction_filesize($request->fileName[$key])) {
                    //     return redirect()->back();
                    // }


                    $fileNameParts = explode('.', $request->fileName[$key]);
                    $ext = end($fileNameParts);

                    // $filename = uniqid() . '.png';

                    //if ($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {

                    $filename = time() . date('is') . '_' . str_replace(' ', '_', $request->fileName[$key]);
                    Storage::disk('local')->put('/public/uploads/' . $filename,  $image_base64);
                    Storage::disk('local')->put('/public/uploads/idea_revision/' . $filename,  $image_base64);
                    $ideaImages->idea_uni_id = $randomString;
                    $ideaRevisionImages->idea_uni_id = $randomString;
                    $file_path = 'uploads/' . $filename;
                    $file_path_idea_revision = 'uploads/idea_revision/' . $filename;
                    $ideaImages->file_name = $filename;
                    $ideaImages->image_path = $file_path;
                    $ideaRevisionImages->file_name = $filename;
                    $ideaRevisionImages->image_path = $file_path_idea_revision;
                    $ideaRevisionImages->save();
                    if (!$ideaImages->save()) {
                        return redirect('/ideas')->with('error', 'Failed to upload the files');
                    }

                    // } else {
                    //     return redirect()->back()->withErrors([
                    //         'message' => 'Please select the spcified type of files.'
                    //     ]);
                    // }
                }
            }

            $ideaRevision->idea_id = $idea->idea_id;
            $ideaRevision->idea_uni_id = $idea->idea_uni_id;
            $ideaRevision->fill($data_array);
            $ideaRevision->save();

            $company_id = '';
            $company_id = Users::where('user_id', $idea->user_id)->first();
            if (isset($company_id)) {
                $company_id = $company_id['company_id'];
            }
            $assessmentUsersMails = '';

            $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();

            $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])
                ->get();

            $send_mail_email = array();
            foreach ($assessmentUsersMails as $assessmentUser) {
                if ($assessmentUser->sub_role != null) {
                    $sub_role_data = explode(',', $assessmentUser->sub_role);
                    $check_if_exist = !empty(array_intersect($roles_external, $sub_role_data));
                    if ($check_if_exist) {
                        $idea_uni_id = $randomString;
                        $title = 'New Idea';
                        $description = "New Idea Has Been Created : " . $request->title;
                        $receiver_id = $assessmentUser->user_id;
                        $role = 'Assessment Team';
                        send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role);
                        $send_mail_email[] = $assessmentUser->email;
                    }
                }
            }

            // send backend notify
            $idea_uni_id = $randomString;
            $title = 'New Idea';
            $description = "New Idea Has Been Created : " . $request->title;
            send_backned_notification($idea_uni_id, $title, $description, Auth::id());


            // Sending mail to all admins,cc's and user
            try {
                $user = Users::where('user_id', Auth::id())->first();
                $first_name = $user['name'];
                $last_name = $user['last_name'];
                $user_email = $user['email'];
                $company_id = $user['company_id'];
                $Subject = "The Idea Has Been Submitted Successfully";

                $Body = "
                    <html>
                    <head>

                    </head>
                        <body>
                            <h4>
                            Hi <strong>$first_name $last_name</strong>, <br>
                            <h3>Your Idea Has Been Submitted Successfully</h3>
                            <p>Your Email Is: <strong>User e-mail</strong> : $user_email</p>
                            <br>
                            <h2>Idea Details Below:</h2>
                            Idea Title : <strong>" . htmlentities($request->title) . "</strong>
                            </h4>
                            <h4>
                            Idea Description : <strong>" . htmlentities($request->description) . "</strong>
                            </h4>

                        </body>
                    </html>";
                $cc_mail_ids = array();
                $mail_send_to_user = mailCommunication($Subject, $Body, $cc_mail_ids, $user_email);

                // dd($mail_send_to_user);

                //sending mail to all assestment team members,admins and cc's
                $cc_mail_ids = array();
                $cc_mails = EmailConfig::where('team', 'like', 'Assessment Team')->first();
                if (isset($cc_mails->emails)) {
                    $cc_mail_ids = explode(',', $cc_mails->emails);
                }

                if ($mail_send_to_user) {
                    $Subject1 = "The Idea Has Been Submitted Successfully";
                    $Body1 = "
                        <html>
                        <head>

                        </head>
                            <body>
                                <h4>
                                A New Idea Has Been Submitted By <strong>$first_name $last_name</strong> <br>
                                <strong>User e-mail</strong> : $user_email
                                <br>
                                <h2>Idea Details Below: </h2>
                                Idea Title : <strong>" . htmlentities($request->title) . "</strong>
                                </h4>
                                <h4>
                                Idea Description : <strong>" . htmlentities($request->description) . "</strong>
                                </h4>

                            </body>
                        </html>";

                    if (isset($send_mail_email) && count($send_mail_email) > 0) {
                        mailCommunication_multple($Subject1, $Body1, $cc_mail_ids, $send_mail_email);
                    }
                    //dd('out',$send_mail_email);






                }
            } catch (phpmailerException $e) {
                echo $e->errorMessage();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            // Email Notification code ends
            return redirect()->route('ideas.index')->with('success', 'Successfully Submitted the Idea!');
        } else {
            return redirect()->route('ideas.index')->with('error', 'Failed to submit the Idea!');
        }
    }

    public function storeSupportingdocs(Request $request)
    {

        $idea = Ideas::where('idea_id', $request->idea_id)->first();
        $randomString = $idea->idea_uni_id;


        if ($request->file > 0 && $request->fileName > 0) {
            $countfiles = implode(' @$ ', $request->file);
            $imgaeview = explode(' @$ ', $countfiles);
            // dd($imgaeview);
            foreach ($imgaeview as $key => $val) {

                $ideaImages = new IdeaImages();
                // $ideaRevisionImages = new IdeaRevisionImages();
                $image_parts = explode(";base64,", $val);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_base64 = base64_decode($image_parts[1]);

                $path_info = pathinfo($request->fileName[0]);
                $file_extension = $path_info['extension'];

                if (restriction_filesize($image_base64, $file_extension)) {
                    $filename = time() . date('is') . '_' . str_replace(' ', '_', $request->fileName[$key]);
                    $filename = preg_replace('/[^\w\d.]/', '_', $filename);
                    Storage::disk('local')->put('/public/uploads/' . $filename,  $image_base64);
                    Storage::disk('local')->put('/public/uploads/idea_revision/' . $filename,  $image_base64);
                    $ideaImages->idea_uni_id = $randomString;
                    $ideaImages->is_supporting = 1;
                    // $ideaRevisionImages->idea_uni_id = $randomString;
                    $file_path = 'uploads/' . $filename;
                    // $file_path_idea_revision = 'uploads/idea_revision/' . $filename;
                    $ideaImages->file_name = $filename;
                    $ideaImages->image_path = $file_path;
                    // $ideaRevisionImages->file_name = $filename;
                    // $ideaRevisionImages->image_path = $file_path_idea_revision;
                    // $ideaRevisionImages->save();
                    if (!$ideaImages->save()) {
                        return redirect('/ideas')->with('error', 'Failed to upload the files');
                    }
                } else {
                    return redirect()->back()->withErrors([
                        'message' => 'Please select the spcified type of files.'
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Successfully Submitted Supporting Documents!');
        } else {
            return redirect()->back()->with('error', 'No Documents Attached!');
        }
    }

    public function rating()
    {
        // dd($_GET);
        $rating = $_GET['rating'];
        $idea_id = $_GET['ideaId'];
        $idea = Ideas::where('idea_id', $idea_id)->first();
        $idea->rating  = $rating;
        return $idea->save() ?? 0;
    }

    public function view($id, $view_mode = null)
    {

        $role = Auth::user()->role;
        $status_data = [];
        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        if (!empty($roles_external)) {
            $status_data = explode(',', $roles_external->status_values);
        }
        $assessment_SLA = SLA::where('role_id', Auth::user()->sub_role_final)->first();

        // $idea_active_status = IdeaActiveStatus::where('assessment_team', 1)->pluck('idea_active_status', 'idea_active_status_value');
        $idea_active_status = IdeaActiveStatus::where('assessment_team', 1)->whereIn('idea_active_status_value', $status_data)->pluck('idea_active_status', 'idea_active_status_value');
        $journey_assesment = IdeaJourney::where(['final_role_id'=>$roles_external->id,'idea_id'=> $id])->first();
        // dd($roles_external->id);
        return view('frontend.ideas.view', ['idea' => Ideas::where('idea_id', $id)->first(), 'idea_active_status' => $idea_active_status, 'journey_assesment' => $journey_assesment, 'show_mode' => $view_mode, 'sla' => $assessment_SLA]);
    }

    //For Approving Authority
    public function view_idea_approving_authority($id)
    {
        $role = Auth::user()->role;
        $status_data = [];
        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        if (!empty($roles_external)) {
            $status_data = explode(',', $roles_external->status_values);
        }
        // dd($roles_external->id);
        $assesment_roles = RolesExternal::where('role_name', 'like', '%Assessment Team%')->get('id');
        $journey_assesment = IdeaJourney::where('idea_id', $id)->WhereIN('final_role_id', $assesment_roles)->orderBy('idea_journey_id', 'desc')->first();
        $approver_role = Rolesexternal::where('role_type', 'Approving Authority')->get('id');

        // dd($approver_role);
        $journey_approver = IdeaJourney::where('idea_id', $id)->whereIN('final_role_id', $approver_role)->orderBy('idea_journey_id', 'desc')->first();
        $sla_details = SLA::where('role_id', Auth::user()->sub_role_final)->first();

        // $idea_active_status = IdeaActiveStatus::where('approving_authority', 1)->pluck('idea_active_status', 'idea_active_status_value');
        $idea_active_status = IdeaActiveStatus::where('approving_authority', 1)->whereIn('idea_active_status_value', $status_data)->pluck('idea_active_status', 'idea_active_status_value');
        $company = Company::pluck('company_name', 'company_id');


        // dd($journey_assesment);
        return view('frontend.ideas.view_idea_approving_authority', ['idea' => Ideas::where('idea_id', $id)->first(), 'feedback' => Feedback::where('idea_id', $id)->orderBy('feedback_id', 'ASC')->get(), 'idea_active_status' => $idea_active_status, 'assessment_journey' => $journey_assesment, 'journey_approver' => $journey_approver, 'company' => $company, 'sla' => $sla_details]);
    }
    //For Implementation Team
    public function view_idea_implementation_team($id)
    {

        $role = Auth::user()->role;
        // dd(Feedback::all());
        $idea_active_status = IdeaActiveStatus::where('implementation_team', 1)->pluck('idea_active_status', 'idea_active_status_value');
        $sla_details = SLA::where('role_id', Auth::user()->sub_role_final)->first();
        return view('frontend.ideas.view_idea_implementation_team', ['idea' => Ideas::where('idea_id', $id)->first(), 'feedback' => Feedback::where('idea_id', $id)->orderBy('feedback_id', 'ASC')->get(), 'idea_active_status' => $idea_active_status, 'sla' => $sla_details]);
    }
    public function ideaRevision($id)
    {
        session::put('sub_page', url()->full());
        return view('frontend.ideas.ideaRevision', ['ideas' => IdeaRevision::where('idea_id', $id)->orderBy('created_at', 'DESC')->get(), 'id' => $id]);
    }
    public function viewIdeaRevision($id)
    {
        // dd(Feedback::all());
        //  dd(IdeaRevision::where('idea_revision_id', $id)->first()->toArray());
        return view('frontend.ideas.viewIdeaRevision', ['ideaRevision' => IdeaRevision::where('idea_revision_id', $id)->first()]);
    }



    public function storeIdea_old(Request $request)
    {

        // dd($request->all());
        $validated = $request->validate([
            'title' => 'required|max:500',
            'description' => 'required',
            'category_id' => 'required',
            // 'images' =>  'mimes:jpg,png,jpeg,pdf,doc,docx'
        ]);


        $idea = new Ideas($validated);
        $ideaRevision = new IdeaRevision();

        // Code to create idea_uni_id
        $idea->user_id = Auth::id();
        $idea->title = $request->title;
        $idea->description = $request->description;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        $randomString = $randomString . time();
        $idea->idea_uni_id = $randomString;
        // dd(Auth::user()->role);
        // if($request->user_id == Auth::user()->user_id && Auth::user()->role == 'Approving Authority'){
        //     $idea->assessment_team_approval = 1;
        // }else if($request->user_id == Auth::user()->user_id && Auth::user()->role == 'Implementation'){
        //     $idea->approving_authority_approval = 1;
        // }
        if ($idea->save()) {
            if ($request->file > 0 && $request->fileName > 0) {
                $countfiles = implode(' @$ ', $request->file);
                $imgaeview = explode(' @$ ', $countfiles);
                // dd($imgaeview);
                foreach ($imgaeview as $key => $val) {

                    $ideaImages = new IdeaImages();
                    $ideaRevisionImages = new IdeaRevisionImages();
                    $image_parts = explode(";base64,", $val);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    // $image_type = $image_type_aux[1];
                    $image_base64 = base64_decode($image_parts[1]);

                    $fileNameParts = explode('.', $request->fileName[$key]);
                    $ext = end($fileNameParts);
                    // $filename = uniqid() . '.png';
                    if ($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
                        $filename = time() . date('is') . '_' . str_replace(' ', '_', $request->fileName[$key]);
                        Storage::disk('local')->put('/public/uploads/' . $filename,  $image_base64);
                        Storage::disk('local')->put('/public/uploads/idea_revision/' . $filename,  $image_base64);
                        $ideaImages->idea_uni_id = $randomString;
                        $ideaRevisionImages->idea_uni_id = $randomString;
                        $file_path = 'uploads/' . $filename;
                        $file_path_idea_revision = 'uploads/idea_revision/' . $filename;
                        $ideaImages->file_name = $filename;
                        $ideaImages->image_path = $file_path;
                        $ideaRevisionImages->file_name = $filename;
                        $ideaRevisionImages->image_path = $file_path_idea_revision;
                        $ideaRevisionImages->save();
                        if (!$ideaImages->save()) {
                            return redirect('/ideas')->with('error', 'Failed to upload the files');
                        }
                    } else {
                        return redirect()->back()->withErrors([
                            'message' => 'Please select the spcified type of files.'
                        ]);
                    }
                }
            }

            $ideaRevision->idea_id = $idea->idea_id;
            $ideaRevision->idea_uni_id = $idea->idea_uni_id;
            $ideaRevision->fill($request->all());
            $ideaRevision->save();

            $company_id = '';
            $company_id = Users::where('user_id', $idea->user_id)->first();
            if (isset($company_id)) {
                $company_id = $company_id['company_id'];
            }
            $assessmentUsersMails = '';

            $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
            // dd($roles_external);
            // dd($company_id);
            $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();

            // dd($assessmentUsersMails);
            //send frontend notify
            $send_mail_email = array();
            foreach ($assessmentUsersMails as $assessmentUser) {
                $idea_uni_id = $randomString;
                $title = 'New Idea';
                $description = 'New Idea has been created : ' . $request->title;
                $receiver_id = $assessmentUser->user_id;
                $role = 'Assessment Team';
                send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role);
                $send_mail_email[] = $assessmentUser->email;
            }

            // send backend notify
            $idea_uni_id = $randomString;
            $title = 'New Idea';
            $description = "New Idea has been created : " . $request->title;
            send_backned_notification($idea_uni_id, $title, $description, Auth::id());

            // Sending mail to all admins,cc's and user
            try {
                $user = Users::where('user_id', Auth::id())->first();
                $first_name = $user['name'];
                $last_name = $user['last_name'];
                $user_email = $user['email'];
                $company_id = $user['company_id'];
                $Subject = "The Idea Has Been Submitted Successfully";

                $Body = "
                    <html>
                    <head>

                    </head>
                        <body>
                            <h4>
                            Hi <strong>$first_name $last_name</strong>, <br>
                            <h3>Your Idea Has Been Submitted Successfully</h3>
                            <p>Your Email Is: <strong>User e-mail</strong> : $user_email</p>
                            <br>
                            <h2>Idea Details Below:</h2>
                            Idea Title : <strong>" . htmlentities($request->title) . "</strong>
                            </h4>
                            <h4>
                            Idea Description : <strong>" . htmlentities($request->description) . "</strong>
                            </h4>

                        </body>
                    </html>";

                $mail_send_to_user = mailCommunication($Subject, $Body, $cc_mail_ids, $user_email);

                // dd($mail_send_to_user);

                //sending mail to all assestment team members,admins and cc's
                if ($mail_send_to_user) {
                    $Subject1 = "The Idea Has Been Submitted Successfully";
                    $Body1 = "
                        <html>
                        <head>

                        </head>
                            <body>
                                <h4>
                                A New Idea Has Been Submitted By <strong>$first_name $last_name</strong> <br>
                                <strong>User e-mail</strong> : $user_email
                                <br>
                                <h2>Idea Details Below: </h2>
                                Idea Title : <strong>" . htmlentities($request->title) . "</strong>
                                </h4>
                                <h4>
                                Idea Description : <strong>" . htmlentities($request->description) . "</strong>
                                </h4>

                            </body>
                        </html>";
                    $roles_external1 = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                    $assestment_members = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external1])->get();

                    // dd($assestment_members);
                    // $assestment_members = Users::where(['role' => 'Assessment Team', 'company_id' => $company_id, 'active_status' => 1])->get();
                    // foreach ($assestment_members as $data) {
                    //     mailCommunication($Subject1, $Body1, $data->email);
                    // }

                    $cc_mail_ids = array();
                    if (isset($send_mail_email) && count($send_mail_email) > 0) {
                        mailCommunication_multple($Subject1, $Body1, $cc_mail_ids, $send_mail_email);
                    }
                }
            } catch (phpmailerException $e) {
                echo $e->errorMessage();
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            // Email Notification code ends
            return redirect()->route('ideas.index')->with('success', 'Successfully Submitted the Idea!');
        } else {
            return redirect()->route('ideas.index')->with('error', 'Failed to submit the Idea!');
        }
    }
    public function distroyIdea($id)
    {
        $idea = Ideas::where('idea_id', $id)->get();
        // dd(count($idea));
        if (count($idea) > 0) {
            $idea = Ideas::where('idea_id', $id)->first();
            $idea_uni_id = $idea->idea_uni_id;
            $idea_images = IdeaImages::where('idea_uni_id', $idea_uni_id)->get();
            $idea_revision_images = IdeaRevisionImages::where('idea_uni_id', $idea_uni_id)->get();
            // dd($idea_revision_images->toArray());
            foreach ($idea_images as $idea_image) {
                Storage::disk('local')->delete('/public/' . $idea_image->image_path);
            }
            foreach ($idea_revision_images as $idea_image) {
                Storage::disk('local')->delete('/public/' . $idea_image->image_path);
            }

            IdeaImages::where('idea_uni_id', $idea_uni_id)->delete();
            IdeaRevisionImages::where('idea_uni_id', $idea_uni_id)->delete();
            if (Ideas::where('idea_id', $id)->delete()) {
                Notification::where('idea_uni_id', $idea->idea_uni_id)->delete();
                AdminNotification::where('idea_uni_id', $idea->idea_uni_id)->delete();
                return redirect('/ideas')->with('success', 'Idea Has Been Deleted');
            } else {
                return redirect('/ideas')->with('error', 'Failed to delete the Idea');
            }
        }
    }
    public function edit($id)
    {
        $idea = Ideas::where('idea_id', $id)->first();
        $benifits = IdeaBenifits::pluck('idea_benifit', 'idea_benifit');
        $extensions = Filesetting::get();

        $allowedExtensionsString = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'webp', 'mp3', 'wav', 'ogg', 'flac', 'aac', 'mp4', 'avi', 'mkv', 'mov', 'flv', 'wmv', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'zip', 'rar'];
        $all_extensions = array();
        $all_extensions_and_limit = array();
        if (isset($extensions)  && count($extensions) > 0) {
            foreach ($extensions as $key => $ext) {
                $all_extensions[] = $allowedExtensionsString[$ext->allowed_extetnsion];
                $all_extensions_and_limit[] = ['name' => $allowedExtensionsString[$ext->allowed_extetnsion], 'limit' => $ext->file_size];
            }
        }
        $all_extensions = implode(',', $all_extensions);

        return view('frontend.ideas.updateIdea', compact('idea', 'benifits', 'all_extensions', 'all_extensions_and_limit'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'title' => 'required|max:500',
            'description' => 'required',
            'category_id' => 'required',
            'idea_outcome' => 'required',
            'why_implemented' => 'required',
            'challeges' => 'required',
            'already_implemented_or_no' => 'required',
            'alternatives' => 'required',
            'cost_and_benifits' => 'required',
            'benifits' => 'required'
            // 'images' =>  'mimes:jpg,png,jpeg,pdf,doc,docx'
        ]);

        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        // $role = Auth::user()->role;
        $role = $roles_external->role_type;

        $idea = Ideas::where('idea_id', $request->idea)->get();
        // dd($idea);
        if (count($idea) > 0) {

            $ideaQ = Ideas::where('idea_id', $request->idea)->first();
            $benifits = null;
            if (isset($request->benifits) && count($request->benifits) > 0) {
                $benifits = implode(',', $request->benifits);
            }
            $data_array = [
                'title' => $request->title,
                'description' => $request->description,
                'idea_outcome' => $request->idea_outcome,
                'why_implemented' => $request->why_implemented,
                'challeges' => $request->challeges,
                'already_implemented_or_no' => $request->already_implemented_or_no,
                'alternatives' => $request->alternatives,
                'cost_and_benifits' => $request->cost_and_benifits,
                'benifits' => $benifits,
            ];
            $ideaQ->fill($data_array);
            $ideaRevision = new IdeaRevision();
            $ideaRevision->idea_id = $request->idea;
            // dd($request->file);
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < 10; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
            $randomString = $randomString . time();
            $idea_uni_id = $ideaQ->idea_uni_id;
            // dd($request->file);

            if ($request->file > 0 && $request->fileName > 0) {

                $countfiles = implode(' @$ ', $request->file);
                $imgaeview = explode(' @$ ', $countfiles);


                foreach ($imgaeview as $key => $val) {
                    $ideaImages = new IdeaImages();
                    // $ideaRevisionImages = new IdeaRevisionImages();
                    $image_parts = explode(";base64,", $val);
                    // dd($image_parts);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_base64 = base64_decode($image_parts[1]);

                    // if (restriction_filesize($request->fileName[$key])) {
                    //     return redirect()->back();
                    // }

                    $fileNameParts = explode('.', $request->fileName[$key]);
                    $ext = end($fileNameParts);
                    if ($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
                        // dd($request->fileName[$key]);
                        $filename = time() . '_' . date('is') . '_' . str_replace(' ', '_', $request->fileName[$key]);
                        // dd($filename);
                        // Storage::disk('local')->put('/public/uploads/' . $filename,  $image_base64);
                        Storage::disk('local')->put('/public/uploads/' . $filename,  $image_base64);
                        Storage::disk('local')->put('/public/uploads/idea_revision/' . $filename,  $image_base64);
                        // Storage::disk('local')->put('/public/uploads/idea_revision/' . $filename,  $image_base64);
                        $ideaImages->idea_uni_id = $idea_uni_id;
                        // $ideaRevisionImages->idea_uni_id = $randomString;
                        $file_path = 'uploads/' . $filename;
                        // $file_path_idea_revision = 'uploads/idea_revision/' . $filename;
                        $ideaImages->file_name = $filename;
                        $ideaImages->image_path = $file_path;
                        // $ideaRevisionImages->file_name = $filename;
                        // $ideaRevisionImages->image_path = $file_path_idea_revision;
                        // $ideaRevisionImages->save();
                        if (!$ideaImages->save()) {
                            return redirect('/ideas')->with('error', 'Failed to upload the files');
                        }
                    } else {
                        return redirect()->back()->withErrors([
                            'message' => 'Please select the spcified type of files.'
                        ]);
                    }
                }
            }




            $ideaRevision->fill($data_array);
            // $ideaRevision->title = $request->title;
            // $ideaRevision->description = $request->description;
            // $ideaRevision->category_id = $request->category_id;
            $ideaRevision->idea_uni_id = $randomString;
            if ($ideaRevision->save()) {

                $ideaImages = IdeaImages::where('idea_uni_id', $idea_uni_id)->get();
                if ($ideaImages->toArray() > 0) {
                    foreach ($ideaImages as $ideaImage) {
                        $idea_images = new IdeaRevisionImages();
                        $filename =  str_replace(' ', '_', $ideaImage->file_name);
                        // dd($filename);
                        // dd($ideaImage->file_name);
                        if (!Storage::disk('local')->exists('/public/' . $ideaImage->image_path)) {
                            Storage::disk('local')->copy('/public/' . $ideaImage->image_path, '/public/uploads/idea_revision/' . $filename);
                        }
                        $idea_images->image_path = 'uploads/idea_revision/' . $filename;
                        $idea_images->idea_uni_id = $ideaRevision->idea_uni_id;
                        $idea_images->file_name = $ideaImage->file_name;
                        $idea_images->save();
                    }
                }
                if ($ideaQ->save()) {
                    //send email when update idea to all admins and assetmnt team --working
                    $data = FacadesDB::table('ideas')->where(['idea_id' => $request->idea])->first();
                    if (!($roles_external->role_type == 'User' && $data->assessment_team_approval == 1 && $data->asstmnt_rev_status == 0)) {
                        FacadesDB::table('ideas')->where('idea_id', $request->idea)->update(['asstmnt_rev_status' => 0, 'active_status' => 'pending', 'assessment_team_approval' => 0]);

                        $company_id = '';
                        $company_id = Users::where('user_id', Auth::id())->first();
                        if (isset($company_id)) {
                            $company_id = $company_id['company_id'];
                        }

                        $assessmentUsersMails = '';
                        $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                        $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])
                            ->get();

                        //send forntend notify
                        // dd($assessmentUsersMails->toArray());
                        $send_mail_email = array();
                        foreach ($assessmentUsersMails as $assessmentUser) {
                            if ($assessmentUser->sub_role != null) {
                                $sub_role_data = explode(',', $assessmentUser->sub_role);
                                $check_if_exist = !empty(array_intersect($roles_external, $sub_role_data));
                                if ($check_if_exist) {
                                    $idea_uni_id = $ideaQ->idea_uni_id; // $randomString;
                                    $title = 'Idea Updated';
                                    $description = "Idea has been Updated : " . $request->title;
                                    $receiver_id = $assessmentUser->user_id;
                                    $role = 'Assessment Team';
                                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role);
                                    $send_mail_email[] = $assessmentUser->email;
                                }
                            }
                        }

                        //send backend notify
                        $title = "The Idea Has Been Updated." . " Idea Title : " . $request->title;
                        $description = "Idea Description : " . $request->description;
                        send_backned_notification($idea_uni_id, $title, $description, Auth::id());
                    }



                    //sending mail to user,all admins and cc's
                    try {
                        $user = Users::where('user_id', Auth::id())->first();
                        $first_name = $user['name'];
                        $last_name = $user['last_name'];
                        $user_email = $user['email'];
                        $company_id = $user['company_id'];

                        $Subject = "The Idea Has Been Updated Successfully";
                        $Body = "
                    <html>
                    <head>

                    </head>
                        <body>
                            <h4>
                            Hi <strong>$first_name $last_name</strong>, <br>
                            <h3>Your Idea Has Been Updated Successfully</h3>
                            <p>Your Email Is: <strong>User e-mail</strong> : $user_email</p>
                            <br>
                            <h2>Idea Details Below:</h2>
                            Idea Title : <strong>" . htmlentities($request->title) . "</strong>
                            </h4>
                            <h4>
                            Idea Description : <strong>" . htmlentities($request->description) . "</strong>
                            </h4>

                        </body>
                    </html>";

                        $cc_mail_ids = array();
                        $mail_send_to_user = mailCommunication($Subject, $Body, $cc_mail_ids, $user_email);
                        // dd($mail_send_to_user);


                        // sending mail to all assestment team members,admins and cc's
                        if ($mail_send_to_user) {
                            $Subject1 = "The Idea Has Been Updated Successfully";
                            $Body1 = "
                        <html>
                        <head>

                        </head>
                            <body>
                                <h4>
                                Idea Has Been Updated By <strong>$first_name $last_name</strong> <br>
                                <strong>User e-mail</strong> : $user_email
                                <br>
                                <h2>Idea Details Below: </h2>
                                Idea Title : <strong>" . htmlentities($request->title) . "</strong>
                                </h4>
                                <h4>
                                Idea Description : <strong>" . htmlentities($request->description) . "</strong>
                                </h4>

                            </body>
                        </html>";

                            // $assestment_members = Users::where(['role' => 'Assessment Team', 'company_id' => $company_id, 'active_status' => 1])->get();
                            $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                            $assestment_members = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();

                            // dd($assestment_members);
                            // foreach ($assestment_members as $data) {
                            //     mailCommunication($Subject1, $Body1, $data->email);
                            // }

                            $cc_mail_ids = array();
                            $cc_mails = EmailConfig::where('team', 'like', 'Assessment Team')->first();
                            if (isset($cc_mails->emails)) {
                                $cc_mail_ids = explode(',', $cc_mails->emails);
                            }

                            if (isset($send_mail_email) && count($send_mail_email) > 0) {
                                mailCommunication_multple($Subject1, $Body1,  $cc_mail_ids, $send_mail_email);
                            }
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }

                    return redirect('/ideas')->with('success', 'Idea Has Been Updated');
                }
            }
        }
    }

    public function getUserDetails(Request $request)
    {
        $user_id = $request->input('user_id');
        $user = Users::where('user_id', $user_id)->first();

        return response()->json(['user' => $user]);
    }
    public function getChatMessages(Request $request)
    {
        $receiver_id = $request->input('user_id');
        $ideaId = $request->input('idea_id');

        // Fetch chat messages for the selected user and idea
        $chats = Feedback::where('idea_id', $ideaId)
            ->where(function ($query) use ($receiver_id) {
                $query->where(function ($innerQuery) use ($receiver_id) {
                    $innerQuery->where('user_id', Auth::id())
                        ->where('receiver_id', $receiver_id);
                })
                    ->orWhere(function ($innerQuery) use ($receiver_id) {
                        $innerQuery->where('user_id', $receiver_id)
                            ->where('receiver_id', Auth::id());
                    });
            })
            ->orderBy('created_at', 'DESC')
            ->get();



        // Return the HTML response for chat messages along with user details
        return response()->json(['chats' => $chats]);
    }


    public function storeFeedback(Request $request)
    {
        // dd(request());
        $validated = request()->validate([
            // 'feedback' => 'min:3'
        ]);
        $roles = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();

        $feedback = new Feedback();
        $feedback->idea_id = request()->idea_id;
        $feedback->user_id = Auth::id();
        $feedback->receiver_id = request()->receiver_id;
        $feedback->user_role = $roles->role_type;
        $feedback->feedback = request()->feedback;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');

            // dd($file->getSize());
            if (restriction_filesize($file)) {


                // $file = $request->file('attachment');

                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/chats', $fileName, 'public');
                $feedback->media_file = $filePath;
            } else {
                return redirect()->back();
            }
        }


        if ($feedback->save()) {

            $idea = Ideas::where('idea_id', request()->idea_id)->first();
            $idea_uni_id = $idea->idea_uni_id;
            $idea_title = $idea->title;

            $ATuser_first_name = Auth::user()->name;
            $ATuser_last_name = Auth::user()->last_name;
            $role = Auth::user()->role;

            if ($idea) {
                if ($role != 'User') {
                    $notification = new Notification();
                    $notification->idea_uni_id = $idea_uni_id;
                    $notification->title = "Comment Has Been Posted By  " . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                    $notification->description = "Idea Title : " . $idea_title . " <br> Comment : " . request()->feedback;
                    $notification->receiver_id = $idea['user_id'];
                    // $notification->role = $roles->role_type;
                    $notification->save();


                    $idea_uni_id = $idea_uni_id;
                    $title = "Comment Has Been Posted By  " . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                    $description = "Idea Title : " . $idea_title . " <br> Comment : " . request()->feedback;
                    send_backned_notification($idea_uni_id, $title, $description, Auth::id());
                }
            }
            return redirect()->back()->with('success', 'Comment Has Been Submitted Successfully');
        }
    }


    public function updateIdeaStatus(Request $request)
    {
        // dd($request->all());
        $sendmails = [];
        $status = Ideas::where('idea_id', $request->idea_id)->first();
        // dd($status);
        $idea_title = $status->title;
        $idea_desc = $status->description;
        $idea_uni_id = $status->idea_uni_id;
        $ATuser_first_name = Auth::user()->name;
        $ATuser_last_name = Auth::user()->last_name;
        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();

        $company_id = '';
        $company_id = Users::where('user_id', Auth::id())->first();
        if (isset($company_id)) {
            $company_id = $company_id['company_id'];
        }
        //dd($company_id);
        // $role = Auth::user()->role;
        $role = $roles_external->role_type;
        if (count($status->toArray()) > 0) {

            if ($request->idea_status == 'in_assessment') {
                // dd('assdg');
                $status->active_status = 'in_assessment';
                if (isset($request->sla_reason) && !is_null($request->sla_reason)) {
                    $status->sla_reason_assessment = $request->sla_reason;
                    $status->sls_date_assessment = date('Y-m-d');
                }
                $status->save();

                //send frontend notify to user
                $title = "The Status Of Idea Has Been Changed To Under Assessment By " . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                $description = "Idea Title : " . $idea_title;
                $receiver_id = $status['user_id'];
                $role_curr = 'User';
                send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);

                //send backend notify
                $idea_uni_id = $idea_uni_id;
                $title = 'The Status Of Idea Has Been Changed To Under Assessment By ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                $description = "Idea Title : " . $idea_title;
                send_backned_notification($idea_uni_id, $title, $description, Auth::id());


                // if ($updated) {
                FacadesDB::table('ideas')->where('idea_id', $request->idea_id)->update(['asstmnt_rev_status' => 0]);

                $user_email = '';
                $user_email = Users::where('user_id', $status['user_id'])->first();
                if ($user_email) {
                    $user_email = $user_email['email'];
                }
                // dd($email);

                // $mail->addAddress($user_email, 'Jmbaxi');
                $Subject = "Idea Has Been Updated To Under Assestment";
                $Body = "
                <html>
                <head>

                </head>
                    <body>
                        <h4>
                            Idea Title : <strong>" . htmlentities($idea_title) . "</strong><br>
                            Idea Desciption : " . htmlentities($idea_desc) . "
                        </h4>
                    </body>
                </html>";
                //dd($user_email);
                $cc_mail_ids = array();
                mailCommunication($Subject, $Body, $cc_mail_ids, $user_email);
                // }
            } elseif ($request->idea_status == 'reject') {
                $status->active_status = 'reject';
                $status->reject_reason = $request->reject_reason;
                $status->rejected = 1;
                $status->save();

                //notify user first
                $title = 'The Idea Has Been Rejected (Reason : ' . $request->reject_reason . ' ) by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                $description = "Idea Title : " . $idea_title;
                $receiver_id = $status['user_id'];
                $role_curr = 'User';
                send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);

                $assessmentUsersMails = '';
                $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->get();
                //notify At.Team first

                if ($role == 'Approving Authority') {
                    $send_mail_email = array();
                    foreach ($assessmentUsersMails as $assessmentUser) {
                        $title = "The Idea Has Been Rejected (Reason : " . $request->reject_reason . " ) by " . $ATuser_first_name . " " . $ATuser_last_name . " (" . $role . ") ";
                        $description = "Idea Title : " . $idea_title;
                        $receiver_id = $assessmentUser->user_id;
                        $role_curr = 'Assessment Team';
                        send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                        $send_mail_email[] = $assessmentUser->email;
                    }

                    //SLA not meet status save
                    if (isset($request->sla_reason) && !is_null($request->sla_reason)) {
                        $status->sla_reason_approver = $request->sla_reason;
                        $status->sls_date_approver = date('Y-m-d');
                        $status->save();
                    }
                } else {
                    //Set SLA for assesment User
                    if (isset($request->sla_reason) && !is_null($request->sla_reason)) {
                        $status->sla_reason_assessment = $request->sla_reason;
                        $status->sls_date_assessment = date('Y-m-d');
                        $status->save();
                    }
                }


                //backend notify
                $idea_uni_id = $idea_uni_id;
                $title = "The Idea Has Been Rejected (Reason : " . $request->reject_reason . " ) by " . $ATuser_first_name . " " . $ATuser_last_name .  " (" . $role . ")";
                $description = "Idea Title : " . $idea_title;
                send_backned_notification($idea_uni_id, $title, $description, Auth::id());

                $idea_title = $status['title'];
                $approve_user_role = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
                $idea_status = new IdeaStatus;
                // dd($status->toArray());
                if (count($status->toArray()) > 0) {
                    $idea_status->idea_id = $request->idea_id;
                    $idea_status->user_id = Auth::id();
                    //$idea_status->user_role = Auth::user()->role;
                    if (isset($approve_user_role->role_name)) {
                        $idea_status->user_role = $approve_user_role->role_name;
                    }
                    $idea_status->idea_status = 'rejected';
                    $idea_status->save();

                    //sending mail to user,admins and cc's if Asstmnt Team or AA Team Rejects
                    try {
                        $user_email = '';
                        $user_email = Users::where('user_id', $status['user_id'])->first();
                        if ($user_email) {
                            $user_email = $user_email['email'];
                        }
                        // dd($email);

                        // $mail->addAddress($user_email, 'Jmbaxi');
                        $Subject = "Idea Has Been Rejected";
                        $Body = "
                    <html>
                    <head>

                    </head>
                        <body>
                            <h4>
                                Idea Title : <strong>" . htmlentities($idea_title) . "</strong><br>
                                Idea Desciption : " . htmlentities($idea_desc) . "<br>
                                Reason of Rejection : " . htmlentities($request->reject_reason) . "
                            </h4>
                        </body>
                    </html>";
                        // $mail->Send();
                        $cc_mail_ids = array();
                        mailCommunication($Subject, $Body, $cc_mail_ids, $user_email);
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage();
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    // Email Notification code ends
                }
            } elseif ($request->idea_status == 'on_hold') {
                $status->active_status = 'on_hold';

                if (isset($request->sla_reason) && !is_null($request->sla_reason)) {
                    $status->sla_reason_assessment = $request->sla_reason;
                    $status->sls_date_assessment = date('Y-m-d');
                }

                $status->save();

                //store Rivison @naresh June 22
                $idea_status = new IdeaStatus;
                // dd($status->toArray());
                if (count($status->toArray()) > 0) {
                    $idea_status->idea_id = $request->idea_id;
                    $idea_status->user_id = Auth::id();
                    //$idea_status->user_role = Auth::user()->role;
                    $approve_user_role = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
                    if (isset($approve_user_role->role_name)) {
                        $idea_status->user_role = $approve_user_role->role_name;
                    }
                    $idea_status->idea_status = 'on_hold';
                    $idea_status->save();
                }
                //Revisoin Code End

                //notify user first
                $title = 'The Status Of Idea Has Been Changed To On-Hold By ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                $description = "Idea Title : " . $idea_title;
                $receiver_id = $status['user_id'];
                $role_curr = 'User';
                send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                $assessmentUsersMails = '';
                $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                // $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])
                    ->get();
                //dd($roles_external);
                //notify At.Team first
                if ($role == 'Approving Authority') {
                    // dd('approving');
                    foreach ($assessmentUsersMails as $assessmentUser) {
                        if ($assessmentUser->sub_role != null) {
                            $sub_role_data = explode(',', $assessmentUser->sub_role);
                            $check_if_exist = !empty(array_intersect($roles_external, $sub_role_data));
                            if ($check_if_exist) {
                                $title = 'The Status Of Idea Has Been Changed To On-Hold By ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                                $description = "Idea Title : " . $idea_title;
                                $receiver_id = $assessmentUser->user_id;
                                $role_curr = 'Assessment Team';
                                send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                            }
                        }
                    }
                }


                //backend notify
                $idea_uni_id = $idea_uni_id;
                $title = 'The Status Of Idea Has Been Changed To On-Hold By ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                $description = "Idea Title : " . $idea_title;
                send_backned_notification($idea_uni_id, $title, $description, Auth::id());

                // if ($updated) {
                $user_email = '';
                $user_email = Users::where('user_id', $status['user_id'])->first();
                if ($user_email) {
                    $user_email = $user_email['email'];
                }
                // dd($email);

                // $mail->addAddress($user_email, 'Jmbaxi');
                $Subject = "Idea Has Been Put On Hold";
                $Body = "
                <html>
                <head>

                </head>
                    <body>
                        <h4>
                            Idea Title : <strong>" . htmlentities($idea_title) . "</strong><br>
                            Idea Desciption : " . htmlentities($idea_desc) . "
                        </h4>
                    </body>
                </html>";
                $cc_mail_ids = array();
                mailCommunication($Subject, $Body, $cc_mail_ids, $user_email);
                // }
            } elseif ($request->idea_status == 'resubmit') {

                $title = '';

                $data = FacadesDB::table('ideas')->where(['idea_id' => $request->idea_id, 'assessment_team_approval' => 1])->first();
                if ($role == 'User' && $data->asstmnt_rev_status != 1) {
                    $status->active_status = 'in_assessment';
                    $status->save();
                } else {
                    //dd('again here');
                    $status->active_status = 'resubmit';
                    $status->resubmit_reason = $request->resubmit_reason;
                    if ($role == 'Assessment Team') {
                        $status->asstmnt_rev_status = 1;
                    }

                    if (isset($request->sla_reason) && !is_null($request->sla_reason)) {
                        $status->sla_reason_assessment = $request->sla_reason;
                        $status->sls_date_assessment = date('Y-m-d');
                    }

                    $status->save();
                    //store Rivison @naresh June 22
                    $idea_status = new IdeaStatus;
                    // dd($status->toArray());
                    if (count($status->toArray()) > 0) {
                        $idea_status->idea_id = $request->idea_id;
                        $idea_status->user_id = Auth::id();
                        //$idea_status->user_role = Auth::user()->role;
                        $approve_user_role = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
                        if (isset($approve_user_role->role_name)) {
                            $idea_status->user_role = $approve_user_role->role_name;
                        }
                        $idea_status->idea_status = 'resubmit';
                        $idea_status->save();
                    }
                    //Idea ststus code END
                    // FacadesDB::table('ideas')->where('idea_id', $request->idea_id)->update(['approv_rev_status' => 1]);


                    if ($role == 'Assessment Team') {

                        //SLA not meet status save
                        if (isset($request->sla_reason) && !is_null($request->sla_reason)) {
                            $status->sla_reason_approver = $request->sla_reason;
                            $status->sls_date_approver = date('Y-m-d');
                            $status->save();
                        }

                        // notify user first
                        $title = "The Status Of Idea Has Been Changed To Revise Request(Reason : " . $request->resubmit_reason . " ) by " . $ATuser_first_name . " " . $ATuser_last_name . " (" . $role . ")";
                        $description = "Idea Title : " . $idea_title;
                        $receiver_id = $status['user_id'];
                        $role_curr = 'User';
                        send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);

                        $user_email = '';
                        $user_email = Users::where('user_id', $status['user_id'])->first();
                        if ($user_email) {
                            $user_email = $user_email['email'];
                        }
                        //dd($user_email);

                        // $mail->addAddress($user_email, 'Jmbaxi');
                        $Subject = "Idea Has Been Revised";
                        $Body = "
                    <html>
                    <head>

                    </head>
                        <body>
                            <h4>
                                Idea Title : <strong>" . htmlentities($idea_title) . "</strong><br>
                                Idea Desciption : " . htmlentities($idea_desc) . "<br>
                                Reason of Revise : " . htmlentities($request->resubmit_reason) . "
                            </h4>
                        </body>
                    </html>";
                        $cc_mail_ids = array();
                        mailCommunication($Subject, $Body, $cc_mail_ids, $user_email);
                        //mailCommunication($Subject, $Body, $sendmails);
                        // }

                    } else if ($role == 'Approving Authority') {
                        if (Auth::user()->centralized_decentralized_type == 1 || Auth::user()->centralized_decentralized_type == '') {
                            $assessmentUsersMails = '';
                            $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                            // $assessmentUsersMails = DB::table('users')->where(['active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                        } else {
                            $assessmentUsersMails = '';
                            $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                            //$assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();

                        }

                        // //notify At.Team first
                        // foreach ($assessmentUsersMails as $assessmentUser) {
                        //     $title = 'The status of the Idea has been changed to Revise Request(Reason : ' . $request->resubmit_reason . ' ) by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                        //     $description = 'Idea Title : ' . $idea_title;
                        //     $receiver_id = $assessmentUser->user_id;
                        //     $role_curr = 'Assessment Team';
                        //     send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                        // }
                        $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])
                            ->get();



                        //send forntend notify
                        //dd($assessmentUsersMails->toArray());

                        foreach ($assessmentUsersMails as $assessmentUser) {
                            // dd($assessmentUser);
                            if ($assessmentUser->sub_role != null) {
                                $sub_role_data = explode(',', $assessmentUser->sub_role);
                                $check_if_exist = !empty(array_intersect($roles_external, $sub_role_data));
                                if ($check_if_exist) {
                                    $idea_uni_id = $idea_uni_id;
                                    $title = "The Status Of Idea Has Been Changed To Revise Request(Reason : " . $request->resubmit_reason . " ) by " . $ATuser_first_name . " " . $ATuser_last_name . " (" . $role . ")";
                                    $description = "Idea Title : " . $idea_title;
                                    $receiver_id = $assessmentUser->user_id;
                                    $role = 'Assessment Team';
                                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role);
                                    $sendmails[] = $assessmentUser->email;

                                    $user_email = '';
                                    $user_email = $assessmentUser->email;

                                    //dd($user_email);

                                    // $mail->addAddress($user_email, 'Jmbaxi');
                                    $Subject = "Idea Has Been Revised";
                                    $Body = "
                                    <html>
                                    <head>

                                    </head>
                                    <body>
                                        <h4>
                                            Idea Title : <strong>" . htmlentities($idea_title) . "</strong><br>
                                            Idea Desciption : " . htmlentities($idea_desc) . "<br>
                                            Reason of Revise : " . htmlentities($request->reject_reason) . "
                                        </h4>
                                    </body>
                                    </html>";
                                    //dd($Subject, $Body, $user_email);
                                    //  mailCommunication($Subject, $Body, $user_email);
                                }
                            }
                        }




                        if (isset($send_mail_email) && count($send_mail_email) > 0) {
                            //   mailCommunication_multple($Subject, $Body, $send_mail_email);
                        }
                    }

                    $ideaRevision = new IdeaRevision();
                    $ideaRevision->idea_id = $status->idea_id;
                    $ideaRevision->title = $status->title;
                    $ideaRevision->description = $status->description;
                    $ideaRevision->category_id = $status->category_id;
                    $ideaRevision->idea_uni_id = $idea_uni_id;
                    $ideaRevision->rev_reasone = $title;

                    if ($ideaRevision->save()) {
                        $ideaImages = IdeaImages::where('idea_uni_id', $idea_uni_id)->get();
                        if ($ideaImages->toArray() > 0) {
                            foreach ($ideaImages as $ideaImage) {
                                $idea_images = new IdeaRevisionImages();
                                $filename =  str_replace(' ', '_', $ideaImage->file_name);
                                if (!Storage::disk('local')->exists('/public/' . $ideaImage->image_path)) {
                                    Storage::disk('local')->copy('/public/' . $ideaImage->image_path, '/public/uploads/idea_revision/' . $filename);
                                }
                                $idea_images->image_path = 'uploads/idea_revision/' . $filename;
                                $idea_images->idea_uni_id = $ideaRevision->idea_uni_id;
                                $idea_images->file_name = $ideaImage->file_name;
                                $idea_images->save();
                            }
                        }
                    }


                    //backend notify
                    $idea_uni_id = $idea_uni_id;
                    $title = "The Status Of Idea Has Been Changed To Revise Request(Reason : " . $request->resubmit_reason . " ) by " . $ATuser_first_name . ' ' . $ATuser_last_name . " (" . $role . ")";
                    $description = "Idea Title : " . $idea_title;

                    send_backned_notification($idea_uni_id, $title, $description, Auth::id());



                    // if ($updated) {

                    $user_email = '';
                    $user_email = Users::where('user_id', $status['user_id'])->first();
                    if ($user_email) {
                        $user_email = $user_email['email'];
                    }
                    //dd($user_email);

                    // $mail->addAddress($user_email, 'Jmbaxi');
                    $Subject = "Idea Has Been Revised";
                    $Body = "
                <html>
                <head>

                </head>
                    <body>
                        <h4>
                            Idea Title : <strong>" . htmlentities($idea_title) . "</strong><br>
                            Idea Desciption : " . htmlentities($idea_desc) . "<br>
                            Reason of Revise : " . htmlentities($request->resubmit_reason) . "
                        </h4>
                    </body>
                </html>";
                    // mailCommunication($Subject, $Body, $user_email);
                    //mailCommunication($Subject, $Body, $sendmails);
                    // }
                }
            } elseif ($request->idea_status == 'under_approving_authority') {
                $status->active_status = 'under_approving_authority';
                //  dd('hello',$request->all());

                //set SLA Not Meet Code
                if (isset($request->sla_reason) && !is_null($request->sla_reason)) {
                    $status->sla_reason_approver = $request->sla_reason;
                    $status->sls_date_approver = date('Y-m-d');
                }
                $status->save();
                //notify user first
                $title = "The Status Of Idea Has Been Changed To Under Approval By " . $ATuser_first_name . " " . $ATuser_last_name . " (" . $role . ")";
                $description = "Idea Title : " . $idea_title;
                $receiver_id = $status['user_id'];
                $role_curr = 'User';

                send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                $assessmentUsersMails = '';
                $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                //$assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])
                    ->get();
                //..  dd($roles_external,$role,$assessmentUsersMails->toArray());
                //notify At.Team first
                $send_mail_email = array();
                if ($role == 'Approving Authority') {
                    foreach ($assessmentUsersMails as $assessmentUser) {
                        if ($assessmentUser->sub_role != null) {
                            $sub_role_data = explode(',', $assessmentUser->sub_role);
                            $check_if_exist = !empty(array_intersect($roles_external, $sub_role_data));
                            if ($check_if_exist) {
                                $title = "The Status Of Idea Has Been Changed To Under Approval By " . $ATuser_first_name . " " . $ATuser_last_name . " (" . $role . ")";
                                $description = "Idea Title : " . $idea_title;
                                $receiver_id = $assessmentUser->user_id;
                                $role_curr = 'Assessment Team';
                                send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                                // $send_mail_email[] = $assessmentUser->email;
                            }
                        }
                    }
                }

                //backend notify
                $idea_uni_id = $idea_uni_id;
                $title = "The Status Of Idea Has Been Changed To Under Approval By " . $ATuser_first_name . " " . $ATuser_last_name . " (" . $role . ")";
                $description = "Idea Title : " . $idea_title;
                send_backned_notification($idea_uni_id, $title, $description, Auth::id());
            } elseif ($request->idea_status == 'implementation') {
                // dd('hold');
                $status->active_status = 'implementation';

                $notification = new Notification();
                $notification->idea_uni_id = $idea_uni_id;
                $notification->title = "The Status Of Idea Has Been Changed To Implementation By " . $ATuser_first_name . " " . $ATuser_last_name . " ("  . $role . ')';
                $notification->description = "Idea Title : " . $idea_title;
                $notification->receiver_id = $status['user_id'];
                $notification->receiver_id = $status['user_id'];
                if ($role == 'Assessment Team') {
                    $notification->role = 'User';
                } else {
                    $notification->role = 'Assessment Team';
                }
                $notification->save();
                $status->save();

                // $notification1 = new AdminNotification();
                $idea_uni_id = $idea_uni_id;
                $title = "The Status Of Idea Has Been Changed To Implementation By " . $ATuser_first_name .  " " . $ATuser_last_name . " (" . $role . ")";
                $description = "Idea Title : " . $idea_title;
                // $notification1->receiver_id = Auth()->guard('admin')->user()->admin_user_id;
                // $notification1->save();
                send_backned_notification($idea_uni_id, $title, $description, Auth::id());
            }
            //  if ($status->save()) {
            if ($request->role == 'Implementation') {
                return redirect()->route('ideas.view_idea_implementation_team', ['id' => $request->idea_id])->with('success', 'Idea Status Has Been Updated');
            } elseif ($request->role == 'Approving Authority') {
                return redirect()->route('ideas.view_idea_approving_authority', ['id' => $request->idea_id])->with('success', 'Idea Status Has Been Updated');
            } else {
                return redirect()->route('ideas.view', ['id' => $request->idea_id])->with('success', 'Idea Status Has Been Updated');
            }
            //   }
        }
    }
    // Approving Idea by Assessment Team User
    public function approveIdeaBAU($id)
    {
        $approve_user_role = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();

        if (Auth::user()->centralized_decentralized_type == 1 || Auth::user()->centralized_decentralized_type == '') {
            $status = Ideas::where('idea_id', $id)->first();
        } else {
            $status = Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id);
            })->where('idea_id', $id)->orderBy('ideas.idea_id', 'DESC')->first();
        }

        if ($status->assessment_team_approval == 1) {
            return redirect()->route('ideas.view', ['id' => $id, 'role' => request()->role]);
        } else {

            $idea_status = new IdeaStatus;
            if (count($status->toArray()) > 0) {
                $status->assessment_team_approval = 1;
                $idea_status->idea_id = request()->id;
                $idea_status->user_id = Auth::id();
                // $idea_status->user_role = Auth::user()->role;
                if (isset($approve_user_role->role_name)) {
                    $idea_status->user_role = $approve_user_role->role_name;
                }

                $idea_status->idea_status = 'assessment_team_approved';

                $idea_status->save();
                $idea_title = $status['title'];
                $user_email = '';
                $user_email = Users::where('user_id', $status['user_id'])->first();
                $company_id = $user_email->company_id;
                if ($user_email) {
                    $user_email = $user_email['email'];
                    // $company_id = $user_email['company_id'];
                }
                $idea_uni_id = $status->idea_uni_id;
                // dd($status);
                if ($status->save()) {


                    $ATuser_first_name = Auth::user()->name;
                    $ATuser_last_name = Auth::user()->last_name;
                    $ATuser_email = Auth::user()->email;
                    // $assessmentUsersMails = Users::where('role', 'Approving Authority')->get();
                    $roles_external = Rolesexternal::where(['role_type' => 'Approving Authority'])->pluck('id')->toArray();
                    //   $assessmentUsersMails = DB::table('users')->where(['active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                    $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])
                        ->get();
                    //dd($assessmentUsersMails);
                    // $assessmentUsersMails = DB::table('users')->where(['active_status' => 1])->where(function ($q) use($company_id){
                    //     if($q->centralized_decentralized_type==2){
                    //         $q->where('company_id',$company_id);
                    //     }
                    //     })->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                    // $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();

                    // dd($assessmentUsersMails->centralized_decentralized_type);

                    $title = "Idea Has Been Approved By " . $ATuser_first_name . " " . $ATuser_last_name . " (Assessment Team)";
                    $description = "Idea Title : " . $idea_title;
                    send_backned_notification($idea_uni_id, $title, $description, Auth::id());

                    // notify user as well
                    $title = "Idea Has Been Approved By " . $ATuser_first_name . " " . $ATuser_last_name . " (Assessment Team)";
                    $description = "Idea Title : " . $idea_title;
                    $receiver_id = $status->user_id;
                    $role_curr = 'User';
                    //   dd($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                    //dd($assessmentUsersMails->toArray());

                    //notify all members of AA- team
                    $send_mail_email = array();
                    if ($assessmentUsersMails->toArray() > 0) {
                        // dd($assessmentUsersMails);
                        foreach ($assessmentUsersMails as $row) {
                            if ($row->centralized_decentralized_type == 2) {
                                $assessmentUsersMailsD = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->get();
                                foreach ($assessmentUsersMailsD as $row1) {
                                    if ($row1->sub_role != null) {
                                        $sub_role_data = explode(',', $row1->sub_role);
                                        $check_if_exist = !empty(array_intersect($roles_external, $sub_role_data));
                                        if ($check_if_exist) {
                                            $title = "Idea Has Been Approved By " . $ATuser_first_name . " " . $ATuser_last_name . " (Assessment Team)";
                                            $description = "Idea Title : " . $idea_title;
                                            $receiver_id = $row->user_id;
                                            $role_curr = 'Approving Authority';
                                            send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                                            $send_mail_email[] = $row->email;
                                        }
                                    } //end of null
                                }
                            } else {
                                if ($row->sub_role != null) {
                                    $sub_role_data = explode(',', $row->sub_role);
                                    $check_if_exist = !empty(array_intersect($roles_external, $sub_role_data));
                                    if ($check_if_exist) {
                                        $title = "Idea Has Been Approved By " . $ATuser_first_name . " " . $ATuser_last_name . " (Assessment Team)";
                                        $description = "Idea Title : " . $idea_title;
                                        $receiver_id = $row->user_id;
                                        $role_curr = 'Approving Authority';
                                        send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                                        $send_mail_email[] = $row->email;
                                    }
                                }
                            }
                        }
                    }



                    //dd($send_mail_email);
                    //  Seding mail to Approving Authority Team wiht (C/D) condtion, admins and cc's
                    try {

                        $Subject1 = "The Idea Has Been Assessed And Sent For The Approval To The Approving Authority";
                        $Body1 = "
                    <html>
                    <head>

                    </head>
                        <body>
                            <h4>
                            The Idea Has Been Assessed And Approved By <strong>$ATuser_first_name $ATuser_last_name</strong> <br>
                            <strong>Assessment User e-mail</strong> : $ATuser_email<br>
                            Idea Title : <strong>" . htmlentities($idea_title) . "</strong>
                            </h4>
                        </body>
                    </html>";
                        // $mail->Send();

                        // $approving_auth_members = Users::where(['role' => 'Approving Authority', 'active_status' => 1])->get();
                        $roles_external = Rolesexternal::where(['role_type' => 'Approving Authority'])->pluck('id')->toArray();

                        $approving_auth_members = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                        $send_mail_email = array();
                        foreach ($approving_auth_members as $data) {
                            if ($data->centralized_decentralized_type == 1) {

                                $send_mail_email[] = $data->email;
                            }
                            //if decentralized then send mail to members of same company
                            else if ($data->centralized_decentralized_type == 0) {
                                $approving_auth_members1 = Users::where(['role' => 'Approving Authority', 'company_id' => $company_id, 'active_status' => 1])->get();
                                // dd($data->email);
                                foreach ($approving_auth_members1 as $data1) {
                                    //    mailCommunication($Subject1, $Body1, $data1->email);
                                    $send_mail_email[] = $data1->email;
                                }
                            }
                        }

                        $cc_mail_ids = array();
                        $cc_mails = EmailConfig::where('team', 'like', 'Approving Authority')->first();
                        if (isset($cc_mails->emails)) {
                            $cc_mail_ids = explode(',', $cc_mails->emails);
                        }

                        // mailCommunication($Subject1,$Body1,$user_email);
                        if (isset($send_mail_email) && count($send_mail_email) > 0) {
                            mailCommunication_multple($Subject1, $Body1, $cc_mail_ids, $send_mail_email);
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    // dd($send_mail_email);

                    // Email Notification code ends



                    return redirect()->route('ideas.view', ['id' => $id])->with('success', 'Idea Has Been successfully sent for the approval');

                    // }
                }   // end if if
            }
        }
    }

    //approved idead by AA and send for implementation
    public function approveIdeaBAA($id)
    {
        // dd('hey');
        $approve_user_role = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        //dd($approve_user_role->toArray());
        $status = Ideas::where('idea_id', $id)->first();
        $company_id = '';
        $company_id = Users::where('user_id', $status->user_id)->first();
        if (isset($company_id)) {
            $company_id = $company_id['company_id'];
        }

        // dd($status);
        if ($status->approving_authority_approval == 1) {
            return redirect()->route('ideas.view_idea_approving_authority', ['id' => $id, 'role' => request()->role]);
        } else {
            if (count($status->toArray()) > 0) {
                $status->approving_authority_approval = 1;
                $status->active_status = 'implementation';
                $idea_title = $status['title'];
                $user_email = '';
                $user_email = Users::where('user_id', $status['user_id'])->first();
                if ($user_email) {
                    $user_email = $user_email['email'];
                }
                $idea_status = new IdeaStatus;
                $idea_status->idea_id = request()->id;
                $idea_status->user_id = Auth::id();
                //$idea_status->user_role = Auth::user()->role;
                if (isset($approve_user_role->role_name)) {
                    $idea_status->user_role = $approve_user_role->role_name;
                }
                //dd($idea_status->user_role);
                $idea_status->idea_status = 'approving_authority_approved';
                $idea_status->save();
                $idea_uni_id = $status->idea_uni_id;
                if ($status->save()) {
                    $imple_team = array();
                    $centra_imple_id = array();
                    // $assessmentUsersMails = Users::where('company_id', $company_id)->where('role', 'Implementation')->get();
                    $roles_external = Rolesexternal::where(['role_type' => 'Implementation'])->pluck('id')->toArray();
                    // dd($roles_external);
                    // $imple_team = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                    $imple_team_centra = DB::table('users')->where(['active_status' => 1, 'centralized_decentralized_type' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                    if (isset($imple_team_centra) && count($imple_team_centra) > 0) {
                        foreach ($imple_team_centra as $centra_impl) {
                            $centra_imple_id = $centra_impl->user_id;
                            $imple_team[] = $centra_impl;
                        }
                        $imple_team_decentra = DB::table('users')->where(['active_status' => 1, 'centralized_decentralized_type' => 2, 'company_id' => $company_id])->whereNotIN('user_id', [$centra_imple_id])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                        //$imple_team[] = $centra_impl;
                        if (isset($imple_team_decentra) && count($imple_team_decentra) > 0) {
                            foreach ($imple_team_decentra as $decentra_impl) {
                                $imple_team[] = $decentra_impl;
                            }
                        }
                    } else {
                        $imple_team_decentra = DB::table('users')->where(['active_status' => 1, 'centralized_decentralized_type' => 2, 'company_id' => $company_id])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                        //$imple_team[] = $centra_impl;
                        if (isset($imple_team_decentra) && count($imple_team_decentra) > 0) {
                            foreach ($imple_team_decentra as $decentra_impl) {
                                $imple_team[] = $decentra_impl;
                            }
                        }
                    }

                    //dd($imple_team);

                    //$imple_team = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                    // first send to all centralised usres
                    // send to all decentralised users

                    $ATuser_first_name = Auth::user()->name;
                    $ATuser_last_name = Auth::user()->last_name;
                    $ATuser_email = Auth::user()->email;
                    // dd($imple_team);
                    //backend notify
                    $title = "Idea Has Been Approved By " . $ATuser_first_name . " " . $ATuser_last_name . " (Approving Authority)";
                    $description = "Idea Title : " . $idea_title;
                    send_backned_notification($idea_uni_id, $title, $description, Auth::id());


                    //notify user first
                    $title = "Idea Has Been Approved By " . $ATuser_first_name . " " . $ATuser_last_name . " (Approving Authority)";
                    $description = "Idea Title : " . $idea_title;
                    $receiver_id = $status['user_id'];
                    $role_curr = 'User';
                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);



                    //notify Imple Team
                    if (count($imple_team) > 0) {
                        foreach ($imple_team as $assessmentUser) {
                            $title = "Idea Has Been Approved By " . $ATuser_first_name . " " . $ATuser_last_name . " (Approving Authority)";
                            $description = "Idea Title : " . $idea_title;
                            $receiver_id = $assessmentUser->user_id;
                            $role_curr = 'Implementation';
                            send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                        }
                    }

                    //notify A.t Team
                    $assessmentUsersMails = '';
                    $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                    //   $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                    $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])
                        ->get();
                    $send_mail_email = array();
                    if ($assessmentUsersMails->toArray() > 0) {
                        foreach ($assessmentUsersMails as $assessmentUser) {
                            if ($assessmentUser->sub_role != null) {
                                $sub_role_data = explode(',', $assessmentUser->sub_role);
                                $check_if_exist = !empty(array_intersect($roles_external, $sub_role_data));
                                if ($check_if_exist) {
                                    $title = "Idea Has Been Approved By " . $ATuser_first_name . ' ' . $ATuser_last_name . " (Approving Authority)";
                                    $description = "Idea Title : " . $idea_title;
                                    $receiver_id = $assessmentUser->user_id;
                                    $role_curr = 'Assessment Team';
                                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                                }
                            }
                        }
                    }



                    // Email Notification code start



                    //  sending mail to implementation team members for same company,admins and cc's
                    try {
                        // dd($email);
                        // $mail->addAddress($user_email, 'Jmbaxi');
                        $Subject = "The Idea Has Been Approved By Approving Authority";
                        $Body = "
                    <html>
                    <head>

                    </head>
                        <body>
                            <h4>
                                Idea Has Been Approved By <strong>$ATuser_first_name $ATuser_last_name</strong> <br>
                                <strong>Approving Authority User e-mail</strong> : $ATuser_email
                                <br>
                                Idea Title : <strong>" . htmlentities($idea_title) . "</strong>
                            </h4>
                        </body>
                    </html>";
                        // $mail->Send();
                        // $imple_team_members = Users::where(['role' => 'Implementation', 'company_id' => $company_id, 'active_status' => 1])->get();
                        $roles_external = Rolesexternal::where(['role_type' => 'Implementation'])->pluck('id')->toArray();
                        //$imple_team_members = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                        $imple_team_members = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->get();
                        //   dd($imple_team_members, $roles_external);
                        // foreach ($imple_team_members as $data) {
                        //     mailCommunication($Subject, $Body, $data->email);
                        // }

                        //dd($imple_team_members );
                        $send_mail_email = array();
                        // foreach ($imple_team_members as $implm) {
                        //     if ($implm->sub_role != null) {
                        //         $sub_role_data = explode(',', $implm->sub_role);
                        //         $check_if_exist = !empty(array_intersect($roles_external, $sub_role_data));
                        //         if ($check_if_exist) {
                        //         //    $send_mail_email[] = $assessmentUser->email;
                        //         }
                        //     }
                        // }

                        if (count($imple_team) > 0) {
                            foreach ($imple_team as $assessmentUser) {
                                $send_mail_email[] = $assessmentUser->email;
                            }
                        }
                        // dd($send_mail_email);

                        $cc_mail_ids = array();
                        $cc_mails = EmailConfig::where('team', 'like', 'Implementation Team')->first();
                        if (isset($cc_mails->emails)) {
                            $cc_mail_ids = explode(',', $cc_mails->emails);
                        }

                        $send_mail_email = array_unique($send_mail_email);
                        if (isset($send_mail_email) && count($send_mail_email) > 0) {
                            mailCommunication_multple($Subject, $Body,  $cc_mail_ids, $send_mail_email);
                        }
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage();
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    // Email Notification code ends

                    return redirect()->route('ideas.view_idea_approving_authority', ['id' => $id])->with('success', 'Idea Has Been successfully Approved');
                }
            }
        }
    }


    // Change the flag of implemented to 1 and send mail notification
    public function idea_implemented($id)
    {
        $approve_user_role = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();

        $status = Ideas::where('idea_id', $id)->first();
        $company_id = '';
        $company_id = Users::where('user_id', $status->user_id)->first();
        if (isset($company_id)) {
            $company_id = $company_id['company_id'];
        }
        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();

        if ($status->implemented == 1) {
            return redirect()->route('ideas.view', ['id' => $id, 'role' => request()->role]);
        } else {
            $status->active_status = 'implemented';
            $idea_title = $status['title'];
            $idea_status = new IdeaStatus;
            if (count($status->toArray()) > 0) {
                $status->implemented = 1;
                $idea_status->idea_id = request()->id;
                $idea_status->user_id = Auth::id();
                //$idea_status->user_role = Auth::user()->role;
                if (isset($approve_user_role->role_name)) {
                    $idea_status->user_role = $approve_user_role->role_name;
                }
                $idea_status->idea_status = 'implemented';
                $idea_status->save();
                $idea_uni_id = $status->idea_uni_id;
                //$a = 0;
                if ($status->save()) {
                    //    if ($a == 0) {
                    //             dd('in');
                    $ATuser_first_name = Auth::user()->name;
                    $ATuser_last_name = Auth::user()->last_name;
                    $ATuser_email = Auth::user()->email;

                    // $notification = new Notification();
                    // $notification->idea_uni_id = $idea_uni_id;
                    // $notification->title = 'Idea has been Implemented by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Implementation Team)';
                    // $notification->description = 'Idea Title : ' . $idea_title;
                    // $notification->receiver_id = $status['user_id'];
                    // $notification->role = $roles_external->role_type;
                    // $notification->save();
                    //$roles_external = Rolesexternal::where(['role_type' => 'Approving Authority'])->pluck('id')->toArray();
                    $roles_external = Rolesexternal::where(['role_type' => 'Approving Authority'])->pluck('id')->toArray();
                    $Approv_team = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])
                        ->get(); // DB::table('users')->where(['active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                    $ATuser_first_name = Auth::user()->name;
                    $ATuser_last_name = Auth::user()->last_name;
                    $ATuser_email = Auth::user()->email;





                    //notify user first
                    $title = 'Idea Has Been Implemented By ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Implementation Team)';
                    $description = "Idea Title : " . $idea_title;
                    $receiver_id = $status['user_id'];
                    $role_curr = 'User';
                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);



                    //notify A.A Team
                    if ($Approv_team->toArray() > 0) {
                        foreach ($Approv_team as $row) {
                            if ($row->centralized_decentralized_type == 2) {
                                $assessmentUsersMailsD = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1, 'user_id' => $row->user_id])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();

                                foreach ($assessmentUsersMailsD as $row1) {
                                    $title = 'Idea Has Been Implemented By ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Implementation Team)';
                                    $description = "Idea Title : " . $idea_title;
                                    $receiver_id = $row1->user_id;
                                    $role_curr = 'Approving Authority';
                                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                                }
                            } else {

                                $title = 'Idea Has Been Implemented By ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Implementation Team)';
                                $description = "Idea Title : " . $idea_title;
                                $receiver_id = $row->user_id;
                                $role_curr = 'Approving Authority';
                                send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                            }
                        }
                    }

                    //notify A.t Team
                    $assessmentUsersMails = '';
                    $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                    //  $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                    $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])
                        ->get();
                    if ($assessmentUsersMails->toArray() > 0) {
                        foreach ($assessmentUsersMails as $assessmentUser) {
                            if ($assessmentUser->sub_role != null) {
                                $sub_role_data = explode(',', $assessmentUser->sub_role);
                                $check_if_exist = !empty(array_intersect($roles_external, $sub_role_data));
                                if ($check_if_exist) {
                                    $title = 'Idea Has Been Implemented By ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Implementation Team)';
                                    $description = "Idea Title : " . $idea_title;
                                    $receiver_id = $assessmentUser->user_id;
                                    $role_curr = 'Assessment Team';
                                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                                }
                            }
                        }
                    }


                    //backend notify
                    $idea_uni_id = $idea_uni_id;
                    $title = 'Idea Has Been Implemented By ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Implementation Team)';
                    $description = "Idea Title : " . $idea_title;
                    send_backned_notification($idea_uni_id, $title, $description, Auth::id());

                    // Email Notification code ends

                    //send mail to user,admins and cc's once successfully impelementated
                    try {

                        $Subject = "The Idea Has Been Implemented By Implementation Team";
                        $Body = "
                          <html>
                          <head>

                          </head>
                              <body>
                                  <h4>
                                  Your Idea Has Been Implemented By <strong>" . $ATuser_first_name . ' ' . $ATuser_last_name . "</strong> <br>
                                  <strong>User E-mail Of Implementation Team</strong> : " . $ATuser_email . "
                                  <br>
                                  Idea Title : <strong>" . htmlentities($idea_title) . "</strong>
                                  </h4>
                              </body>
                          </html>";
                        $ideas = Ideas::where('idea_id', $id)->first();
                        $users = Users::where(['user_id' => $ideas->user_id, 'active_status' => 1])->first();
                        // $mail->Send();

                        // $cc_mail_ids = array();
                        // $cc_mails = EmailConfig::whereNULL('deleted_at')->get();
                        // if(isset($cc_mails)){
                        //     $cc_mail_ids = explode(',',$cc_mails->emails);
                        // }


                        $cc_mail_ids = array();
                        $cc_mails = array();
                        $all_cc_mails = EmailConfig::whereNULL('deleted_at')->get();
                        if (isset($all_cc_mails) && count($all_cc_mails) > 0) {
                            foreach ($all_cc_mails as $cc_mail) {
                                if (isset($cc_mail->emails)) {
                                    $cc_mails[] = explode(',', $cc_mail->emails);
                                }
                            }
                        }

                        if (isset($cc_mails) && count($cc_mails) > 0) {
                            foreach ($cc_mails as $index => $cc) {

                                if (count($cc) > 1) {
                                    foreach ($cc as $sub) {
                                        $cc_mail_ids[] = [$sub];
                                    }
                                } else {
                                    $cc_mail_ids[] = $cc;
                                }
                            }

                            $temp_mails = array();
                            foreach ($cc_mail_ids as $key => $mids) {
                                $temp_mails[] = $mids[0];
                            }
                        }
                        $cc_mail_ids = $temp_mails;
                        //Code goes to Here
                        mailCommunication($Subject, $Body, $cc_mail_ids, $users->email);
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage();
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    return redirect()->route('ideas.view_idea_implementation_team', ['id' => $id])->with('success', 'Idea has been successfully Implemented');
                }
            }
        }
    }

    public function ajax_get_images_modal(Request $request)
    {
        //dd($request->all());
        $files = IdeaImages::where('idea_uni_id', $request->idea_uni_id)->get();

        if ($files) {
            foreach ($files as $file) {
                // dd($image);
                $fileNameParts = explode('.', $file->file_name);
                $ext = end($fileNameParts);
                // dump((asset('storage/app/public/' . $file->image_path)));
                if (Storage::disk('local')->exists('/public/' . $file->image_path)) {
                    if ($ext == 'doc' || $ext == 'docx' || $ext == 'txt' || $ext == 'xlsx') {
                        $img_path = asset('storage/app/public/uploads/asset/doc.png');
                    } elseif ($ext == 'pdf') {
                        $img_path = asset('storage/app/public/uploads/asset/pdf.png');
                    } elseif ($ext == 'mp4' || $ext == 'mov' || $ext == 'avi') {
                        $img_path = asset('storage/app/public/uploads/asset/vid.png');
                    } else {
                        $img_path = asset('storage/app/public/' . $file->image_path);
                    }
                } else {
                    $img_path = '';
                }
                if ($img_path == '') {
                    echo '<p>File is not available</p>';
                    clearstatcache();
                } else {
                    echo '
                    <a style="margin-top:10px;" class="test-popup-link" href=' . asset('storage/app/public/' . $file->image_path) . ' target="_blank">
                        <img alt="Idea file" style="width:200px;height:200px;object-fit:contain;border:1px solid rgb(0,0,0,);padding:5px;" src=' . $img_path . ' />
                    </a>';
                }
            }
        }
    }


    public function ajax_get_idea_revision_images_modal(Request $request)
    {
        $files = IdeaRevisionImages::where('idea_uni_id', $request->idea_uni_id)->get();

        // dd($files->toArray());

        if ($files) {
            foreach ($files as $file) {
                // dd($image);
                $fileNameParts = explode('.', $file->file_name);
                $ext = end($fileNameParts);
                if (Storage::disk('local')->exists('/public/' . $file->image_path)) {
                    if ($ext == 'doc' || $ext == 'docx' || $ext == 'txt' || $ext == 'xlsx') {
                        $img_path = asset('storage/app/public/uploads/asset/doc.png');
                    } elseif ($ext == 'pdf') {
                        $img_path = asset('storage/app/public/uploads/asset/pdf.png');
                    } elseif ($ext == 'mp4' || $ext == 'mov' || $ext == 'avi') {
                        $img_path = asset('storage/app/public/uploads/asset/vid.png');
                    } else {
                        $img_path = asset('storage/app/public/' . $file->image_path);
                    }
                } else {
                    $img_path = '';
                }


                if ($img_path == '') {
                    echo '<p>File is not available</p>';
                } else {
                    echo '
                    <a style="margin-top:10px;" class="test-popup-link" href=' . asset('storage/app/public/' . $file->image_path) . ' target="_blank">
                        <img alt="Idea file" style="width:200px;height:200px;object-fit:contain;border:1px solid rgb(0,0,0,);padding:5px;" src=' . $img_path . ' />
                    </a>';
                }
            }
        }
    }
    // To delte image in edit idea page
    public function delete_image($id)
    {
        $image = IdeaImages::where('image_id', $id)->get();
        if (count($image) > 0) {
            $image = IdeaImages::where('image_id', $id)->first();
            // $ideaRevisionImage = IdeaRevisionImages::where('image_link', $image->image_link)->first();
            Storage::disk('local')->delete('/public/' . $image->image_path);
            // Storage::disk('local')->delete('/public/' . $ideaRevisionImage->image_path);
            // IdeaRevisionImages::where('image_link', $image->image_link)->delete();
            if (IdeaImages::where('image_id', $id)->delete()) {
                // dd(Storage::disk('local'));
                return redirect()->back()->with('success', 'Idea Image has been deleted');
            } else {
                return redirect()->back()->with('error', 'Failed to Delete the Image');
            }
        }
    }
    public function getChartValues()
    {
        $response = array();
        $data = array();
        $role = Auth::user()->role;
        $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
        foreach ($months as $key => $month) {
            if ($role == 'User') {
                $ideas = Ideas::whereMonth('created_at', $key)->whereYear('created_at', date('Y'))->where('user_id', Auth::user()->user_id)->get();

                $query = Ideas::whereMonth('created_at', $key)->whereYear('created_at', date('Y'))->where('user_id', Auth::user()->user_id)->toSql();
                dump($key, date('Y'), Auth::user()->user_id);
                dump($query);
                $data['x'] = $month;
                //   dd(($ideas));
                $data['y'] = count($ideas);
            } elseif ($role == 'Assessment Team') {
                $ideas = Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id);
                })->whereMonth('created_at', $key)->get();
                $data['x'] = $month;
                $data['y'] = count($ideas);
            } elseif ($role == 'Approving Authority') {
                $ideas = Ideas::whereMonth('created_at', $key)->get();
                $data['x'] = $month;
                $data['y'] = count($ideas);
            } elseif ($role == 'Implementation') {
                $ideas = Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id);
                })->whereMonth('created_at', $key)->get();
                $data['x'] = $month;
                $data['y'] = count($ideas);
            }
            array_push($response, $data);
        }

        // for ($i = 1; $i >= 12; $i++) {
        //     $ideas = Ideas::whereMonth('created_at', $i)->get();
        //     $data['month'] = $months[$i];
        //     $data['count'] = count($ideas);
        //     dump($i);
        //     array_push($response['response'], $data);
        // }
        echo json_encode($response);
    }

    public function update_revision_status_on_user($id)
    {
        // dd($reason);
        // $data = FacadesDB::table('ideas')->where(['idea_id'=>$id,'asstmnt_rev_status'=>1])->get();
        FacadesDB::table('ideas')->where('idea_id', $id)->update(['asstmnt_rev_status' => 1]);

        $ATuser_first_name = Auth::user()->name;
        $ATuser_last_name = Auth::user()->last_name;
        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        $role = $roles_external->role_type;
        $status = Ideas::where('idea_id', $id)->first();
        // dd($status);
        $idea_title = $status->title;
        $idea_desc = $status->description;
        $idea_uni_id = $status->idea_uni_id;


        //notify user
        $title = "The Status Of Idea Has Been Changed To Revise Request(Reason : " . $status->resubmit_reason . " ) by " . $ATuser_first_name . " " . $ATuser_last_name . " (" . $role . ")";
        $description = "Idea Title : " . $idea_title;
        $receiver_id = $status['user_id'];
        $role_curr = 'User';
        $updated = send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);




        // if ($updated) {
        FacadesDB::table('ideas')->where('idea_id', $id)->update(['approv_rev_status' => 1]);

        $user_email = '';
        $user_email = Users::where('user_id', $status['user_id'])->first();
        if ($user_email) {
            $user_email = $user_email['email'];
        }
        // dd($email);

        // $mail->addAddress($user_email, 'Jmbaxi');
        $Subject = "Idea Has Been Revised";
        $Body = "
            <html>
             <head>

            </head>
            <body>
            <h4>
                Idea Title : <strong>" . htmlentities($idea_title) . "</strong><br>
                Idea Desciption : " . htmlentities($idea_desc) . "<br>
                Reason of Revise : " . htmlentities($status->resubmit_reason) . "
            </h4>
            </body>
            </html>";
        $cc_mail_ids  = array();
        mailCommunication($Subject, $Body, $cc_mail_ids, $user_email);
        // }

        return redirect()->route('ideas.view', ['id' => $id])->with('success', 'Idea Status Has Been Updated For User');
    }

    public function updateIdeaConfirmation(Request $request)
    {
        //     $idea = new IdeaJourney();
        $user = Users::where('user_id', Auth::user()->user_id)->first();
        $user_role_final = (isset($user->sub_role_final) ? $user->sub_role_final : 0);


        $assesment_role = Rolesexternal::where('role_type', 'Assessment Team')->get('id');

        $journey = IdeaJourney::where('idea_id', $request->idea_id)->where(function ($query) use ($assesment_role, $user_role_final) {
            $query->whereIN('final_role_id', $assesment_role);
            $query->orwhere('final_role_id', $user_role_final);
        })->first();
        if (!$journey) {
            $journey = new IdeaJourney();
        }

        //  $journey->idea_description = $request->assessment_idea_clarity;
        //  $journey->outcome = $request->assessment_outcome;
        //  $journey->why_implemented = $request->assessment_why_implemented;
        //  $journey->challenges = $request->assessment_challenges;
        //  $journey->idea_not_implemented = $request->assessment_is_no_implemented;
        //  $journey->has_alternatives = $request->assessment_has_alternatives;
        //  $journey->has_less_benifits = $request->assessment_has_less_benifits;
        // $journey->benifits = $request->benifits;

        $journey->remarks = $request->remarks;
        $journey->idea_id = $request->idea_id;

        $journey->user_id = Auth::user()->user_id;
        $journey->final_role_id = $user_role_final;

        if ($journey->save()) {
            return true;
        } else {
            return false;
        }
    }


    //updated by usama_13-02-2024   
    public function LikeDislike(Request $request)
    {
        //     $idea = new IdeaJourney();
        $user = Users::where('user_id', Auth::user()->user_id)->first();
      
        $user_role_final = (isset($user->sub_role_final) ? $user->sub_role_final : 0);

        $journey = IdeaJourney::where(['idea_id'=>$request->idea_id,'user_id' => $request->user_id,'final_role_id'=>$user_role_final])->first();
        if (!$journey) {
            $journey = new IdeaJourney();
        }

        $journey->idea_id = $request->idea_id;
        $journey->user_id = $request->user_id;

        if ($request->col_name == 'assessment_idea_clarity')
            $journey->idea_description = $request->btn_name;

        if ($request->col_name == 'assessment_outcome')
            $journey->outcome = $request->btn_name;

        if ($request->col_name == 'assessment_why_implemented')
            $journey->why_implemented = $request->btn_name;

        if ($request->col_name == 'assessment_challenges')
            $journey->challenges = $request->btn_name;

        if ($request->col_name == 'assessment_is_no_implemented')
            $journey->idea_not_implemented = $request->btn_name;

        if ($request->col_name == 'assessment_has_alternatives')
            $journey->has_alternatives = $request->btn_name;

        if ($request->col_name == 'assessment_has_less_benifits')
            $journey->has_less_benifits = $request->btn_name;

        if ($request->col_name == 'benifits')
            $journey->benifits = $request->btn_name;

        $journey->final_role_id = $user_role_final;

        // dd($journey);
        if ($journey->save()) {
            return json_encode($journey);
        } else {
            return false;
        }
    }


    public function updateIdeaConfirmationApprover(Request $request)
    {
        //     $idea = new IdeaJourney();
        $user = Users::where('user_id', Auth::user()->user_id)->first();
        $user_role_final = (isset($user->sub_role_final) ? $user->sub_role_final : 0);


        $assesment_role = Rolesexternal::where('role_type', 'Approving Authority')->get('id');

        $journey = IdeaJourney::where('idea_id', $request->idea_id)->where(function ($query) use ($assesment_role, $user_role_final) {
            $query->whereIN('final_role_id', $assesment_role);
            $query->orwhere('final_role_id', $user_role_final);
        })->first();
        if (!$journey) {
            $journey = new IdeaJourney();
        }

        $journey->idea_description = $request->assessment_idea_clarity;
        $journey->outcome = $request->assessment_outcome;
        $journey->why_implemented = $request->assessment_why_implemented;
        $journey->challenges = $request->assessment_challenges;
        $journey->idea_not_implemented = $request->assessment_is_no_implemented;
        $journey->has_alternatives = $request->assessment_has_alternatives;
        $journey->has_less_benifits = $request->assessment_has_less_benifits;
        $journey->benifits = $request->benifits;
        $journey->remarks = $request->remarks;
        $journey->idea_id = $request->idea_id;
        $journey->user_id = Auth::user()->user_id;
        $journey->final_role_id = $user_role_final;

        if ($journey->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function reject_idea_implementor(Request $request)
    {

        $idea_id = $request->idea_id;
        $ATuser_first_name = Auth::user()->name;
        $ATuser_last_name = Auth::user()->last_name;

        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        $role = (isset($roles_external->role_type) ? $roles_external->role_type : '');

        $company_id = '';
        $company_id = Users::where('user_id', Auth::id())->first();
        if (isset($company_id)) {
            $company_id = $company_id['company_id'];
        }

        $idea = Ideas::where('idea_id', $idea_id)->first();
        //   dd($idea->toArray(), $request->all());
        if ($idea) {
            $idea_creator = (isset($idea->user_id) ? $idea->user_id : 0);
            $idea_uni_id = (isset($idea->idea_uni_id) ? $idea->idea_uni_id : 0);
            $idea->failed_to_implement = 1;
            $idea->active_status = 'reject';
            $idea->reject_reason = $request->reject_reason;
            $idea->rejected = 1;
            $idea->failed_to_implement_reasone = $request->reason;
            $idea->reject_implementor_id = Auth::user()->user_id;
            $idea->save();

            //send notification to the  user
            //reject request goes throu any aproval it is different that
            $title = 'The Idea Cannot be Implement(Reason : ' . $request->reason . ' ) by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
            $description = "Idea Title : " . (isset($idea->title) ? $idea->title : '');
            $receiver_id = $idea_creator;
            $role_curr = 'User';
            send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);

            $assessmentUsersMails = '';
            $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
            $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->get();
            //notify At.Team first

            if ($role == 'Approving Authority') {
                $send_mail_email = array();
                foreach ($assessmentUsersMails as $assessmentUser) {
                    $title = "The Idea Cannot be Implement (Reason : " . $request->reject_reason . " ) by " . $ATuser_first_name . " " . $ATuser_last_name . " (" . $role . ") ";
                    $description = "Idea Title : " .  (isset($idea->title) ? $idea->title : '');
                    $receiver_id = $assessmentUser->user_id;
                    $role_curr = 'Assessment Team';
                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                    $send_mail_email[] = $assessmentUser->email;
                }
            }


            //backend notify
            $idea_uni_id = $idea_uni_id;
            $title = "The Idea Cannot be Implement  (Reason : " . $request->reject_reason . " ) by " . $ATuser_first_name . " " . $ATuser_last_name .  " (" . $role . ")";
            $description = "Idea Title : " . (isset($idea->title) ? $idea->title : '');
            send_backned_notification($idea_uni_id, $title, $description, Auth::id());

            $idea_title = (isset($idea->title) ? $idea->title : '');
            $idea_desc = (isset($idea->description) ? $idea->description : '');
            $approve_user_role = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
            $idea_status = new IdeaStatus;
            // dd($status->toArray());
            if ($idea) {
                $idea_status->idea_id = $request->idea_id;
                $idea_status->user_id = Auth::id();
                //$idea_status->user_role = Auth::user()->role;
                if (isset($approve_user_role->role_name)) {
                    $idea_status->user_role = $approve_user_role->role_name;
                }
                $idea_status->idea_status = 'rejected';
                $idea_status->save();

                //sending mail to user,admins and cc's if Asstmnt Team or AA Team Rejects
                try {
                    $user_email = '';
                    $user_email = Users::where('user_id', $idea->user_id)->first();
                    if ($user_email) {
                        $user_email = $user_email->email;
                    }
                    // dd($email);

                    // $mail->addAddress($user_email, 'Jmbaxi');
                    $Subject = "Idea Cannot be Implement";
                    $Body = "
                     <html>
                     <head>

                     </head>
                         <body>
                             <h4>
                                 Idea Title : <strong>" . htmlentities($idea_title) . "</strong><br>
                                 Idea Desciption : " . htmlentities($idea_desc) . "<br>
                                 Reason of Rejection : " . htmlentities($request->reason) . "
                             </h4>
                         </body>
                     </html>";
                    // $mail->Send();
                    $cc_mail_ids = array();
                    mailCommunication($Subject, $Body, $cc_mail_ids, $user_email);
                } catch (phpmailerException $e) {
                    echo $e->errorMessage();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                // Email Notification code ends
            }
            return redirect()->back()->with('success', 'Idea Status has been Updated');
            //edd of if
        } else {
            return redirect()->back()->with('error', 'Idea Not Found');
        }
    }

    public function ApproveIdeaWithBudget(Request $request)
    {

        $approve_user_role = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        //dd($approve_user_role->toArray());
        $status = Ideas::where('idea_id', $request->idea_id)->first();

        $company_id = '';
        $company_id = Users::where('user_id', $status->user_id)->first();
        if (isset($company_id)) {
            $company_id = $company_id['company_id'];
        }

        // dd($status);
        if ($status->approving_authority_approval == 1) {
            return redirect()->route('ideas.view_idea_approving_authority', ['id' => $request->idea_id, 'role' => request()->role]);
        } else {
            if (count($status->toArray()) > 0) {
                $status->approving_authority_approval = 1;
                $status->active_status = 'implementation';

                // add budget details
                $status->estimate_budget = $request->estimate_budget;
                $status->expenses_approved = $request->expenses_approved;
                $status->expenses_incurred = $request->expenses_incurred;
                $status->expenses_approved_company = $request->expenses_approved_company;
                $status->spoc_details = $request->spoc_details;

                //','','expenses_approved_company','spoc_details'
                $idea_title = $status['title'];
                $user_email = '';
                $user_email = Users::where('user_id', $status['user_id'])->first();
                if ($user_email) {
                    $user_email = $user_email['email'];
                }
                $idea_status = new IdeaStatus;
                $idea_status->idea_id = $request->idea_id;
                $idea_status->user_id = Auth::id();
                //$idea_status->user_role = Auth::user()->role;
                if (isset($approve_user_role->role_name)) {
                    $idea_status->user_role = $approve_user_role->role_name;
                }
                //dd($idea_status->user_role);
                $idea_status->idea_status = 'approving_authority_approved';
                $idea_status->save();
                $idea_uni_id = $status->idea_uni_id;
                if ($status->save()) {
                    $imple_team = array();
                    $centra_imple_id = array();
                    // $assessmentUsersMails = Users::where('company_id', $company_id)->where('role', 'Implementation')->get();
                    $roles_external = Rolesexternal::where(['role_type' => 'Implementation'])->pluck('id')->toArray();
                    // dd($roles_external);
                    // $imple_team = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                    $imple_team_centra = DB::table('users')->where(['active_status' => 1, 'centralized_decentralized_type' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                    if (isset($imple_team_centra) && count($imple_team_centra) > 0) {
                        foreach ($imple_team_centra as $centra_impl) {
                            $centra_imple_id = $centra_impl->user_id;
                            $imple_team[] = $centra_impl;
                        }
                        $imple_team_decentra = DB::table('users')->where(['active_status' => 1, 'centralized_decentralized_type' => 2, 'company_id' => $company_id])->whereNotIN('user_id', [$centra_imple_id])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                        //$imple_team[] = $centra_impl;
                        if (isset($imple_team_decentra) && count($imple_team_decentra) > 0) {
                            foreach ($imple_team_decentra as $decentra_impl) {
                                $imple_team[] = $decentra_impl;
                            }
                        }
                    } else {
                        $imple_team_decentra = DB::table('users')->where(['active_status' => 1, 'centralized_decentralized_type' => 2, 'company_id' => $company_id])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                        //$imple_team[] = $centra_impl;
                        if (isset($imple_team_decentra) && count($imple_team_decentra) > 0) {
                            foreach ($imple_team_decentra as $decentra_impl) {
                                $imple_team[] = $decentra_impl;
                            }
                        }
                    }

                    //dd($imple_team);

                    //$imple_team = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                    // first send to all centralised usres
                    // send to all decentralised users

                    $ATuser_first_name = Auth::user()->name;
                    $ATuser_last_name = Auth::user()->last_name;
                    $ATuser_email = Auth::user()->email;
                    // dd($imple_team);
                    //backend notify
                    $title = "Idea Has Been Approved By " . $ATuser_first_name . " " . $ATuser_last_name . " (Approving Authority)";
                    $description = "Idea Title : " . $idea_title;
                    send_backned_notification($idea_uni_id, $title, $description, Auth::id());


                    //notify user first
                    $title = "Idea Has Been Approved By " . $ATuser_first_name . " " . $ATuser_last_name . " (Approving Authority)";
                    $description = "Idea Title : " . $idea_title;
                    $receiver_id = $status['user_id'];
                    $role_curr = 'User';
                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);



                    //notify Imple Team
                    if (count($imple_team) > 0) {
                        foreach ($imple_team as $assessmentUser) {
                            $title = "Idea Has Been Approved By " . $ATuser_first_name . " " . $ATuser_last_name . " (Approving Authority)";
                            $description = "Idea Title : " . $idea_title;
                            $receiver_id = $assessmentUser->user_id;
                            $role_curr = 'Implementation';
                            send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                        }
                    }

                    //notify A.t Team
                    $assessmentUsersMails = '';
                    $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                    //   $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                    $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])
                        ->get();
                    $send_mail_email = array();
                    if ($assessmentUsersMails->toArray() > 0) {
                        foreach ($assessmentUsersMails as $assessmentUser) {
                            if ($assessmentUser->sub_role != null) {
                                $sub_role_data = explode(',', $assessmentUser->sub_role);
                                $check_if_exist = !empty(array_intersect($roles_external, $sub_role_data));
                                if ($check_if_exist) {
                                    $title = "Idea Has Been Approved By " . $ATuser_first_name . ' ' . $ATuser_last_name . " (Approving Authority)";
                                    $description = "Idea Title : " . $idea_title;
                                    $receiver_id = $assessmentUser->user_id;
                                    $role_curr = 'Assessment Team';
                                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                                }
                            }
                        }
                    }



                    // Email Notification code start



                    //  sending mail to implementation team members for same company,admins and cc's
                    try {
                        // dd($email);
                        // $mail->addAddress($user_email, 'Jmbaxi');
                        $Subject = "The Idea Has Been Approved By Approving Authority";
                        $Body = "
                    <html>
                    <head>

                    </head>
                        <body>
                            <h4>
                                Idea Has Been Approved By <strong>$ATuser_first_name $ATuser_last_name</strong> <br>
                                <strong>Approving Authority User e-mail</strong> : $ATuser_email
                                <br>
                                Idea Title : <strong>" . htmlentities($idea_title) . "</strong>
                            </h4>
                        </body>
                    </html>";
                        // $mail->Send();
                        // $imple_team_members = Users::where(['role' => 'Implementation', 'company_id' => $company_id, 'active_status' => 1])->get();
                        $roles_external = Rolesexternal::where(['role_type' => 'Implementation'])->pluck('id')->toArray();
                        //$imple_team_members = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                        $imple_team_members = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->get();


                        //dd($imple_team_members );
                        $send_mail_email = array();


                        if (count($imple_team) > 0) {
                            foreach ($imple_team as $assessmentUser) {
                                $send_mail_email[] = $assessmentUser->email;
                            }
                        }
                        // dd($send_mail_email);

                        $cc_mail_ids = array();
                        $cc_mails = EmailConfig::where('team', 'like', 'Implementation Team')->first();
                        if (isset($cc_mails->emails)) {
                            $cc_mail_ids = explode(',', $cc_mails->emails);
                        }

                        $send_mail_email = array_unique($send_mail_email);
                        if (isset($send_mail_email) && count($send_mail_email) > 0) {
                            mailCommunication_multple($Subject, $Body,  $cc_mail_ids, $send_mail_email);
                        }
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage();
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    // Email Notification code ends

                    return redirect()->route('ideas.view_idea_approving_authority', ['id' => $request->idea_id])->with('success', 'Idea Has Been successfully Approved');
                }
            }
        }
    }

    public function UpdateBudgetDetails(Request $request)
    {
        $idea = Ideas::where('idea_id', $request->idea_id)->first();
        if ($idea) {
            $idea->estimate_budget = $request->estimate_budget;
            $idea->expenses_approved = $request->expenses_approved;
            $idea->expenses_incurred = $request->expenses_incurred;
            $idea->expenses_approved_company = $request->expenses_approved_company;
            $idea->spoc_details = $request->spoc_details;
            if ($idea->save()) {
                return true;
            } else {
                return false;
            }
        }
    }
}
