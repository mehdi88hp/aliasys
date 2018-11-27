<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserPrize extends Pivot
{
    protected $table = 'user_prize';
    public function user(){
    	return $this->belongsTo(User::class);
    }
	public function prize(){
 	return $this->belongsTo(Prize::class);
 }
}
