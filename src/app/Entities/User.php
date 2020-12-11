<?php

namespace App\Entities;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Authenticatable
{    
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public    $timestamps   = true;
    protected $table        = 'users';      
    protected $fillable     = ['name','cpf','phone','birth','email','password','status','permission'];
    protected $hidden       = ['password','remember_token'];
    
}
