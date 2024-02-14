<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Categories extends Model
{
  //use Sluggable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';
    protected $primaryKey = 'category_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'category_name', 'visibility','sub_category'
    ];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    // public function sluggable()
    // {
    //     return [
    //         'category_slug' => [
    //             'source' => 'category_name',
    //             'onUpdate'=>true
    //         ]
    //     ];
    // }

}
