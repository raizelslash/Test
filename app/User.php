<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password', 'status', 'role','shipping_address','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
//    user ra arko table sanga forigh user garda
//    public function useranduserinfo(){
//        return$this->hasOne('App\Models\Userinfo','user_id','id')->where('status','active');
//    }
//user ko info pauna yo function use garne
    public function getalluser( $type='vendor'){
        return $this->where('role',$type)->get();
    }
}
