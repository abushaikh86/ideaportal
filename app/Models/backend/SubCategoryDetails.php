<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class SubCategoryDetails extends Model
{
//   use Sluggable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sub_category_details';
    protected $primaryKey = 'sub_category_details_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['sub_category_details_id', 'sub_category_id', 'sub_category_details', 'visibility'];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    // public function sluggable()
    // {
    //     return [
    //         'sub_category_slug' => [
    //             'source' => 'subcategory_name',
    //             'onUpdate'=>true
    //         ]
    //     ];
    // }

}
