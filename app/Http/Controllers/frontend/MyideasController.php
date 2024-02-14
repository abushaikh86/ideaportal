<?php

namespace App\Http\Controllers\frontend;

use App\Models\backend\IdeaBenifits;
use PHPMailer\PHPMailer;

use Illuminate\Http\Request;
use App\Models\frontend\Ideas;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Models\frontend\Notification;
use App\Models\backend\AdminNotification;
use App\Models\Rolesexternal;
use Exception;
use phpmailerException;
use Session;
use App\Models\backend\Filesetting;

class MyideasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('common');
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
        }

        return $status;
    }

    public function index()
    {

        session::put('main_page', url()->full());
        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        if (!empty($_GET)) {
            $filter = !empty($this->redirect_from_dash($_GET['st'])) ? $this->redirect_from_dash($_GET['st']) : '';
        }

        if ($roles_external->role_type == 'Assessment Team') {

            if (!empty($filter)) {
                if ($filter == 'approved_ideas') {
                    $ideas = Ideas::whereHas('user', function ($q) {
                        $q->where('company_id', '=', Auth::user()->company_id);
                    })->where(function ($query) {
                        $query->where('active_status', 'implementation')->where('implemented', 0);
                    })->where('user_id', '=', Auth::user()->user_id)->orderBy('ideas.idea_id', 'DESC')->get();
                } else if ($filter == 'resubmit') {
                    $ideas = Ideas::whereHas('user', function ($q) {
                        $q->where('company_id', '=', Auth::user()->company_id);
                    })->where('active_status', $filter)->where('user_id', '=', Auth::user()->user_id)->where('asstmnt_rev_status', 1)->orderBy('ideas.idea_id', 'DESC')->get();
                } elseif ($filter == 'in_assessment') {

                    $ideas = Ideas::whereHas('user', function ($q) {
                        $q->where('company_id', '=', Auth::user()->company_id);
                    })->where('active_status', $filter)->where('user_id', '=', Auth::user()->user_id)->where('active_status', 'in_assessment',)->where('assessment_team_approval', '!=', 1)->orderBy('ideas.idea_id', 'DESC')->get();
                } else {
                    $ideas = Ideas::whereHas('user', function ($q) {
                        $q->where('company_id', '=', Auth::user()->company_id);
                    })->where('active_status', $filter)->where('user_id', '=', Auth::user()->user_id)->orderBy('ideas.idea_id', 'DESC')->get();
                }
            } else {

                $ideas = Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id);
                })->where('user_id', '=', Auth::user()->user_id)->orderBy('ideas.idea_id', 'DESC')->get();
            }
            // dd($ideas->toArray());

            return view('frontend.myideas.index', ['ideas' => $ideas]);
        } elseif ($roles_external->role_type == 'Approving Authority') {

            if (Auth::user()->centralized_decentralized_type == '' || Auth::user()->centralized_decentralized_type == '1') {
                if (!empty($filter)) {
                    if ($filter == 'approved_ideas') {
                        $ideas = Ideas::where(['approving_authority_approval' => 1])->where(function ($query) {
                            $query->where('active_status', 'implementation')->where('implemented', 0);
                        })->where('user_id', '=', Auth::user()->user_id)->orderBy('idea_id', 'DESC')->get();
                    } elseif ($filter == 'in_assessment') {

                        $ideas = Ideas::whereHas('user', function ($q) {
                            $q->where('company_id', '=', Auth::user()->company_id);
                        })->where('active_status', $filter)->where('user_id', '=', Auth::user()->user_id)->where('active_status', 'in_assessment',)->where('assessment_team_approval', '!=', 1)->orderBy('ideas.idea_id', 'DESC')->get();
                    } else {
                        $ideas = Ideas::where(['active_status' => $filter])->where('user_id', '=', Auth::user()->user_id)->orderBy('idea_id', 'DESC')->get();
                    }
                } else {
                    $ideas = Ideas::where('user_id', '=', Auth::user()->user_id)->orderBy('idea_id', 'DESC')->get();
                }
                // dd($ideas->toArray());

            } else {
                if (!empty($filter)) {
                    if ($filter == 'approved_ideas') {
                        $ideas = Ideas::whereHas('user', function ($q) {
                            $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                        })->where(['approving_authority_approval' => 1])->where(function ($query) {
                            $query->where('active_status', 'implementation')->orWhere('active_status', 'implemented');
                        })->orderBy('ideas.idea_id', 'DESC')->get();
                        //    dd($ideas->toArray());
                    } elseif ($filter == 'in_assessment') {

                        $ideas = Ideas::whereHas('user', function ($q) {
                            $q->where('company_id', '=', Auth::user()->company_id);
                        })->where('active_status', $filter)->where('user_id', '=', Auth::user()->user_id)->where('active_status', 'in_assessment',)->where('assessment_team_approval', '!=', 1)->orderBy('ideas.idea_id', 'DESC')->get();
                    } else {
                        $ideas = Ideas::whereHas('user', function ($q) {
                            $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                        })->where(['active_status' => $filter])->orderBy('ideas.idea_id', 'DESC')->get();
                    }
                } else {
                    $ideas = Ideas::whereHas('user', function ($q) {
                        $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                    })->orderBy('ideas.idea_id', 'DESC')->get();
                    // dd($ideas->toArray());
                }
            }
            return view('frontend.myideas.index', ['ideas' => $ideas]);
        } elseif ($roles_external->role_type == 'Implementation') {
            if (!empty($filter)) {
                if ($filter == 'approved_ideas') {
                    $ideas = Ideas::whereHas('user', function ($q) {
                        $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                    })->where(['ideas.approving_authority_approval' => 1])->where(function ($query) {
                        $query->where('active_status', 'implementation')->where('implemented', 0);
                    })->orderBy('ideas.idea_id', 'DESC')->get();
                } elseif ($filter == 'in_assessment') {

                    $ideas = Ideas::whereHas('user', function ($q) {
                        $q->where('company_id', '=', Auth::user()->company_id);
                    })->where('active_status', $filter)->where('user_id', '=', Auth::user()->user_id)->where('active_status', 'in_assessment',)->where('assessment_team_approval', '!=', 1)->orderBy('ideas.idea_id', 'DESC')->get();
                } else {
                    $ideas = Ideas::whereHas('user', function ($q) {
                        $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                    })->where(['active_status' => $filter])->orderBy('ideas.idea_id', 'DESC')->get();
                }
            } else {
                $ideas = Ideas::whereHas('user', function ($q) {
                    $q->where('company_id', '=', Auth::user()->company_id)->where('user_id', '=', Auth::user()->user_id);
                })->orderBy('ideas.idea_id', 'DESC')->get();
                //    dd($ideas->toArray());
            }

            return view('frontend.myideas.index', ['ideas' => $ideas]);
        }
    }

    public function addIdea()
    {
        $benifits = IdeaBenifits::pluck('idea_benifit', 'idea_benifit');
        $extensions = Filesetting::get();
        $allowedExtensionsString = ['jpg','jpeg','png','gif','bmp','tiff','webp','mp3','wav','ogg','flac','aac','mp4','avi','mkv','mov','flv','wmv','pdf','doc','docx','xls','xlsx','ppt','pptx','txt','zip','rar'];
        $all_extensions = array();
        $all_extensions_and_limit = array();
        if(isset($extensions)  && count($extensions)> 0){
            foreach($extensions as $key=> $ext){
                $all_extensions[] = $allowedExtensionsString[$ext->allowed_extetnsion];
                $all_extensions_and_limit[] = ['name'=>$allowedExtensionsString[$ext->allowed_extetnsion],'limit'=>$ext->file_size];
            }

        }
        $all_extensions = implode(',',$all_extensions);
//,'all_extensions','all_extensions_and_limit'

        return view('frontend.myideas.addIdea_new', compact('benifits','all_extensions','all_extensions_and_limit'));
    }
    public function view($id)
    {

        $role = Auth::user()->role;
        $status_data = [];
        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role])->first();
        if (!empty($roles_external)) {
            $status_data = explode(',', $roles_external->status_values);
        }


        // $idea_active_status = IdeaActiveStatus::where('assessment_team', 1)->pluck('idea_active_status', 'idea_active_status_value');
        $idea_active_status = IdeaActiveStatus::where('assessment_team', 1)->whereIn('idea_active_status_value', $status_data)->pluck('idea_active_status', 'idea_active_status_value');

        // dd($idea_active_status->toArray());
        return view('frontend.myideas.view', ['idea' => Ideas::where('idea_id', $id)->first(), 'feedback' => Feedback::where('idea_id', $id)->orderBy('feedback_id', 'ASC')->get(), 'idea_active_status' => $idea_active_status]);
    }

    //For Approving Authority
    public function view_idea_approving_authority($id)
    {
        $role = Auth::user()->role;
        $status_data = [];
        $roles_external = Rolesexternal::where(['id' => Auth::user()->sub_role])->first();
        if (!empty($roles_external)) {
            $status_data = explode(',', $roles_external->status_values);
        }


        // $idea_active_status = IdeaActiveStatus::where('approving_authority', 1)->pluck('idea_active_status', 'idea_active_status_value');
        $idea_active_status = IdeaActiveStatus::where('approving_authority', 1)->whereIn('idea_active_status_value', $status_data)->pluck('idea_active_status', 'idea_active_status_value');
        // dd($idea_active_status);
        return view('frontend.myideas.view_idea_approving_authority', ['idea' => Ideas::where('idea_id', $id)->first(), 'feedback' => Feedback::where('idea_id', $id)->orderBy('feedback_id', 'ASC')->get(), 'idea_active_status' => $idea_active_status]);
    }
    //For Implementation Team
    public function view_idea_implementation_team($id)
    {

        $role = Auth::user()->role;
        // dd(Feedback::all());
        $idea_active_status = IdeaActiveStatus::where('implementation_team', 1)->pluck('idea_active_status', 'idea_active_status_value');
        return view('frontend.myideas.view_idea_implementation_team', ['idea' => Ideas::where('idea_id', $id)->first(), 'feedback' => Feedback::where('idea_id', $id)->orderBy('feedback_id', 'ASC')->get(), 'idea_active_status' => $idea_active_status]);
    }
    public function ideaRevision($id)
    {
        session::put('sub_page', url()->full());
        return view('frontend.myideas.ideaRevision', ['ideas' => IdeaRevision::where('idea_id', $id)->orderBy('created_at', 'DESC')->get(), 'id' => $id]);
    }
    public function viewIdeaRevision($id)
    {
        // dd(Feedback::all());
        return view('frontend.myideas.viewIdeaRevision', ['ideaRevision' => IdeaRevision::where('idea_revision_id', $id)->first()]);
    }




    public function storeIdea(Request $request)
    {
        //  dd($request->all());
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
        // $idea->user_id = Auth::id();
        // $idea->title = $request->title;
        // $idea->description = $request->description;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        $randomString = $randomString . time();
        //   $idea->idea_uni_id = $randomString;
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
            'company_id'=>Auth::user()->company_id,
        ];
        // dd($data_array);
        //save the idea
        $idea->fill($data_array);
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
                            return redirect('/myideas')->with('error', 'Failed to upload the files');
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
            // $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();

            // //send frontend notify
            // foreach ($assessmentUsersMails as $assessmentUser) {
            //     $idea_uni_id = $randomString;
            //     $title = 'New Idea';
            //     $description = 'New Idea has been created : ' . $request->title;
            //     $receiver_id = $assessmentUser->user_id;
            //     $role = 'Assessment Team';
            //     send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role);
            // }

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
                        $idea_uni_id = $randomString;
                        $title = 'New Idea';
                        $description = 'New Idea has been created : ' . $request->title;
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
            $description = 'New Idea has been created : ' . $request->title;
            send_backned_notification($idea_uni_id, $title, $description, Auth::id());



            // Sending mail to all admins,cc's and user
            try {


                $user = Users::where('user_id', Auth::id())->first();
                $first_name = $user['name'];
                $last_name = $user['last_name'];
                $user_email = $user['email'];
                $company_id = $user['company_id'];




                $Subject = "The Idea has been submitted successfully";
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
                if ($mail_send_to_user) {
                    $Subject1 = "The Idea has been submitted successfully";
                    $Body1 = "
                        <html>
                        <head>

                        </head>
                            <body>
                                <h4>
                                A new Idea has been submitted by <strong>$first_name $last_name</strong> <br>
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
                    //  foreach ($assestment_members as $data) {
                    //    mailCommunication($Subject1, $Body1, $data->email);
                    //  }
                    $cc_mail_ids = array();
                    $cc_mails = EmailConfig::where('team', 'like', 'Assessment Team')->first();
                    if (isset($cc_mails->emails)) {
                        $cc_mail_ids = explode(',', $cc_mails->emails);
                    }
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
            return redirect()->route('myideas.index')->with('success', 'Successfully Submitted the Idea!');
        } else {
            return redirect()->route('myideas.index')->with('error', 'Failed to submit the Idea!');
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
                return redirect('/myideas')->with('success', 'Idea Has Been Deleted');
            } else {
                return redirect('/myideas')->with('error', 'Failed to delete the Idea');
            }
        }
    }
    public function edit($id)
    {
        $idea = Ideas::where('idea_id', $id)->first();
        $benifits = IdeaBenifits::pluck('idea_benifit', 'idea_benifit');

        $extensions = Filesetting::get();
        $allowedExtensionsString = ['jpg','jpeg','png','gif','bmp','tiff','webp','mp3','wav','ogg','flac','aac','mp4','avi','mkv','mov','flv','wmv','pdf','doc','docx','xls','xlsx','ppt','pptx','txt','zip','rar'];
        $all_extensions = array();
        $all_extensions_and_limit = array();
        if(isset($extensions)  && count($extensions)> 0){
            foreach($extensions as $key=> $ext){
                $all_extensions[] = $allowedExtensionsString[$ext->allowed_extetnsion];
                $all_extensions_and_limit[] = ['name'=>$allowedExtensionsString[$ext->allowed_extetnsion],'limit'=>$ext->file_size];
            }

        }
        $all_extensions = implode(',',$all_extensions);
//,'all_extensions','all_extensions_and_limit'
        return view('frontend.myideas.updateIdea', compact('idea', 'benifits','all_extensions','all_extensions_and_limit'));
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
            // dd($request->fileName);
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < 10; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
            $randomString = $randomString . time();
            $idea_uni_id = $ideaQ->idea_uni_id;
            if ($request->file > 0 && $request->fileName > 0) {
                $countfiles = implode(' @$ ', $request->file);
                $imgaeview = explode(' @$ ', $countfiles);
                // dd($imgaeview);

                foreach ($imgaeview as $key => $val) {
                    $ideaImages = new IdeaImages();
                    // $ideaRevisionImages = new IdeaRevisionImages();
                    $image_parts = explode(";base64,", $val);
                    // dd($image_parts);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_base64 = base64_decode($image_parts[1]);

                    $fileNameParts = explode('.', $request->fileName[$key]);
                    $ext = end($fileNameParts);
                   // if ($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
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
                            return redirect('/myideas')->with('error', 'Failed to upload the files');
                        }
                    // } else {
                    //     return redirect()->back()->withErrors([
                    //         'message' => 'Please select the spcified type of files.'
                    //     ]);
                    // }
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
                        $filename = str_replace(' ', '_', $ideaImage->file_name);
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
                        // $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();

                        // //send forntend notify
                        // foreach ($assessmentUsersMails as $assessmentUser) {
                        //     $title = 'The Idea Has Been Updated.' . ' Idea Title : ' . $request->title;
                        //     $description = 'Idea Description : ' . $request->description;
                        //     $receiver_id = $assessmentUser->user_id;
                        //     $role = 'Assessment Team';
                        //     send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role);
                        // }

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
                                    $idea_uni_id = $randomString;
                                    $title = 'New Idea';
                                    $description = 'New Idea has been created : ' . $request->title;
                                    $receiver_id = $assessmentUser->user_id;
                                    $role = 'Assessment Team';
                                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role);
                                    $send_mail_email[] = $assessmentUser->email;
                                }
                            }
                        }

                        //send backend notify
                        $title = 'The Idea Has Been Updated.' . ' Idea Title : ' . $request->title;
                        $description = 'Idea Description : ' . $request->description;
                        send_backned_notification($idea_uni_id, $title, $description, Auth::id());
                    }

                    //sending mail to user,all admins and cc's
                    try {

                        $user = Users::where('user_id', Auth::id())->first();
                        $first_name = $user['name'];
                        $last_name = $user['last_name'];
                        $user_email = $user['email'];
                        $company_id = $user['company_id'];

                        $Subject = "The Idea has been updated successfully";
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
                            $Subject1 = "The Idea has been updated successfully";
                            $Body1 = "
                        <html>
                        <head>

                        </head>
                            <body>
                                <h4>
                                Idea has been updated by <strong>$first_name $last_name</strong> <br>
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

                            // foreach ($assestment_members as $data) {
                            //     mailCommunication($Subject1, $Body1, $data->email);
                            // }

                            $cc_mail_ids = array();
                            $cc_mails = EmailConfig::where('team', 'like', 'Assessment Team')->first();
                            if (isset($cc_mails->emails)) {
                                $cc_mail_ids = explode(',', $cc_mails->emails);
                            }

                            if (isset($send_mail_email) && count($send_mail_email) > 0) {
                                mailCommunication_multple($Subject1, $Body1, $cc_mail_ids, $send_mail_email);
                            }
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }

                    return redirect('/myideas')->with('success', 'Idea Has Been Updated');
                }
            }
        }
    }

    ///ifran-code
    // public function update(Request $request)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'title' => 'required|max:500',
    //         'description' => 'required',
    //         'category_id' => 'required',
    //         // 'images' =>  'mimes:jpg,png,jpeg,pdf,doc,docx'
    //     ]);
    //     $idea = Ideas::where('idea_id', $request->idea)->get();
    //     // dd($idea);
    //     if (count($idea) > 0) {

    //         $ideaQ = Ideas::where('idea_id', $request->idea)->first();
    //         $ideaRevision = new IdeaRevision();
    //         $ideaRevision->idea_id = $request->idea;
    //         // dd($request->file);
    //         $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //         $randomString = '';
    //         for ($i = 0; $i < 10; $i++) {
    //             $index = rand(0, strlen($characters) - 1);
    //             $randomString .= $characters[$index];
    //         }
    //         $randomString = $randomString . time();
    //         $idea_uni_id = $ideaQ->idea_uni_id;
    //         if ($request->file > 0 && $request->fileName > 0) {
    //             $countfiles = implode(' @$ ', $request->file);
    //             $imgaeview = explode(' @$ ', $countfiles);
    //             // dd($imgaeview);
    //             $ideaQ->fill($request->all());

    //             foreach ($imgaeview as $key => $val) {
    //                 $ideaImages = new IdeaImages();
    //                 $ideaRevisionImages = new IdeaRevisionImages();
    //                 $image_parts = explode(";base64,", $val);
    //                 $image_type_aux = explode("image/", $image_parts[0]);
    //                 $image_base64 = base64_decode($image_parts[1]);
    //                 $fileNameParts = explode('.', $request->fileName[$key]);
    //                 $ext = end($fileNameParts);
    //                 if ($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
    //                     $filename = time() . '_' . str_replace(' ', '_', $request->fileName[$key]);
    //                     Storage::disk('local')->put('/public/uploads/' . $filename,  $image_base64);
    //                     // Storage::disk('local')->put('/public/uploads/idea_revision/' . $filename,  $image_base64);
    //                     $ideaImages->idea_uni_id = $idea_uni_id;
    //                     // $ideaRevisionImages->idea_uni_id = $randomString;
    //                     $file_path = 'uploads/' . $filename;
    //                     // $file_path_idea_revision = 'uploads/idea_revision/' . $filename;
    //                     $ideaImages->file_name = $filename;
    //                     $ideaImages->image_path = $file_path;
    //                     // $ideaRevisionImages->file_name = $filename;
    //                     // $ideaRevisionImages->image_path = $file_path_idea_revision;
    //                     $ideaRevisionImages->save();
    //                     if (!$ideaImages->save()) {
    //                         return redirect('/ideas')->with('error', 'Failed to upload the files');
    //                     }
    //                 } else {
    //                     return redirect()->back()->withErrors([
    //                         'message' => 'Please select the spcified type of files.'
    //                     ]);
    //                 }
    //             }
    //         }
    //         $ideaRevision->title = $request->title;
    //         $ideaRevision->description = $request->description;
    //         $ideaRevision->category_id = $request->category_id;
    //         $ideaRevision->idea_uni_id = $randomString;
    //         if ($ideaRevision->save()) {
    //             $ideaImages = IdeaImages::where('idea_uni_id', $idea_uni_id)->get();
    //             if ($ideaImages->toArray() > 0) {
    //                 foreach ($ideaImages as $ideaImage) {
    //                     $idea_images = new IdeaRevisionImages();

    //                     $filename = strrev(time()) . '_' . str_replace(' ', '_', $ideaImage->file_name);
    //                     Storage::disk('local')->copy('/public/' . $ideaImage->image_path, '/public/uploads/idea_revision/' . $filename);
    //                     $idea_images->image_path = 'uploads/idea_revision/' . $filename;
    //                     $idea_images->idea_uni_id = $ideaRevision->idea_uni_id;
    //                     $idea_images->file_name = $ideaImage->file_name;
    //                     $idea_images->save();
    //                 }
    //             }
    //             if ($ideaQ->save()) {
    //                 return redirect('/ideas')->with('success', 'Idea Has Been Updated');
    //             }
    //         }

    //     }
    // }



    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|max:500',
    //         'description' => 'required',
    //         'category_id' => 'required',
    //         'image' =>  'mimes:jpg,png,jpeg,pdf,doc,docx'
    //     ]);
    //     // dd($request->idea);
    //     $idea = Ideas::where('idea_id', $request->idea)->get();
    //     // dd($idea);
    //     if (count($idea) > 0) {
    //         $ideaQ = Ideas::where('idea_id', $request->idea)->first();
    //         $ideaRevision = new IdeaRevision();
    //         $ideaRevision->idea_id = $request->idea;

    //         if ($request->file()) {
    //             $fileName = time() . '_' . $request->image->getClientOriginalName();
    //             $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
    //             $ideaQ->image_path =  $filePath;
    //             $ideaRevision->image_path = $filePath;
    //         } else {
    //             $image_path = $ideaQ->image_path;
    //             $ideaRevision->image_path = $image_path;
    //         }

    //         $ideaQ->fill($request->all());
    //         $ideaRevision->fill($request->all());
    //         if ($ideaRevision->save()) {
    //             if ($ideaQ->save()) {
    //                 return redirect('/ideas')->with('success', 'Idea Has Been Updated');
    //             }
    //         }
    //     }
    // }
    public function storeFeedback(Request $request)
    {
        // dd(request());
        $validated = request()->validate([
            // 'feedback' => 'min:3'
        ]);
        $roles = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
        $feedback = new Feedback($validated);
        $feedback->idea_id = request()->idea_id;
        $feedback->user_id = Auth::id();
        $feedback->user_role = Auth::user()->role;
        $feedback->feedback = request()->feedback;


        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');

            // dd($file->getSize());
            if (restriction_filesize($file)) {


            // $file = $request->file('attachment');

            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/chats', $fileName, 'public');
            $feedback->media_file = $filePath;
            }else{
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
                    $notification->title = 'Comment has been posted by  ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                    $notification->description = 'Idea Title : ' . $idea_title . ' <br> Comment : ' . request()->feedback;
                    $notification->receiver_id = $idea['user_id'];
                    $notification->role = $roles->role_type;
                    $notification->save();


                    $idea_uni_id = $idea_uni_id;
                    $title = 'Comment has been posted by  ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                    $description = 'Idea Title : ' . $idea_title . ' <br> Comment : ' . request()->feedback;
                    send_backned_notification($idea_uni_id, $title, $description, Auth::id());
                }
            }
            return redirect()->back()->with('success', 'Comment Has Been Submitted Successfully');
        }
    }
    public function updateIdeaStatus(Request $request)
    {
        // dd($request->all());
        $approve_user_role = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
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

        // $role = Auth::user()->role;
        $role = $roles_external->role_type;
        if (count($status->toArray()) > 0) {
            // dd($request->get('idea_status'));
            // dd($request->all());
            // dd($request->idea_status);
            if ($request->idea_status == 'in_assessment') {
                // dd('assdg');
                $status->active_status = 'in_assessment';
                $status->save();

                //send frontend notify to user
                $title = 'The status of the Idea has been changed to Under Assessment by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                $description = 'Idea Title : ' . $idea_title;
                $receiver_id = $status['user_id'];
                $role_curr = 'User';
                send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);

                //send backend notify
                $idea_uni_id = $idea_uni_id;
                $title = 'The status of the Idea has been changed to Under Assessment by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                $description = 'Idea Title : ' . $idea_title;
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
                $cc_mail_ids = array();
                mailCommunication($Subject, $Body, $cc_mail_ids, $user_email);
                // }
            } elseif ($request->idea_status == 'reject') {
                $status->active_status = 'reject';
                $status->reject_reason = $request->reject_reason;
                $status->rejected = 1;
                $status->save();

                //notify user first
                $title = 'The Idea has been rejected (Reason : ' . $request->reject_reason . ' ) by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                $description = 'Idea Title : ' . $idea_title;
                $receiver_id = $status['user_id'];
                $role_curr = 'User';
                send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);

                $assessmentUsersMails = '';
                $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();

                //notify At.Team first
                if ($role == 'Approving Authority') {
                    foreach ($assessmentUsersMails as $assessmentUser) {
                        $title = 'The Idea has been rejected (Reason : ' . $request->reject_reason . ' ) by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                        $description = 'Idea Title : ' . $idea_title;
                        $receiver_id = $assessmentUser->user_id;
                        $role_curr = 'Assessment Team';
                        send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                    }
                }


                //backend notify
                $idea_uni_id = $idea_uni_id;
                $title = 'The Idea has been rejected (Reason : ' . $request->reject_reason . ' ) by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                $description = 'Idea Title : ' . $idea_title;
                send_backned_notification($idea_uni_id, $title, $description, Auth::id());

                $idea_title = $status['title'];
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
                        $Subject = "Idea has been Rejected";
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
                $title = 'The status of the Idea has been changed to On-hold by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                $description = 'Idea Title : ' . $idea_title;
                $receiver_id = $status['user_id'];
                $role_curr = 'User';
                send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);

                $assessmentUsersMails = '';
                $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();

                //notify At.Team first
                if ($role == 'Approving Authority') {
                    foreach ($assessmentUsersMails as $assessmentUser) {
                        $title = 'The status of the Idea has been changed to On-hold by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                        $description = 'Idea Title : ' . $idea_title;
                        $receiver_id = $assessmentUser->user_id;
                        $role_curr = 'Assessment Team';
                        send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                    }
                }


                //backend notify
                $idea_uni_id = $idea_uni_id;
                $title = 'The status of the Idea has been changed to On-hold by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                $description = 'Idea Title : ' . $idea_title;
                send_backned_notification($idea_uni_id, $title, $description, Auth::id());

                // if ($updated) {
                $user_email = '';
                $user_email = Users::where('user_id', $status['user_id'])->first();
                if ($user_email) {
                    $user_email = $user_email['email'];
                }
                // dd($email);

                // $mail->addAddress($user_email, 'Jmbaxi');
                $Subject = "Idea Has Been Putted On Hold";
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

                $data = FacadesDB::table('ideas')->where(['idea_id' => $request->idea_id, 'assessment_team_approval' => 1])->first();
                if ($role == 'User' && $data->asstmnt_rev_status != 1) {
                    $status->active_status = 'in_assessment';
                    $status->save();

                    //store status @naresh June 22
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
                } else {
                    $title = '';
                    $status->active_status = 'resubmit';
                    $status->resubmit_reason = $request->resubmit_reason;
                    $status->save();

                    // FacadesDB::table('ideas')->where('idea_id', $request->idea_id)->update(['approv_rev_status' => 1]);


                    if ($role == 'Assessment Team') {
                        // notify user first
                        $title = 'The status of the Idea has been changed to Revise Request(Reason : ' . $request->resubmit_reason . ' ) by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                        $description = 'Idea Title : ' . $idea_title;
                        $receiver_id = $status['user_id'];
                        $role_curr = 'User';
                        send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                    } else if ($role == 'Approving Authority') {



                        if (Auth::user()->centralized_decentralized_type == '1' || Auth::user()->centralized_decentralized_type == '') {
                            $assessmentUsersMails = '';
                            $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                            $assessmentUsersMails = DB::table('users')->where(['active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                        } else {
                            $assessmentUsersMails = '';
                            $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                            $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                        }

                        //notify At.Team first
                        foreach ($assessmentUsersMails as $assessmentUser) {
                            $title = 'The status of the Idea has been changed to Revise Request(Reason : ' . $request->resubmit_reason . ' ) by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                            $description = 'Idea Title : ' . $idea_title;
                            $receiver_id = $assessmentUser->user_id;
                            $role_curr = 'Assessment Team';
                            send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
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
                    $title = 'The status of the Idea has been changed to Revise Request(Reason : ' . $request->resubmit_reason . ' ) by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                    $description = 'Idea Title : ' . $idea_title;

                    send_backned_notification($idea_uni_id, $title, $description, Auth::id());



                    // if ($updated) {

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
                            Reason of Revise : " . htmlentities($request->reject_reason) . "
                        </h4>
                    </body>
                </html>";
                    $cc_mail_ids = array();
                    mailCommunication($Subject, $Body, $cc_mail_ids, $user_email);
                    // }
                }
            } elseif ($request->idea_status == 'under_approving_authority') {
                $status->active_status = 'under_approving_authority';
                $status->save();


                //notify user first
                $title = 'The status of the Idea has been changed to Under Approval by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                $description = 'Idea Title : ' . $idea_title;
                $receiver_id = $status['user_id'];
                $role_curr = 'User';
                send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);

                $assessmentUsersMails = '';
                $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();

                // dd($role);
                //notify At.Team first
                if ($role == 'Approving Authority') {
                    foreach ($assessmentUsersMails as $assessmentUser) {
                        $title = 'The status of the Idea has been changed to Under Approval by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                        $description = 'Idea Title : ' . $idea_title;
                        $receiver_id = $assessmentUser->user_id;
                        $role_curr = 'Assessment Team';
                        send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                    }
                }

                //backend notify
                $idea_uni_id = $idea_uni_id;
                $title = 'The status of the Idea has been changed to Under Approval by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                $description = 'Idea Title : ' . $idea_title;
                send_backned_notification($idea_uni_id, $title, $description, Auth::id());
            } elseif ($request->idea_status == 'implementation') {
                $status->active_status = 'implementation';


                $notification = new Notification();
                $notification->idea_uni_id = $idea_uni_id;
                $notification->title = 'The status of the Idea has been changed to Implementation by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                $notification->description = 'Idea Title : ' . $idea_title;
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
                $title = 'The status of the Idea has been changed to Implementation by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (' . $role . ')';
                $description = 'Idea Title : ' . $idea_title;
                // $notification1->receiver_id = Auth()->guard('admin')->user()->admin_user_id;
                // $notification1->save();
                send_backned_notification($idea_uni_id, $title, $description, Auth::id());
            }
            // if ($status->save()) {
            if ($request->role == 'Implementation') {
                return redirect()->route('ideas.view_idea_implementation_team', ['id' => $request->idea_id])->with('success', 'Idea Status Has Been Updated');
            } elseif ($request->role == 'Approving Authority') {
                return redirect()->route('ideas.view_idea_approving_authority', ['id' => $request->idea_id])->with('success', 'Idea Status Has Been Updated');
            } else {
                return redirect()->route('ideas.view', ['id' => $request->idea_id])->with('success', 'Idea Status Has Been Updated');
            }
            // }
        }
    }
    // Approving Idea by Assessment Team User
    public function approveIdeaBAU($id)
    {

        if (Auth::user()->centralized_decentralized_type == '1' || Auth::user()->centralized_decentralized_type == '') {
            $status = Ideas::where('idea_id', $id)->first();
        } else {
            $status = Ideas::whereHas('user', function ($q) {
                $q->where('company_id', '=', Auth::user()->company_id);
            })->where('idea_id', $id)->orderBy('ideas.idea_id', 'DESC')->first();
        }
        if ($status->assessment_team_approval == 1) {
            return redirect()->route('ideas.view', ['id' => $id, 'role' => request()->role]);
        } else {
            $approve_user_role = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
            $idea_status = new IdeaStatus;
            if (count($status->toArray()) > 0) {
                $status->assessment_team_approval = 1;
                $idea_status->idea_id = request()->id;
                $idea_status->user_id = Auth::id();
                //$idea_status->user_role = Auth::user()->role;
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
                    $assessmentUsersMails = DB::table('users')->where(['active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                    // $assessmentUsersMails = DB::table('users')->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();


                    $title = 'Idea has been approved by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Assessment Team)';
                    $description = 'Idea Title : ' . $idea_title;
                    send_backned_notification($idea_uni_id, $title, $description, Auth::id());

                    // notify user as well
                    $title = 'Idea has been approved by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Assessment Team)';
                    $description = 'Idea Title : ' . $idea_title;
                    $receiver_id = $status->user_id;
                    $role_curr = 'User';
                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);


                    //notify all members of AA- team
                    if ($assessmentUsersMails->toArray() > 0) {
                        foreach ($assessmentUsersMails as $row) {
                            if ($row->centralized_decentralized_type == 2) {
                                $assessmentUsersMailsD = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();

                                foreach ($assessmentUsersMailsD as $row1) {
                                    $title = 'Idea has been approved by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Assessment Team)';
                                    $description = 'Idea Title : ' . $idea_title;
                                    $receiver_id = $row1->user_id;
                                    $role_curr = 'Approving Authority';
                                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                                }
                            } else {
                                $title = 'Idea has been approved by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Assessment Team)';
                                $description = 'Idea Title : ' . $idea_title;
                                $receiver_id = $row->user_id;
                                $role_curr = 'Approving Authority';
                                send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                            }
                        }
                    }




                    //  Seding mail to Approving Authority Team wiht (C/D) condtion, admins and cc's
                    try {

                        $Subject1 = "The Idea has been assessed and sent for the Approval to the Approving Authority";
                        $Body1 = "
                    <html>
                    <head>

                    </head>
                        <body>
                            <h4>
                            The Idea has been assessed and approved by <strong>$ATuser_first_name $ATuser_last_name</strong> <br>
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
                            //if centralized then send mail to all members
                            if ($data->centralized_decentralized_type == 1) {
                                //    mailCommunication($Subject1, $Body1, $data->email);
                                // dd($data->email);
                                $send_mail_email[] = $data->email;
                            }
                            //if decentralized then send mail to members of same company
                            else if ($data->centralized_decentralized_type == 0) {
                                $approving_auth_members1 = Users::where(['role' => 'Approving Authority', 'company_id' => $company_id, 'active_status' => 1])->get();
                                // dd($data->email);
                                foreach ($approving_auth_members1 as $data1) {
                                    $send_mail_email[] = $data1->email;
                                    //   mailCommunication($Subject1, $Body1, $data1->email);
                                }
                            }
                        }

                        $cc_mail_ids = array();
                        $cc_mails = EmailConfig::where('team', 'like', 'Approving Authority')->first();
                        if (isset($cc_mails->emails)) {
                            $cc_mail_ids = explode(',', $cc_mails->emails);
                        }

                        if (isset($send_mail_email) && count($send_mail_email) > 0) {
                            mailCommunication_multple($Subject1, $Body1, $cc_mail_ids, $send_mail_email);
                        }
                        // mailCommunication($Subject1,$Body1,$user_email);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }


                    // Email Notification code ends



                    return redirect()->route('ideas.view', ['id' => $id])->with('success', 'Idea Has Been successfully sent for the approval');

                    // }
                }
            }
        }
    }

    //approved idead by AA and send for implementation
    public function approveIdeaBAA($id)
    {


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
                $approve_user_role = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();
                $idea_status = new IdeaStatus;
                $idea_status->idea_id = request()->id;
                $idea_status->user_id = Auth::id();
                //$idea_status->user_role = Auth::user()->role;
                if (isset($approve_user_role->role_name)) {
                    $idea_status->user_role = $approve_user_role->role_name;
                }
                $idea_status->idea_status = 'approving_authority_approved';
                $idea_status->save();
                $idea_uni_id = $status->idea_uni_id;
                if ($status->save()) {
                    // $assessmentUsersMails = Users::where('company_id', $company_id)->where('role', 'Implementation')->get();
                    $roles_external = Rolesexternal::where(['role_type' => 'Implementation'])->pluck('id')->toArray();
                    $imple_team = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                    $ATuser_first_name = Auth::user()->name;
                    $ATuser_last_name = Auth::user()->last_name;
                    $ATuser_email = Auth::user()->email;


                    //backend notify
                    $title = 'Idea has been approved by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Approving Authority)';
                    $description = 'Idea Title : ' . $idea_title;
                    send_backned_notification($idea_uni_id, $title, $description, Auth::id());


                    //notify user first
                    $title = 'Idea has been approved by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Approving Authority)';
                    $description = 'Idea Title : ' . $idea_title;
                    $receiver_id = $status['user_id'];
                    $role_curr = 'User';
                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);



                    //notify Imple Team
                    // $send_mail_email = array();
                    if ($imple_team->toArray() > 0) {
                        foreach ($imple_team as $assessmentUser) {
                            $title = 'Idea has been approved by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Approving Authority)';
                            $description = 'Idea Title : ' . $idea_title;
                            $receiver_id = $assessmentUser->user_id;
                            $role_curr = 'Implementation';
                            // $send_mail_email[] = $assessmentUser->email;
                            send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                        }
                    }

                    //notify A.t Team
                    $assessmentUsersMails = '';
                    $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                    $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();

                    if ($assessmentUsersMails->toArray() > 0) {
                        foreach ($assessmentUsersMails as $assessmentUser) {
                            $title = 'Idea has been approved by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Approving Authority)';
                            $description = 'Idea Title : ' . $idea_title;
                            $receiver_id = $assessmentUser->user_id;
                            $role_curr = 'Assessment Team';
                            send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                        }
                    }



                    // Email Notification code start



                    //  sending mail to implementation team members for same company,admins and cc's
                    try {
                        // dd($email);
                        // $mail->addAddress($user_email, 'Jmbaxi');
                        $Subject = "The Idea has been approved by the Approving Authority";
                        $Body = "
                    <html>
                    <head>

                    </head>
                        <body>
                            <h4>
                                Idea has been approved by <strong>$ATuser_first_name $ATuser_last_name</strong> <br>
                                <strong>Approving Authority User e-mail</strong> : $ATuser_email
                                <br>
                                Idea Title : <strong>" . htmlentities($idea_title) . "</strong>
                            </h4>
                        </body>
                    </html>";
                        // $mail->Send();
                        // $imple_team_members = Users::where(['role' => 'Implementation', 'company_id' => $company_id, 'active_status' => 1])->get();
                        // $roles_external = Rolesexternal::where(['role_type' => 'Implementation'])->pluck('id')->toArray();
                        // $imple_team_members = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();

                        $roles_external = Rolesexternal::where(['role_type' => 'Implementation'])->pluck('id')->toArray();
                        //$imple_team_members = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                        $imple_team_members = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->get();
                        // foreach ($imple_team_members as $data) {
                        //  //   mailCommunication($Subject, $Body, $data->email);
                        // }
                        $send_mail_email = array();
                        foreach ($imple_team_members as $implm) {
                            if ($implm->sub_role != null) {
                                $sub_role_data = explode(',', $implm->sub_role);
                                $check_if_exist = !empty(array_intersect($roles_external, $sub_role_data));
                                if ($check_if_exist) {
                                    $send_mail_email[] = $assessmentUser->email;
                                }
                            }
                        }

                        $cc_mail_ids = array();
                        $cc_mails = EmailConfig::where('team', 'like', 'Implementation Team')->first();
                        if (isset($cc_mails->emails)) {
                            $cc_mail_ids = explode(',', $cc_mails->emails);
                        }

                        if (isset($send_mail_email) && count($send_mail_email) > 0) {
                            mailCommunication_multple($Subject, $Body, $cc_mail_ids, $send_mail_email);
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
            $approve_user_role = Rolesexternal::where(['id' => Auth::user()->sub_role_final])->first();

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

                if ($status->save()) {
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
                    $roles_external = Rolesexternal::where(['role_type' => 'Approving Authority'])->pluck('id')->toArray();
                    $Approv_team = DB::table('users')->where(['active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();
                    $ATuser_first_name = Auth::user()->name;
                    $ATuser_last_name = Auth::user()->last_name;
                    $ATuser_email = Auth::user()->email;





                    //notify user first
                    $title = 'Idea has been Implemented by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Implementation Team)';
                    $description = 'Idea Title : ' . $idea_title;
                    $receiver_id = $status['user_id'];
                    $role_curr = 'User';
                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);



                    //notify A.A Team
                    if ($Approv_team->toArray() > 0) {
                        foreach ($Approv_team as $row) {
                            if ($row->centralized_decentralized_type == 2) {
                                $assessmentUsersMailsD = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();

                                foreach ($assessmentUsersMailsD as $row1) {
                                    $title = 'Idea has been Implemented by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Implementation Team)';
                                    $description = 'Idea Title : ' . $idea_title;
                                    $receiver_id = $row1->user_id;
                                    $role_curr = 'Approving Authority';
                                    send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                                }
                            } else {

                                $title = 'Idea has been Implemented by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Implementation Team)';
                                $description = 'Idea Title : ' . $idea_title;
                                $receiver_id = $row->user_id;
                                $role_curr = 'Approving Authority';
                                send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                            }
                        }
                    }

                    //notify A.t Team
                    $assessmentUsersMails = '';
                    $roles_external = Rolesexternal::where(['role_type' => 'Assessment Team'])->pluck('id')->toArray();
                    $assessmentUsersMails = DB::table('users')->where(['company_id' => $company_id, 'active_status' => 1])->whereRaw('FIND_IN_SET(?, sub_role)', [$roles_external])->get();

                    if ($assessmentUsersMails->toArray() > 0) {
                        foreach ($assessmentUsersMails as $assessmentUser) {
                            $title = 'Idea has been Implemented by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Implementation Team)';
                            $description = 'Idea Title : ' . $idea_title;
                            $receiver_id = $assessmentUser->user_id;
                            $role_curr = 'Assessment Team';
                            send_frontend_notification($idea_uni_id, $title, $description, $receiver_id, $role_curr);
                        }
                    }


                    //backend notify
                    $idea_uni_id = $idea_uni_id;
                    $title = 'Idea has been Implemented by ' . $ATuser_first_name . ' ' . $ATuser_last_name . ' (Implementation Team)';
                    $description = 'Idea Title : ' . $idea_title;
                    send_backned_notification($idea_uni_id, $title, $description, Auth::id());



                    // Email Notification code ends

                    //send mail to user,admins and cc's once successfully impelementated
                    try {

                        $Subject = "The  Idea has been implementated by implementation team";
                        $Body = "
                          <html>
                          <head>

                          </head>
                              <body>
                                  <h4>
                                  Your Idea has been implemented by <strong>$ATuser_first_name $ATuser_last_name</strong> <br>
                                  <strong>User e-mail of implementation team</strong> : $ATuser_email
                                  <br>
                                  Idea Title : <strong>" . htmlentities($idea_title) . "</strong>
                                  </h4>
                              </body>
                          </html>";
                        $ideas = Ideas::where('idea_id', $id)->first();
                        $users = Users::where(['user_id' => $ideas->user_id, 'active_status' => 1])->first();
                        // $mail->Send();

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
                                echo count($cc) . '<br><br>';
                                if (count($cc) > 1) {
                                    foreach ($cc as $cc => $sub) {
                                        $cc_mail_ids[] = [$sub];
                                    }
                                } else {
                                    $cc_mail_ids[] = $cc;
                                }
                            }
                        }

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
        $files = IdeaImages::where('idea_uni_id', $request->idea_uni_id)->get();

        if ($files) {
            foreach ($files as $file) {
                // dd($image);
                $fileNameParts = explode('.', $file->file_name);
                $ext = end($fileNameParts);
                // dump((asset('storage/app/public/' . $file->image_path)));
                if (Storage::disk('local')->exists('/public/' . $file->image_path)) {
                    if ($ext == 'doc') {
                        $img_path = asset('storage/app/public/uploads/asset/doc.png');
                    } elseif ($ext == 'pdf') {
                        $img_path = asset('storage/app/public/uploads/asset/pdf.png');
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

        if ($files) {
            foreach ($files as $file) {
                // dd($image);
                $fileNameParts = explode('.', $file->file_name);
                $ext = end($fileNameParts);
                if (Storage::disk('local')->exists('/public/' . $file->image_path)) {
                    if ($ext == 'doc') {
                        $img_path = asset('storage/app/public/uploads/asset/doc.png');
                    } elseif ($ext == 'pdf') {
                        $img_path = asset('storage/app/public/uploads/asset/pdf.png');
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
                dd(($ideas));
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
        // $data = FacadesDB::table('ideas')->where(['idea_id'=>$id,'asstmnt_rev_status'=>1])->get();
        DB::table('ideas')->where('idea_id', $id)->update(['asstmnt_rev_status' => 1]);

        return redirect()->route('myideas.view', ['id' => $id])->with('success', 'Idea Status Has Been Updated For User');
    }
}
