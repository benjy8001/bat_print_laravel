<?php

namespace rotostock;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use SoftDeletes;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	'name', 'email', 'password',
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
	 * [authorizeRoles description]
	 * @param  [type] $roles [description]
	 * @return [type]        [description]
	 */
	public function authorizeRoles($roles)
	{
		if ($this->hasAnyRole($roles)) {
			return true;
		}
		abort(403, 'This action is unauthorized.');
		//return redirect()->back()->with('error', 'This action is unauthorized.');
	}

	/**
	 * [hasAnyRole description]
	 * @param  [type]  $roles [description]
	 * @return boolean        [description]
	 */
	public function hasAnyRole($roles)
	{
		if (is_array($roles)) {
			foreach ($roles as $role) {
				if ($this->hasRole($role)) {
					return true;
				}
			}
		} else {
			if ($this->hasRole($roles)) {
				return true;
			}
		}
		return false;
	}

	/**
	 * [hasRole description]
	 * @param  [type]  $role [description]
	 * @return boolean       [description]
	 */
	public function hasRole($role)
	{
		if ($this->roles()->where('name', $role)->first()) {
			return true;
		}
		return false;
	}

	public function roles()
	{
		return $this
		->belongsToMany('rotostock\Role')
		->withTimestamps();
	}
}
