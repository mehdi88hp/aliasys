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
        'name', 'email', 'password','code','total_point','level','phone','address','active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	public function isAdmin() {
		return $this->level === 'admin' ? true : false;
	}
	public function prize(){
		return $this->belongsToMany(Prize::class,'user_prize')->withTimestamps();;
	}
	public function message(){
		return $this->hasMany(Message::class);
	}
	public function activationCode() {
		return $this->hasMany( ActivationCode::class );
	}
}
