<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models
 * @version November 5, 2017, 8:52 am UTC
 *
 * @property string username
 * @property string email
 * @property string avatar
 * @property string password
 * @property tinyInteger is_admin
 */
class User extends Model
{
    use SoftDeletes;

    public $table = 'users';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'username',
        'email',
        'avatar',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'username' => 'string',
        'email' => 'string',
        'avatar' => 'string',
        'password' => 'string',
         'password_confirmation' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'username' => 'required|max:100',
        'email' => 'required|max:100|email',
        'avatar' => 'max:1000',
        'password' => 'required|max:100|confirmed',
        'is_admin' => 'required|in:1,2'
    ];

    
}
