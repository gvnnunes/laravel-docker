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
   
    public function getFormattedCpfAttribute()
    {
        $cpf = $this->attributes['cpf'];

        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 3);
    }

    public function getFormattedPhoneAttribute()
    {
        $phone = $this->attributes['phone'];

        if(strlen($phone) ==  10)
            return '(' . substr($phone, 0, 2) . ') ' . substr($phone, 2, 4) . '-' . substr($phone, 6, 4);
        else if(strlen($phone) == 11)
            return '(' . substr($phone, 0, 2) . ') ' . substr($phone, 2, 5) . '-' . substr($phone, 7, 4);
    }   

    public function getFormattedBirthAttribute()
    {        
        $birth = explode('-', $this->attributes['birth']);
        $birth = $birth[2] . '/' . $birth[1] . '/' . $birth[0];
        
        return $birth;
    }
}


