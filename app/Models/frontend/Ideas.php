<?php

namespace App\Models\frontend;

use App\Models\frontend\Users;
use App\Models\frontend\IdeaImages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ideas extends Model
{
    use SoftDeletes;
    protected $table = 'ideas';
    protected $primaryKey = 'idea_id';


    protected $fillable = ['idea_id', 'user_id','company_id', 'rating', 'idea_uni_id', 'title', 'description', 'idea_outcome', 'why_implemented' ,
    'challeges' , 'already_implemented_or_no' , 'alternatives', 'cost_and_benifits' , 'benifits' , 'image_path',
    'category_id', 'created_at', 'update_at', 'deleted_at', 'reject_reason', 'resubmit_reason', 'implemented', 'approving_authority_approval',
     'assessment_team_approval', 'active_status', 'certificate','failed_to_implement','failed_to_implement_reasones','reject_implementor_id',
     'estimate_budget','expenses_approved','expenses_incurred','expenses_approved_company','spoc_details','sla_reason_assessment','sls_date_assessment','sla_reason_approver','sls_date_approver','sla_implementor_reason','sla_implementor_date'
    // 'assessment_idea_clarity', 'assessment_outcome', 'assessment_why_implemented', 'assessment_challenges', 'assessment_is_no_implemented',
    // 'assessment_has_alternatives', 'assessment_has_less_benifits', 'assessment_benifits', 'assessment_set_by', 'approver_idea_clarity',
    // 'approver_outcome', 'approver_why_implemented', 'approver_challenges', 'approver_is_no_implemented', 'approver_has_alternatives',
    // 'approver_has_less_benifits', 'approver_benifits', 'approve_set_by'
    ];

    // Relations
    public function user()
    {
        return $this->hasOne(Users::class, 'user_id', 'user_id');
    }
    public function user_with_company()
    {
        return $this->hasOne(Users::class, 'user_id', 'user_id')->where('company_id', Auth::user()->company_id);
    }
    public function company_data()
    {
        return $this->hasOne(Users::class, 'user_id', 'user_id');
    }
    public function images()
    {
        return $this->hasMany(IdeaImages::class, 'idea_uni_id');
    }
}
