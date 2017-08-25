<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'account_type' , 'school_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function findComplete() {
        return self::select('users.id','users.name','users.email','users.account_type','users.school_id',
                'users.created_at','schools.id as schoolID','schools.name as school')
                ->leftJoin('schools','users.school_id','=','schools.id');
    }
}
