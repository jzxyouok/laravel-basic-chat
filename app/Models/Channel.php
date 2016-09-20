<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
	protected $table = 'channels';
	
	public function users()
	{
		return $this->belongsToMany('App\User');
	}
	
	public function messages()
	{
		return $this->hasMany('App\Models\Message');
	}
	
	public function otherUser()
	{
		return $this->users()->whereNotIn('email', [Auth::user()->email])->first();
	}
	
	public function otherThanGivenUser($user)
	{
		return $this->users()->whereNotIn('email', [$user->email])->first();
	}
}
