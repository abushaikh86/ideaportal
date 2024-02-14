<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\frontend\Ideas;
use App\Models\frontend\Users;
use App\Models\frontend\Feedback;
use App\Models\frontend\Department;
use App\Http\Controllers\Controller;

use App\Models\backend\AdminUsers;
use App\Models\frontend\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\frontend\IdeaRevision;
use App\Models\frontend\Notification as FrontendNotification;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use App\Models\backend\Category;
use App\Models\backend\Company;

use App\Models\frontend\IdeaImages;

use App\Models\backend\Location;
use App\Models\backend\SLA;
use App\Models\frontend\IdeaActiveStatus;
use App\Models\frontend\IdeaJourney;
use App\Models\Rolesexternal;
use Yajra\DataTables\DataTables;


class IdeaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('auth',['except'=>['ajax_get_images_modal']]);
    }
    public function dashboard()
    {
        return view('frontend.users.dashboard_new');
    }
    public function ideaManagement(Request $request)
    {

        // $admin_id = Auth::id();
        // $data = AdminUsers::where(['admin_user_id' => $admin_id, 'centralized_decentralized_type' => 2])->first();
        // if (!empty($data)) {
        //     $user_data = Users::where(['active_status' => 1, 'company_id' => $data->company_id])->pluck('user_id');
        //     $idea_data = Ideas::whereIn('user_id', $user_data)->orderBy('idea_id', 'DESC')->get();

        // } else {
        //     $idea_data = Ideas::orderBy('idea_id', 'DESC')->get();
        // }
        // return view('backend.ideaManagement.ideaManagement', ['ideas' => $idea_data]);
        // dd($request->all());

        if ($request->ajax()) {


            $admin_id = Auth::id();
            $data = AdminUsers::where(['admin_user_id' => $admin_id, 'centralized_decentralized_type' => 2])->first();
            if (!empty($data)) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $data->company_id])->pluck('user_id');
                $idea_data = Ideas::whereIn('user_id', $user_data)->orderBy('idea_id', 'DESC')->get();
            } else {
                $idea_data = Ideas::orderBy('idea_id', 'DESC')->get();
            }

            if ($request->filled('from_date') && $request->filled('to_date')) {

                // $startdate = $request->from_date."00:00:00";
                // $enddate = $request->to_date."23:59:59";


                // $idea_data = Ideas::whereBetween('created_at', [$startdate, $enddate])->get();
                $idea_data = Ideas::whereBetween('created_at', [$request->from_date, $request->to_date])->orderBy('idea_id', 'desc')->get();



                // dd($idea_data);
            }

            return DataTables::of($idea_data)
                ->addIndexColumn()
                ->addColumn('idea_id', function ($idea_data) {
                    return isset($idea_data->idea_id) ? '000' . $idea_data->idea_id : '';
                })
                ->addColumn('name', function ($idea_data) {
                    $user = Users::where('user_id', $idea_data->user_id)->first();

                    if (isset($user)) {

                        return  $user['name'] . ' ' . $user['last_name'];
                    } else {
                        return '';
                    }
                })
                ->addColumn('title', function ($idea_data) {
                    return isset($idea_data->title) ? $idea_data->title : '';
                })

                ->addColumn('files', function ($idea_data) {

                    $image_path = $idea_data['image_path'];
                    $full_image_path = 'storage/app/public/' . $image_path;
                    $extArr = explode('.', $image_path);
                    $ext = end($extArr);

                    $files = IdeaImages::where('idea_uni_id', $idea_data->idea_uni_id)->get();

                    if (count($files) > 0) {

                        return    "<a href='#' class='images_modal_class'
                        data-id='" . $idea_data->idea_uni_id . "'>" . count($files) . ' files' . "</a>";
                    } else {
                        return  '<p>No files yet</p>';
                    }
                })

                ->addColumn('created_at', function ($idea_data) {
                    return explode(' ', $idea_data['created_at'])[0];
                })
                ->addColumn('company_name', function ($idea_data) {
                    $company_id = $idea_data->company_data->company_id ?? '';
                    $company = Company::where('company_id', $company_id)->pluck('company_name');

                    return $company[0] ?? '';
                })
                ->addColumn('status', function ($idea_data) {

                    // $status = '';
                    // $status_color = "";
                    // $idea_status = $idea_data->active_status;
                    // if ($idea_status == 'in_assessment') {
                    //     $status_color = "badge-outline-primary";
                    //   //  $status = "Approved by Assesment Team";
                    //     $status_color = "badge-outline-primary";
                    //     if ($idea_data->assessment_team_approval == 1) {
                    //         $status = 'Approved by Assessment Team';
                    //     } else {
                    //         $status = 'Processed for Approval';
                    //     }
                    // } elseif ($idea_status == 'pending') {
                    //     $status = "Pending";
                    //     $status_color = "badge-outline-pending";
                    // } elseif ($idea_status == 'under_approving_authority') {
                    //     //$status = "Under Approving Authority";
                    //     $status = "Processed for Implementation";
                    //     $status_color = "badge-outline-info";
                    // } elseif ($idea_status == 'implementation') {
                    //     $status = "Implementation";
                    //     $status_color = "badge-outline-warning";
                    // } elseif ($idea_status == 'reject') {
                    //     $reason = $idea_data->reject_reason == null ? '' : '(Reason : ' . $idea_data->reject_reason . ')';
                    //     $status = "Rejected " . $reason;
                    //     if (isset($idea_data->assessment_team_approval) && $idea_data->assessment_team_approval == 1) {
                    //         $status = "Rejected by Approver " . $reason;
                    //     } else {
                    //         $status = "Rejected by Assessment " . $reason;
                    //     }

                    //     $status_color = "badge-outline-danger";
                    // } elseif ($idea_status == 'on_hold') {
                    //     $status = "On-hold";
                    //     if (isset($idea_data->assessment_team_approval) && $idea_data->assessment_team_approval == 1) {
                    //         $status = "Kept On Hold- by Approver";
                    //     } else {
                    //         $status = "Kept On Hold- by Assessment";
                    //     }
                    //     $status_color = "badge-outline-dark";
                    // } elseif ($idea_status == 'resubmit') {
                    //     $reason = $idea_data->resubmit_reason == null ? '' : '(Reason :
                    // ' . $idea_data->resubmit_reason . ')';
                    //     $status = "Revise Request " . $reason;
                    //     if (isset($idea_data->assessment_team_approval) && $idea_data->assessment_team_approval == 1) {
                    //         $status = "To be Revised by Approver " . $reason;
                    //     } else {
                    //         $status = "To be Revised by Assessment " . $reason;
                    //     }
                    //     $status_color = "badge-outline-resubmit";
                    // } elseif ($idea_status == 'implemented') {
                    //     $status = "Implemented";
                    //     $status_color = "badge-outline-success";
                    // }

                    $status = '';
                    $status_color = '';
                    $idea_status = $idea_data->active_status;
                    if ($idea_status == 'in_assessment') {
                        $status_color = 'badge-outline-primary';
                        if ($idea_data->assessment_team_approval == 1) {
                            $status = 'Approved by Assessment Team';
                        } else {
                            $status = 'Processed for Approval';
                        }
                        //  $status = "Approved by Assesment Team";
                        $status_color = 'badge-outline-primary';
                    } elseif ($idea_status == 'pending') {
                        $status = 'Pending';
                        $status_color = 'badge-outline-pending';
                    } elseif ($idea_status == 'under_approving_authority') {
                        //$status = "Under Approving Authority";
                        $status = 'Processed for Implementation';
                        $status_color = 'badge-outline-info';
                    } elseif ($idea_status == 'implementation') {
                        $status = 'Implementation';
                        $status_color = 'badge-outline-warning';
                    } elseif ($idea_status == 'reject') {
                        $reason = $idea_data->reject_reason == null ? '' : '(Reason : ' . $idea_data->reject_reason . ')';
                        $status = 'Rejected ' . $reason;
                        if (isset($idea_data->assessment_team_approval) && $idea_data->assessment_team_approval == 1) {
                            $status = 'Rejected by Approver ' . $reason;
                        } else {
                            $status = 'Rejected by Assessment ' . $reason;
                        }

                        $status_color = 'badge-outline-danger';
                    } elseif ($idea_status == 'on_hold') {
                        $status = 'On-hold';
                        if (isset($idea_data->assessment_team_approval) && $idea_data->assessment_team_approval == 1) {
                            $status = 'Kept On Hold- by Approver';
                        } else {
                            $status = 'Kept On Hold- by Assessment';
                        }
                        $status_color = 'badge-outline-dark';
                    } elseif ($idea_status == 'resubmit') {
                        $reason =
                            $idea_data->resubmit_reason == null
                            ? ''
                            : '(Reason :
                                    ' .
                            $idea_data->resubmit_reason .
                            ')';
                        $status = 'Revise Request ' . $reason;
                        if (isset($idea_data->assessment_team_approval) && $idea_data->assessment_team_approval == 1) {
                            $status = 'To be Revised by Approver ' . $reason;
                        } else {
                            $status = 'To be Revised by Assessment ' . $reason;
                        }
                        $status_color = 'badge-outline-resubmit';
                    } elseif ($idea_status == 'implemented') {
                        $status = 'Implemented';
                        $status_color = 'badge-outline-success';
                    }


                    return "<label class='badge $status_color'> $status </label>";
                })
                ->addColumn('timeline', function ($idea_data) {

                    $status = '';
                    $status_color = '';
                    $idea_status = $idea_data->active_status;
                    if ($idea_status == 'in_assessment') {
                        $status_color = 'badge-outline-primary';
                        if ($idea_data->assessment_team_approval == 1) {
                            $status = 'Approved by Assessment Team';
                        } else {
                            $status = 'Processed for Approval';
                        }
                        //  $status = "Approved by Assesment Team";
                        $status_color = 'badge-outline-primary';
                    } elseif ($idea_status == 'pending') {
                        $status = 'Pending';
                        $status_color = 'badge-outline-pending';
                    } elseif ($idea_status == 'under_approving_authority') {
                        //$status = "Under Approving Authority";
                        $status = 'Processed for Implementation';
                        $status_color = 'badge-outline-info';
                    } elseif ($idea_status == 'implementation') {
                        $status = 'Implementation';
                        $status_color = 'badge-outline-warning';
                    } elseif ($idea_status == 'reject') {
                        $reason = $idea_data->reject_reason == null ? '' : '(Reason : ' . $idea_data->reject_reason . ')';
                        $status = 'Rejected ' . $reason;
                        if (isset($idea_data->assessment_team_approval) && $idea_data->assessment_team_approval == 1) {
                            $status = 'Rejected by Approver ' . $reason;
                        } else {
                            $status = 'Rejected by Assessment ' . $reason;
                        }

                        $status_color = 'badge-outline-danger';
                    } elseif ($idea_status == 'on_hold') {
                        $status = 'On-hold';
                        if (isset($idea_data->assessment_team_approval) && $idea_data->assessment_team_approval == 1) {
                            $status = 'Kept On Hold- by Approver';
                        } else {
                            $status = 'Kept On Hold- by Assessment';
                        }
                        $status_color = 'badge-outline-dark';
                    } elseif ($idea_status == 'resubmit') {
                        $reason =
                            $idea_data->resubmit_reason == null
                            ? ''
                            : '(Reason :
                                    ' .
                            $idea_data->resubmit_reason .
                            ')';
                        $status = 'Revise Request ' . $reason;
                        if (isset($idea_data->assessment_team_approval) && $idea_data->assessment_team_approval == 1) {
                            $status = 'To be Revised by Approver ' . $reason;
                        } else {
                            $status = 'To be Revised by Assessment ' . $reason;
                        }
                        $status_color = 'badge-outline-resubmit';
                    } elseif ($idea_status == 'implemented') {
                        $status = 'Implemented';
                        $status_color = 'badge-outline-success';
                    }


                    $html = "<div class='d-flex align-items-center'>";

                    if ($status == 'Implemented') {
                        $html .= view('frontend.status_step', ['status' => 'Pending', 'image' => 'work-plan.png', 'label' => 'Pending', 'showArrow' => true])->render();
                        $html .= view('frontend.status_step', ['status' => 'In-Assessment', 'image' => 'evaluation.png', 'label' => 'In-Assessment', 'showArrow' => true])->render();
                        $html .= view('frontend.status_step', ['status' => 'Approved', 'image' => 'approve.png', 'label' => 'Approved', 'showArrow' => true])->render();
                        $html .= view('frontend.status_step', ['status' => 'Implemented', 'image' => 'flag.png', 'label' => 'Implemented', 'showArrow' => false])->render();
                    } elseif ($status == 'Pending') {
                        $html .= view('frontend.status_step', ['status' => 'Pending', 'image' => 'work-plan.png', 'label' => 'Pending', 'showArrow' => false])->render();
                    } elseif (in_array($status, ['Under Assessment', 'Processed for Approval', 'Kept On Hold- by Assessment', 'Approved by Assessment'])) {
                        $html .= view('frontend.status_step', ['status' => 'Pending', 'image' => 'work-plan.png', 'label' => 'Pending', 'showArrow' => true])->render();
                        $html .= view('frontend.status_step', ['status' => 'In-Assessment', 'image' => 'evaluation.png', 'label' => 'In-Assessment', 'showArrow' => false])->render();
                    } elseif (in_array($status, ['Under Approval', 'Processed for Implementation', 'Implementation', 'Kept On Hold- by Approver'])) {
                        $html .= view('frontend.status_step', ['status' => 'Pending', 'image' => 'work-plan.png', 'label' => 'Pending', 'showArrow' => true])->render();
                        $html .= view('frontend.status_step', ['status' => 'In-Assessment', 'image' => 'evaluation.png', 'label' => 'In-Assessment', 'showArrow' => true])->render();
                        $html .= view('frontend.status_step', ['status' => 'Approved', 'image' => 'approve.png', 'label' => 'Approved', 'showArrow' => false])->render();
                    }

                    $html .= "</div>";

                    return $html;
                })
                ->addColumn('category_name', function ($idea_data) {
                    $category = $idea_data->category_id == '' || !isset($idea_data->category_id) ? 'NotAssigned' :
                        Category::where('category_id', $idea_data->category_id)->first()['category_name'];

                    return $category;
                })

                ->addColumn('action', function ($idea_data) {
                    $btn = "<div style='width:120px;'>";

                    $btn .= '<a href="' . url('/') . '/admin/ideaView/' . $idea_data->idea_id . '" class="btn btn-info mr-1 text-light " ><i class="fa fa-eye"></i></a>';

                    if ($idea_data->certificate == '1') {

                        $btn .= '<a href="' . url('/') . '/admin/rewards/view/' . $idea_data->idea_id . '" data-toggle = "tooltip" data-placement = "top"  title = "View Idea Certificate"
                    class="btn btn-info btn-orange text-light"><i class="fa-solid fa-file"></i></a>';
                    }
                    $btn .= '</div>';

                    return $btn;
                })
                ->rawColumns(['name', 'files', 'status', 'timeline', 'action'])

                ->make(true);
        }

        return view('backend.ideaManagement.ideaManagement');
    }


    public function addIdea()
    {
        return view('frontend.users.addIdea_new');
    }
    public function view($id)
    {
        $status_data = [];
        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        if (!empty($roles_external)) {
            $status_data = explode(',', $roles_external->status_values);
        }
        $assesment_roles = RolesExternal::where('role_name', 'like', '%Assessment Team%')->get('id');
        $journey_assesment = IdeaJourney::where('idea_id', $id)->WhereIN('final_role_id', $assesment_roles)->orderBy('idea_journey_id', 'desc')->first();
        $approver_role = Rolesexternal::where('role_type', 'Approving Authority')->get('id');

        $journey_approver = IdeaJourney::where('idea_id', $id)->whereIN('final_role_id', $approver_role)->orderBy('idea_journey_id', 'desc')->first();
        $sla_details = SLA::where('role_id', Auth::user()->sub_role_final)->first();

        // $idea_active_status = IdeaActiveStatus::where('approving_authority', 1)->pluck('idea_active_status', 'idea_active_status_value');
        $idea_active_status = IdeaActiveStatus::where('approving_authority', 1)->whereIn('idea_active_status_value', $status_data)->pluck('idea_active_status', 'idea_active_status_value');
        $company = Company::pluck('company_name', 'company_id');

        return view('backend.ideaManagement.view', ['idea' => Ideas::where('idea_id', $id)->first(), 'feedback' => Feedback::where('idea_id', $id)->orderBy('feedback_id', 'ASC')->get(), 'idea_active_status' => $idea_active_status, 'assessment_journey' => $journey_assesment, 'journey_approver' => $journey_approver, 'company' => $company, 'sla' => $sla_details]);

        // return view('backend.ideaManagement.view', ['assessment_journey'=>$assessment_journey,'company'=>$company,'idea' => Ideas::where('idea_id', $id)->first(), 'feedback' => Feedback::where('idea_id', $id)->get()]);
    }
    public function ideaRevision($id)
    {
        return view('frontend.users.ideaRevision', ['ideas' => IdeaRevision::where('idea_id', $id)->orderBy('created_at', 'DESC')->get(), 'id' => $id]);
    }
    public function viewIdeaRevision($id)
    {
        // dd(Feedback::all());
        return view('frontend.users.viewIdeaRevision', ['ideaRevision' => IdeaRevision::where('idea_revision_id', $id)->first()]);
    }
    public function storeIdea(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:500',
            'description' => 'required',
        ]);

        $idea = new Ideas($validated);
        if ($request->file()) {
            $allowedfileExtension = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'];

            $extension = $request->file('image')->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $fileName = time() . '_' . $request->image->getClientOriginalName();
                $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
                $idea->image_path =  $filePath;
            }
        }
        $idea->user_id = Auth::id();
        $idea->title = $request->title;
        $idea->description = $request->description;
        if ($idea->save()) {
            return redirect()->route('user.ideaManagement')->with('success', 'Successfully Submitted the Idea!');
        } else {
            return redirect()->route('user.ideaManagement')->with('error', 'Failed to submit the Idea!');
        }
    }
    public function distroyIdea($id)
    {
        $idea = Ideas::where('idea_id', $id)->get();
        if (count($idea) > 0) {
            if (Ideas::where('idea_id', $id)->delete()) {
                return redirect('/user/ideaManagement')->with('success', 'Idea Has Been Deleted');
            }
        }
    }
    public function edit($id)
    {
        $idea = Ideas::where('idea_id', $id)->first();
        return view('frontend.users.updateIdea', compact('idea'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|max:500',
            'description' => 'required',
        ]);
        // dd($request->idea);
        $idea = Ideas::where('idea_id', $request->idea)->get();
        // dd($idea);
        if (count($idea) > 0) {
            $ideaQ = Ideas::where('idea_id', $request->idea)->first();
            $ideaRevision = new IdeaRevision();
            $ideaRevision->idea_id = $request->idea;

            if ($request->file()) {
                // dd('hello');
                // dd($request->image);
                $allowedfileExtension = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'];

                $extension = $request->file('image')->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $fileName = time() . '_' . $request->image->getClientOriginalName();
                    $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
                    $ideaQ->image_path =  $filePath;
                    $ideaRevision->image_path = $filePath;
                }
            } else {
                $image_path = $ideaQ->image_path;
                $ideaRevision->image_path = $image_path;
            }

            $ideaQ->fill($request->all());
            $ideaRevision->fill($request->all());
            if ($ideaRevision->save()) {
                if ($ideaQ->save()) {
                    return redirect('/user/ideaManagement')->with('success', 'Idea Has Been Updated');
                }
            }
        }

        // Ideas::where('active', 1)
        //     ->where('destination', 'San Diego')
        //     ->update(['delayed' => 1]);
    }
    public function storeFeedback()
    {
        // dd(request());
        $validated = request()->validate([
            'feedback' => 'min:3'
        ]);
        $feedback = new Feedback($validated);
        $feedback->idea_id = request()->idea_id;
        $feedback->user_id = Auth::guard('admin')->id();
        $feedback->user_role = 'admin';
        $feedback->feedback = request()->feedback;
        if ($feedback->save()) {
            return redirect()->back()->with('success', 'Comment Has Been Submitted');
        }
    }
    public function updateIdeaStatus(Request $request)
    {
        // dd("hwllo");
        $status = Ideas::where('idea_id', $request->idea_id)->first();
        if (count($status->toArray()) > 0) {
            $status->active_status = $request->idea_status;
            if ($request->idea_status == 'In-Assessment') {
                $status->assessment_team_approval = 1;
                $status->approving_authority_approval = 0;
                $status->implemented = 0;
            } elseif ($request->idea_status == 'Approving Authority') {
                $status->approving_authority_approval = 1;
                $status->implemented = 0;
                $status->assessment_team_approval = 0;
            } elseif ($request->idea_status == 'Implementation') {
                $status->implemented = 1;
                $status->approving_authority_approval = 0;
                $status->assessment_team_approval = 0;
            }
            $status->save();
            return redirect()->route('admin.ideaView', ['id' => $request->idea_id])->with('success', 'Idea Statu Has Been Updated');
        }
    }
    public function approveCertificate($id)
    {
        $idea =  Ideas::where('idea_id', $id)->first();
        if (isset($idea)) {
            if ($idea->certificate != 1) {
                $idea->certificate = 1;
                if ($idea->save()) {
                    $user_name = Users::where('user_id', $idea->user_id)->first();
                    // dd($user_name);
                    if ($user_name->toArray() > 0) {
                        $user_name = $user_name->name . ' ' . $user_name->last_name;
                    }
                    $log = ['module' => 'Idea Management', 'action' => 'Certificate Generation', 'description' => 'Certificate generated : Idea name : ' . $idea->title . ', User Name :' . $user_name];
                    captureActivity($log);

                    return redirect()->route('admin.ideaView', ['id' => $id])->with('success', 'Idea certificate has been generated');
                } else {
                    return redirect()->route('admin.ideaView', ['id' => $id])->with('error', 'Failed to generate the Idea Certificate');
                }
            }
        }
    }
}
