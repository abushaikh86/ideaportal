<?php

namespace App\Models\frontend;

use App\Models\frontend\Users;
use App\Models\frontend\IdeaImages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IdeaJourney extends Model
{
    use SoftDeletes;
    protected $table = 'idea_journey';
    protected $primaryKey = 'idea_journey_id';


    protected $fillable = [
        'idea_id', 'user_id', 'role_id', 'final_role_id', 'idea_description', 'outcome', 'why_implemented', 'challenges', 'idea_not_implemented', 'has_alternatives', 'has_less_benifits', 'benifits', 'remarks'
    ];

}
