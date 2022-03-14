<?php

namespace rotostock;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

	public function users()
	{
		return $this
		->belongsToMany('rotostock\User')
		->withTimestamps();
	}
}
