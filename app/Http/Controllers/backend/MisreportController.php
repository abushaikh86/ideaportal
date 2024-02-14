<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\frontend\Department;
use App\Http\Controllers\Controller;
use App\Models\backend\AdminUsers;
use App\Models\backend\Category;
use App\Models\backend\Company;
use App\Models\backend\SLA;
use App\Models\frontend\IdeaImages;
use App\Models\frontend\Ideas;
use App\Models\frontend\Users;
use App\Models\Rolesexternal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MisreportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function leaderboard(Request $request, $companyId = null)
    {
        // if ($request->ajax()) {
        //     $admin_id = Auth::id();
        //     $data = AdminUsers::where(['admin_user_id' => $admin_id, 'centralized_decentralized_type' => 2])->first();

        //     $ideaQuery = Ideas::query();

        //     if (!empty($data)) {
        //         $user_data = Users::where(['active_status' => 1, 'company_id' => $data->company_id])->pluck('user_id');
        //         $ideaQuery->whereIn('user_id', $user_data);
        //     }

        //     if ($request->filled('company_id')) {
        //         $user_data = Users::where(['active_status' => 1, 'company_id' => $request->input('company_id')])->pluck('user_id');
        //         $ideaQuery->whereIn('user_id', $user_data);
        //     }

        //     $idea_data = $ideaQuery->orderBy('idea_id', 'DESC')->get();

        //     return DataTables::of($idea_data)
        //         ->addIndexColumn()
        //         ->addColumn('idea_id', function ($idea_data) {
        //             return isset($idea_data->idea_id) ? '000' . $idea_data->idea_id : '';
        //         })
        //         ->addColumn('name', function ($idea_data) {
        //             $user = Users::where('user_id', $idea_data->user_id)->first();

        //             if (isset($user)) {

        //                 return  $user['name'] . ' ' . $user['last_name'];
        //             } else {
        //                 return '';
        //             }
        //         })
        //         ->addColumn('title', function ($idea_data) {
        //             return isset($idea_data->title) ? $idea_data->title : '';
        //         })

        //         ->addColumn('created_at', function ($idea_data) {
        //             return explode(' ', $idea_data['created_at'])[0];
        //         })
        //         ->addColumn('company_name', function ($idea_data) {
        //             $company_id = $idea_data->company_data->company_id ?? '';
        //             $company = Company::where('company_id', $company_id)->pluck('company_name');

        //             return $company[0] ?? '';
        //         })
        //         ->addColumn('status', function ($idea_data) {

        //             $status = '';
        //             $status_color = '';
        //             $idea_status = $idea_data->active_status;
        //             if ($idea_status == 'in_assessment') {
        //                 $status_color = 'badge-outline-primary';
        //                 if ($idea_data->assessment_team_approval == 1) {
        //                     $status = 'Approved by Assessment Team';
        //                 } else {
        //                     $status = 'Processed for Approval';
        //                 }
        //                 //  $status = "Approved by Assesment Team";
        //                 $status_color = 'badge-outline-primary';
        //             } elseif ($idea_status == 'pending') {
        //                 $status = 'Pending';
        //                 $status_color = 'badge-outline-pending';
        //             } elseif ($idea_status == 'under_approving_authority') {
        //                 //$status = "Under Approving Authority";
        //                 $status = 'Processed for Implementation';
        //                 $status_color = 'badge-outline-info';
        //             } elseif ($idea_status == 'implementation') {
        //                 $status = 'Implementation';
        //                 $status_color = 'badge-outline-warning';
        //             } elseif ($idea_status == 'reject') {
        //                 $reason = $idea_data->reject_reason == null ? '' : '(Reason : ' . $idea_data->reject_reason . ')';
        //                 $status = 'Rejected ' . $reason;
        //                 if (isset($idea_data->assessment_team_approval) && $idea_data->assessment_team_approval == 1) {
        //                     $status = 'Rejected by Approver ' . $reason;
        //                 } else {
        //                     $status = 'Rejected by Assessment ' . $reason;
        //                 }

        //                 $status_color = 'badge-outline-danger';
        //             } elseif ($idea_status == 'on_hold') {
        //                 $status = 'On-hold';
        //                 if (isset($idea_data->assessment_team_approval) && $idea_data->assessment_team_approval == 1) {
        //                     $status = 'Kept On Hold- by Approver';
        //                 } else {
        //                     $status = 'Kept On Hold- by Assessment';
        //                 }
        //                 $status_color = 'badge-outline-dark';
        //             } elseif ($idea_status == 'resubmit') {
        //                 $reason =
        //                     $idea_data->resubmit_reason == null
        //                     ? ''
        //                     : '(Reason :
        //                             ' .
        //                     $idea_data->resubmit_reason .
        //                     ')';
        //                 $status = 'Revise Request ' . $reason;
        //                 if (isset($idea_data->assessment_team_approval) && $idea_data->assessment_team_approval == 1) {
        //                     $status = 'To be Revised by Approver ' . $reason;
        //                 } else {
        //                     $status = 'To be Revised by Assessment ' . $reason;
        //                 }
        //                 $status_color = 'badge-outline-resubmit';
        //             } elseif ($idea_status == 'implemented') {
        //                 $status = 'Implemented';
        //                 $status_color = 'badge-outline-success';
        //             }


        //             return "<label class='badge $status_color'> $status </label>";
        //         })
        //         ->addColumn('category_name', function ($idea_data) {
        //             $category = $idea_data->category_id == '' || !isset($idea_data->category_id) ? 'NotAssigned' :
        //                 Category::where('category_id', $idea_data->category_id)->first()['category_name'];

        //             return $category;
        //         })

        //         ->addColumn('action', function ($idea_data) {
        //             $btn = "<div style='width:120px;'>";

        //             $btn .= '<a href="' . url('/') . '/admin/ideaView/' . $idea_data->idea_id . '" class="btn btn-info mr-1 text-light " target="_blank"><i class="fa fa-eye"></i></a>';

        //             if ($idea_data->certificate == '1') {

        //                 $btn .= '<a href="' . url('/') . '/admin/rewards/view/' . $idea_data->idea_id . '" data-toggle = "tooltip" data-placement = "top"  title = "View Idea Certificate"
        //             class="btn btn-info btn-orange text-light"><i class="fa-solid fa-file"></i></a>';
        //             }
        //             $btn .= '</div>';

        //             return $btn;
        //         })
        //         ->rawColumns(['name', 'files', 'status', 'action'])

        //         ->make(true);
        // }
        // $company_data = Company::pluck('company_name', 'company_id');
        // return view('backend.misreport.leaderboard_index', compact('company_data'));

        $top_rated = Ideas::whereBetween('rating', [7, 10])->count();
        $on_hold = Ideas::where('active_status', 'on_hold')->count();
        $revised = Ideas::where('active_status', 'resubmit')->count();
        $reviewed = Ideas::where('assessment_team_approval', '1')->count();
        $participants =  Ideas::count();
        $implemented = Ideas::where('active_status', 'implemented')->count();
        $underprocess = Ideas::whereIn('active_status', ['in_assessment', 'under_approving_authority'])->count();


        $categroy = Category::pluck('category_name', 'category_id')->toArray();
        $couting_array = [];
        foreach ($categroy as $key => $val) {
            $category_wise_idea_count = Ideas::where('category_id', $key)->count();
            $couting_array[] = $category_wise_idea_count;
        }

        //get table data
        $week_data =   Ideas::select('user_id', DB::raw('COUNT(*) as total_ideas'))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('user_id')
            ->with('user')
            ->orderByDesc('total_ideas')
            ->limit(5)
            ->get();

        $month_data =   Ideas::select('user_id', DB::raw('COUNT(*) as total_ideas'))
            ->where('created_at', '>=', Carbon::now()->subMonth())
            ->groupBy('user_id')
            ->with('user')
            ->orderByDesc('total_ideas')
            ->limit(5)
            ->get();

        $all_time_data =   Ideas::select('user_id', DB::raw('COUNT(*) as total_ideas'))
            ->groupBy('user_id')
            ->with('user')
            ->orderByDesc('total_ideas')
            ->limit(5)
            ->get();

        // dd($month_data);

        return view('backend.misreport.leaderboard_index', compact('all_time_data', 'month_data', 'week_data', 'underprocess', 'implemented', 'participants', 'top_rated', 'on_hold', 'revised', 'reviewed', 'categroy', 'couting_array'));
    }

    public function group_wise(Request $request, $companyId = null)
    {
        if ($request->ajax()) {
            $admin_id = Auth::id();
            $data = AdminUsers::where(['admin_user_id' => $admin_id, 'centralized_decentralized_type' => 2])->first();

            $ideaQuery = Ideas::query();

            if (!empty($data)) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $data->company_id])->pluck('user_id');
                $ideaQuery->whereIn('user_id', $user_data);
            }

            if ($request->filled('company_id')) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $request->input('company_id')])->pluck('user_id');
                $ideaQuery->whereIn('user_id', $user_data);
            }

            if ($request->filled('status')) {
                $status = $request->status; // Corrected this line
                if ($status == 'in_assessment') {
                    $ideaQuery->whereIn('active_status', ['in_assessment', 'under_approving_authority', 'implementation', 'on_hold']);
                } else {
                    $ideaQuery->where('active_status', $status);
                }
            }


            $idea_data = $ideaQuery->orderBy('idea_id', 'DESC')->get();

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

                ->addColumn('created_at', function ($idea_data) {
                    return explode(' ', $idea_data['created_at'])[0];
                })
                ->addColumn('company_name', function ($idea_data) {
                    $company_id = $idea_data->company_data->company_id ?? '';
                    $company = Company::where('company_id', $company_id)->pluck('company_name');

                    return $company[0] ?? '';
                })
                ->addColumn('status', function ($idea_data) {

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
                ->addColumn('category_name', function ($idea_data) {
                    $category = $idea_data->category_id == '' || !isset($idea_data->category_id) ? 'NotAssigned' :
                        Category::where('category_id', $idea_data->category_id)->first()['category_name'];

                    return $category;
                })

                ->addColumn('action', function ($idea_data) {
                    $btn = "<div style='width:120px;'>";

                    $btn .= '<a href="' . url('/') . '/admin/ideaView/' . $idea_data->idea_id . '" class="btn btn-info mr-1 text-light " target="_blank"><i class="fa fa-eye"></i></a>';

                    if ($idea_data->certificate == '1') {

                        $btn .= '<a href="' . url('/') . '/admin/rewards/view/' . $idea_data->idea_id . '" data-toggle = "tooltip" data-placement = "top"  title = "View Idea Certificate"
                    class="btn btn-info btn-orange text-light"><i class="fa-solid fa-file"></i></a>';
                    }
                    $btn .= '</div>';

                    return $btn;
                })
                ->rawColumns(['name', 'files', 'status', 'action'])

                ->make(true);
        }
        $company_data = Company::pluck('company_name', 'company_id');
        return view('backend.misreport.groupwise_index', compact('company_data'));
    }


    public function teamwiseanalysis(Request $request, $companyId = null)
    {
        if ($request->ajax()) {
            $admin_id = Auth::id();
            $data = AdminUsers::where(['admin_user_id' => $admin_id, 'centralized_decentralized_type' => 2])->first();

            $ideaQuery = Ideas::query();
            // $ideaQuery->where('assessment_team_approval', '!=', 0);
            // $ideaQuery->orWhere('approving_authority_approval', '!=', 0);


            if (!empty($data)) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $data->company_id])->pluck('user_id');
                $ideaQuery->whereIn('user_id', $user_data);
            }

            if ($request->filled('company_id')) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $request->input('company_id')])->pluck('user_id');
                $ideaQuery->whereIn('user_id', $user_data);
            }

            if ($request->filled('team')) {
                $team = $request->team; // Corrected this line
                if ($team == 'approver') {
                    $ideaQuery->where(['approving_authority_approval' => 1, 'implemented' => 0]);
                } else if ($team == 'assessment') {
                    $ideaQuery->where(['assessment_team_approval' => 1, 'approving_authority_approval' => 0]);
                }
            }

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $ideaQuery->whereBetween('updated_at', [$request->from_date, $request->to_date]);
            }

            $idea_data = $ideaQuery->orderBy('idea_id', 'DESC')->get();


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

                ->addColumn('created_at', function ($idea_data) {
                    return explode(' ', $idea_data['created_at'])[0];
                })
                ->addColumn('updated_at', function ($idea_data) {
                    return explode(' ', $idea_data['updated_at'])[0];
                })
                ->addColumn('company_name', function ($idea_data) {
                    $company_id = $idea_data->company_data->company_id ?? '';
                    $company = Company::where('company_id', $company_id)->pluck('company_name');

                    return $company[0] ?? '';
                })
                ->addColumn('status', function ($idea_data) {

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
                ->addColumn('category_name', function ($idea_data) {
                    $category = $idea_data->category_id == '' || !isset($idea_data->category_id) ? 'NotAssigned' :
                        Category::where('category_id', $idea_data->category_id)->first()['category_name'];

                    return $category;
                })

                ->addColumn('action', function ($idea_data) {
                    $btn = "<div style='width:120px;'>";

                    $btn .= '<a href="' . url('/') . '/admin/ideaView/' . $idea_data->idea_id . '" class="btn btn-info mr-1 text-light " target="_blank"><i class="fa fa-eye"></i></a>';

                    if ($idea_data->certificate == '1') {

                        $btn .= '<a href="' . url('/') . '/admin/rewards/view/' . $idea_data->idea_id . '" data-toggle = "tooltip" data-placement = "top"  title = "View Idea Certificate"
                    class="btn btn-info btn-orange text-light"><i class="fa-solid fa-file"></i></a>';
                    }
                    $btn .= '</div>';

                    return $btn;
                })
                ->rawColumns(['name', 'files', 'status', 'action'])

                ->make(true);
        }
        $company_data = Company::pluck('company_name', 'company_id');
        return view('backend.misreport.team_wise_analysis', compact('company_data'));
    }
    public function teamwisesla(Request $request, $companyId = null)
    {
        if ($request->ajax()) {
            $admin_id = Auth::id();
            $data = AdminUsers::where(['admin_user_id' => $admin_id, 'centralized_decentralized_type' => 2])->first();

            $ideaQuery = Ideas::query();
            // $ideaQuery->where('assessment_team_approval', '!=', 0);
            // $ideaQuery->orWhere('approving_authority_approval', '!=', 0);


            if (!empty($data)) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $data->company_id])->pluck('user_id');
                $ideaQuery->whereIn('user_id', $user_data);
            }

            if ($request->filled('company_id')) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $request->input('company_id')])->pluck('user_id');
                $ideaQuery->whereIn('user_id', $user_data);
            }

            if ($request->filled('team')) {
                $team = $request->team; // Corrected this line
                if ($team == 'approver') {
                    $ideaQuery->where(['approving_authority_approval' => 1, 'implemented' => 0]);
                } else if ($team == 'assessment') {
                    $ideaQuery->where(['assessment_team_approval' => 1, 'approving_authority_approval' => 0]);
                    // $ideaQuery->andWhere('approving_authority_approval', 0);
                }
            }

            if ($request->filled('sla_status')) {
                $sla_status = $request->sla_status; // Corrected this line
                if ($sla_status == 'met' && $request->team == 'approver') {
                    $ideaQuery->whereNull('sla_reason_approver');
                } else if ($sla_status == 'met' && $request->team == 'assessment') {
                    $ideaQuery->whereNull('sla_reason_assessment');
                } else if ($sla_status == 'missed' && $request->team == 'approver') {
                    $ideaQuery->whereNotNull('sla_reason_approver');
                } else if ($sla_status == 'missed' && $request->team == 'assessment') {
                    $ideaQuery->whereNotNull('sla_reason_assessment');
                } else if ($sla_status == 'missed') {
                    $ideaQuery->whereNotNull('sla_reason_assessment');
                    $ideaQuery->orWhereNotNull('sla_reason_approver');
                } else {
                    $ideaQuery->whereNull('sla_reason_assessment');
                    $ideaQuery->whereNull('sla_reason_approver');
                }
            }



            $idea_data = $ideaQuery->orderBy('idea_id', 'DESC')->get();


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

                ->addColumn('created_at', function ($idea_data) {
                    return explode(' ', $idea_data['created_at'])[0];
                })

                ->addColumn('company_name', function ($idea_data) {
                    $company_id = $idea_data->company_data->company_id ?? '';
                    $company = Company::where('company_id', $company_id)->pluck('company_name');

                    return $company[0] ?? '';
                })
                ->addColumn('status', function ($idea_data) {

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

                ->addColumn('sla_reason_assessment', function ($idea_data) {
                    if ($idea_data['sla_reason_assessment'] != null || $idea_data['sla_reason_approver'] != null) {
                        return "missed"; // or any default value you want to display when both are empty
                    } else {
                        return "met";
                    }
                })


                ->addColumn('category_name', function ($idea_data) {
                    $category = $idea_data->category_id == '' || !isset($idea_data->category_id) ? 'NotAssigned' :
                        Category::where('category_id', $idea_data->category_id)->first()['category_name'];

                    return $category;
                })

                ->addColumn('action', function ($idea_data) {
                    $btn = "<div style='width:120px;'>";

                    $btn .= '<a href="' . url('/') . '/admin/ideaView/' . $idea_data->idea_id . '" class="btn btn-info mr-1 text-light " target="_blank"><i class="fa fa-eye"></i></a>';

                    if ($idea_data->certificate == '1') {

                        $btn .= '<a href="' . url('/') . '/admin/rewards/view/' . $idea_data->idea_id . '" data-toggle = "tooltip" data-placement = "top"  title = "View Idea Certificate"
                    class="btn btn-info btn-orange text-light"><i class="fa-solid fa-file"></i></a>';
                    }
                    $btn .= '</div>';

                    return $btn;
                })
                ->rawColumns(['name', 'files', 'status', 'action'])

                ->make(true);
        }
        $company_data = Company::pluck('company_name', 'company_id');
        return view('backend.misreport.team_wise_sla', compact('company_data'));
    }

    public function group_wise_budget(Request $request, $companyId = null)
    {
        if ($request->ajax()) {
            $admin_id = Auth::id();
            $data = AdminUsers::where(['admin_user_id' => $admin_id, 'centralized_decentralized_type' => 2])->first();

            $ideaQuery = Ideas::query();

            if (!empty($data)) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $data->company_id])->pluck('user_id');
                $ideaQuery->whereIn('user_id', $user_data);
            }

            if ($request->filled('company_id')) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $request->input('company_id')])->pluck('user_id');
                $ideaQuery->whereIn('user_id', $user_data);
            }

            if ($request->filled('status')) {
                $status = $request->status; // Corrected this line
                if ($status == 'in_assessment') {
                    $ideaQuery->whereIn('active_status', ['in_assessment', 'under_approving_authority', 'implementation', 'on_hold']);
                } else {
                    $ideaQuery->where('active_status', $status);
                }
            }

            if ($request->filled('filter', 'budget_amt')) {
                $ideaQuery->where('estimate_budget', $request->filter, $request->budget_amt);
            }

            if ($request->filled('budget_status')) {
                $budgetStatus = $request->budget_status;
                $ideaQuery->where($budgetStatus, '!=', null);
            }


            $idea_data = $ideaQuery->orderBy('idea_id', 'DESC')->get();

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

                ->addColumn('created_at', function ($idea_data) {
                    return explode(' ', $idea_data['created_at'])[0];
                })
                ->addColumn('company_name', function ($idea_data) {
                    $company_id = $idea_data->company_data->company_id ?? '';
                    $company = Company::where('company_id', $company_id)->pluck('company_name');

                    return $company[0] ?? '';
                })
                ->addColumn('estimate_budget', function ($idea_data) {
                    return isset($idea_data->estimate_budget) ? $idea_data->estimate_budget : '';
                })
                ->addColumn('expenses_approved', function ($idea_data) {
                    return isset($idea_data->expenses_approved) ? $idea_data->expenses_approved : '';
                })
                ->addColumn('expenses_incurred', function ($idea_data) {
                    return isset($idea_data->expenses_incurred) ? $idea_data->expenses_incurred : '';
                })
                ->addColumn('status', function ($idea_data) {

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
                ->addColumn('category_name', function ($idea_data) {
                    $category = $idea_data->category_id == '' || !isset($idea_data->category_id) ? 'NotAssigned' :
                        Category::where('category_id', $idea_data->category_id)->first()['category_name'];

                    return $category;
                })

                ->addColumn('action', function ($idea_data) {
                    $btn = "<div style='width:120px;'>";

                    $btn .= '<a href="' . url('/') . '/admin/ideaView/' . $idea_data->idea_id . '" class="btn btn-info mr-1 text-light " target="_blank"><i class="fa fa-eye"></i></a>';

                    if ($idea_data->certificate == '1') {

                        $btn .= '<a href="' . url('/') . '/admin/rewards/view/' . $idea_data->idea_id . '" data-toggle = "tooltip" data-placement = "top"  title = "View Idea Certificate"
                    class="btn btn-info btn-orange text-light"><i class="fa-solid fa-file"></i></a>';
                    }
                    $btn .= '</div>';

                    return $btn;
                })
                ->rawColumns(['name', 'files', 'status', 'action'])

                ->make(true);
        }
        $company_data = Company::pluck('company_name', 'company_id');
        return view('backend.misreport.group_wise_budget', compact('company_data'));
    }

    public function apprv_not_implemented(Request $request, $companyId = null)
    {
        if ($request->ajax()) {
            $admin_id = Auth::id();
            $data = AdminUsers::where(['admin_user_id' => $admin_id, 'centralized_decentralized_type' => 2])->first();

            $ideaQuery = Ideas::query();

            if (!empty($data)) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $data->company_id])->pluck('user_id');
                $ideaQuery->whereIn('user_id', $user_data);
            }

            if ($request->filled('company_id')) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $request->input('company_id')])->pluck('user_id');
                $ideaQuery->whereIn('user_id', $user_data);
            }

            $ideaQuery->where(['approving_authority_approval' => 1, 'implemented' => 0]);
            $idea_data = $ideaQuery->orderBy('idea_id', 'DESC')->get();

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

                ->addColumn('created_at', function ($idea_data) {
                    return explode(' ', $idea_data['created_at'])[0];
                })
                ->addColumn('company_name', function ($idea_data) {
                    $company_id = $idea_data->company_data->company_id ?? '';
                    $company = Company::where('company_id', $company_id)->pluck('company_name');

                    return $company[0] ?? '';
                })
                ->addColumn('status', function ($idea_data) {

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
                ->addColumn('category_name', function ($idea_data) {
                    $category = $idea_data->category_id == '' || !isset($idea_data->category_id) ? 'NotAssigned' :
                        Category::where('category_id', $idea_data->category_id)->first()['category_name'];

                    return $category;
                })

                ->addColumn('action', function ($idea_data) {
                    $btn = "<div style='width:120px;'>";

                    $btn .= '<a href="' . url('/') . '/admin/ideaView/' . $idea_data->idea_id . '" class="btn btn-info mr-1 text-light " target="_blank"><i class="fa fa-eye"></i></a>';

                    if ($idea_data->certificate == '1') {

                        $btn .= '<a href="' . url('/') . '/admin/rewards/view/' . $idea_data->idea_id . '" data-toggle = "tooltip" data-placement = "top"  title = "View Idea Certificate"
                    class="btn btn-info btn-orange text-light"><i class="fa-solid fa-file"></i></a>';
                    }
                    $btn .= '</div>';

                    return $btn;
                })
                ->rawColumns(['name', 'files', 'status', 'action'])

                ->make(true);
        }
        $company_data = Company::pluck('company_name', 'company_id');
        return view('backend.misreport.apprv_not_implemented', compact('company_data'));
    }

    public function category_wise(Request $request, $companyId = null)
    {
        if ($request->ajax()) {
            $admin_id = Auth::id();
            $data = AdminUsers::where(['admin_user_id' => $admin_id, 'centralized_decentralized_type' => 2])->first();

            $ideaQuery = Ideas::query();

            if (!empty($data)) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $data->company_id])->pluck('user_id');
                $ideaQuery->whereIn('user_id', $user_data);
            }

            if ($request->filled('company_id')) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $request->input('company_id')])->pluck('user_id');
                $ideaQuery->whereIn('user_id', $user_data);
            }

            if ($request->filled('category_id')) {
                $ideaQuery->where('category_id', $request->category_id);
            }

            $idea_data = $ideaQuery->orderBy('idea_id', 'DESC')->get();

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

                ->addColumn('created_at', function ($idea_data) {
                    return explode(' ', $idea_data['created_at'])[0];
                })
                ->addColumn('company_name', function ($idea_data) {
                    $company_id = $idea_data->company_data->company_id ?? '';
                    $company = Company::where('company_id', $company_id)->pluck('company_name');

                    return $company[0] ?? '';
                })
                ->addColumn('status', function ($idea_data) {

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
                ->addColumn('category_name', function ($idea_data) {
                    $category = $idea_data->category_id == '' || !isset($idea_data->category_id) ? 'NotAssigned' :
                        Category::where('category_id', $idea_data->category_id)->first()['category_name'];

                    return $category;
                })

                ->addColumn('action', function ($idea_data) {
                    $btn = "<div style='width:120px;'>";

                    $btn .= '<a href="' . url('/') . '/admin/ideaView/' . $idea_data->idea_id . '" class="btn btn-info mr-1 text-light " target="_blank"><i class="fa fa-eye"></i></a>';

                    if ($idea_data->certificate == '1') {

                        $btn .= '<a href="' . url('/') . '/admin/rewards/view/' . $idea_data->idea_id . '" data-toggle = "tooltip" data-placement = "top"  title = "View Idea Certificate"
                    class="btn btn-info btn-orange text-light"><i class="fa-solid fa-file"></i></a>';
                    }
                    $btn .= '</div>';

                    return $btn;
                })
                ->rawColumns(['name', 'files', 'status', 'action'])

                ->make(true);
        }
        $company_data = Company::pluck('company_name', 'company_id');
        $category_data = Category::pluck('category_name', 'category_id');
        return view('backend.misreport.category_wise', compact('company_data', 'category_data'));
    }

    public function budget_wise(Request $request, $companyId = null)
    {
        if ($request->ajax()) {
            $admin_id = Auth::id();
            $data = AdminUsers::where(['admin_user_id' => $admin_id, 'centralized_decentralized_type' => 2])->first();

            $ideaQuery = Ideas::query();

            if (!empty($data)) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $data->company_id])->pluck('user_id');
                $ideaQuery->whereIn('user_id', $user_data);
            }

            if ($request->filled('company_id')) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $request->input('company_id')])->pluck('user_id');
                $ideaQuery->whereIn('user_id', $user_data);
            }

            $idea_data = $ideaQuery->orderBy('idea_id', 'DESC')->get();

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

                ->addColumn('created_at', function ($idea_data) {
                    return explode(' ', $idea_data['created_at'])[0];
                })
                ->addColumn('company_name', function ($idea_data) {
                    $company_id = $idea_data->company_data->company_id ?? '';
                    $company = Company::where('company_id', $company_id)->pluck('company_name');

                    return $company[0] ?? '';
                })
                ->addColumn('estimate_budget', function ($idea_data) {
                    return isset($idea_data->estimate_budget) ? $idea_data->estimate_budget : '';
                })
                ->addColumn('expenses_approved', function ($idea_data) {
                    return isset($idea_data->expenses_approved) ? $idea_data->expenses_approved : '';
                })
                ->addColumn('expenses_incurred', function ($idea_data) {
                    return isset($idea_data->expenses_incurred) ? $idea_data->expenses_incurred : '';
                })
                ->addColumn('status', function ($idea_data) {

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
                ->addColumn('category_name', function ($idea_data) {
                    $category = $idea_data->category_id == '' || !isset($idea_data->category_id) ? 'NotAssigned' :
                        Category::where('category_id', $idea_data->category_id)->first()['category_name'];

                    return $category;
                })

                ->addColumn('action', function ($idea_data) {
                    $btn = "<div style='width:120px;'>";

                    $btn .= '<a href="' . url('/') . '/admin/ideaView/' . $idea_data->idea_id . '" class="btn btn-info mr-1 text-light " target="_blank"><i class="fa fa-eye"></i></a>';

                    if ($idea_data->certificate == '1') {

                        $btn .= '<a href="' . url('/') . '/admin/rewards/view/' . $idea_data->idea_id . '" data-toggle = "tooltip" data-placement = "top"  title = "View Idea Certificate"
                    class="btn btn-info btn-orange text-light"><i class="fa-solid fa-file"></i></a>';
                    }
                    $btn .= '</div>';

                    return $btn;
                })
                ->rawColumns(['name', 'files', 'status', 'action'])

                ->make(true);
        }
        $company_data = Company::pluck('company_name', 'company_id');
        return view('backend.misreport.budget_wise', compact('company_data'));
    }

    public function rating_wise(Request $request, $companyId = null)
    {
        if ($request->ajax()) {
            $admin_id = Auth::id();
            $data = AdminUsers::where(['admin_user_id' => $admin_id, 'centralized_decentralized_type' => 2])->first();

            $ideaQuery = Ideas::query();

            if (!empty($data)) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $data->company_id])->pluck('user_id');
                $ideaQuery->whereIn('user_id', $user_data);
            }

            if ($request->filled('company_id')) {
                $user_data = Users::where(['active_status' => 1, 'company_id' => $request->input('company_id')])->pluck('user_id');
                $ideaQuery->whereIn('user_id', $user_data);
            }

            if ($request->filled('rating')) {
                $ideaQuery->where('rating', $request->rating);
            }

            $idea_data = $ideaQuery->orderBy('idea_id', 'DESC')->get();

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

                ->addColumn('created_at', function ($idea_data) {
                    return explode(' ', $idea_data['created_at'])[0];
                })
                ->addColumn('company_name', function ($idea_data) {
                    $company_id = $idea_data->company_data->company_id ?? '';
                    $company = Company::where('company_id', $company_id)->pluck('company_name');

                    return $company[0] ?? '';
                })
                ->addColumn('status', function ($idea_data) {

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
                ->addColumn('category_name', function ($idea_data) {
                    $category = $idea_data->category_id == '' || !isset($idea_data->category_id) ? 'NotAssigned' :
                        Category::where('category_id', $idea_data->category_id)->first()['category_name'];

                    return $category;
                })

                ->addColumn('action', function ($idea_data) {
                    $btn = "<div style='width:120px;'>";

                    $btn .= '<a href="' . url('/') . '/admin/ideaView/' . $idea_data->idea_id . '" class="btn btn-info mr-1 text-light " target="_blank"><i class="fa fa-eye"></i></a>';

                    if ($idea_data->certificate == '1') {

                        $btn .= '<a href="' . url('/') . '/admin/rewards/view/' . $idea_data->idea_id . '" data-toggle = "tooltip" data-placement = "top"  title = "View Idea Certificate"
                    class="btn btn-info btn-orange text-light"><i class="fa-solid fa-file"></i></a>';
                    }
                    $btn .= '</div>';

                    return $btn;
                })
                ->rawColumns(['name', 'files', 'status', 'action'])

                ->make(true);
        }
        $company_data = Company::pluck('company_name', 'company_id');
        return view('backend.misreport.rating_wise', compact('company_data'));
    }
}
