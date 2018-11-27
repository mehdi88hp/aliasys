<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model {
	protected $guarded = [];
	public function user(){
		return $this->belongsToMany(User::class,'user_prize')->withTimestamps();;
	}
}
