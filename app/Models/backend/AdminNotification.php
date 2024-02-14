<?php

namespace App\Models\backend;

use App\Models\frontend\Ideas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminNotification extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'admin_notification';
  protected $primaryKey = 'notification_id ';

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['notification_id', 'title','idea_uni_id', 'description', 'receiver_id', 'notification_read', 'created_at', 'updated_at', 'deleted_at'];

  public function notification_ideas(){
    return $this->HasOne(Ideas::class,'idea_uni_id','idea_uni_id');
  }
}
