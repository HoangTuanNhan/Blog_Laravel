<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @version November 7, 2017, 1:50 pm UTC
 *
 * @property string name
 * @property string image
 * @property integer category_id
 * @property integer author
 * @property string content
 */
class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'image',
        'category_id',
        'author',
        'content'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'image' => 'string',
        'category_id' => 'integer',
        'author' => 'integer',
        'content' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'image' => 'required',
        'category_id' => 'required',
        'author' => 'required',
        'content' => 'required'
    ];

    
}
