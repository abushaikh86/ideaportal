<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IdeaBenifits extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'idea_benifits';
  protected $primaryKey = 'idea_benifit_id';

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['idea_benifit', 'status'];
  public function idea()
  {
    return $this->belongsTo(Ideas::class, 'idea_uni_id');
  }
}
