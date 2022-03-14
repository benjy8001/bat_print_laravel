<?php

namespace rotostock\Http\Controllers;

use Illuminate\Http\Request;
use rotostock\Http\Requests;
use rotostock\User;
use rotostock\Role;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	/**
	 * Affichage de la page de listing des users
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function viewUsers(Request $request)
	{
		$request->user()->authorizeRoles('administrateur');

		$users 		= User::get();
		//dd($users);

		return view('user.liste')->with('users', $users);
	}

	/**
	 * [updateUser description]
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function updateUser(Request $request, $id)
	{
		$request->user()->authorizeRoles('administrateur');

		$user = User::find($id);

		if ($request->isMethod('post'))
		{
			$this->validate($request, [
				'name' => 'required|max:200'
				, 'email' => 'required|email|max:255'
				, 'role_id' => 'required'
				, 'password' => 'min:6' //|confirmed
				]);

			$parameters = $request->except(['_token']);

			$user->name 	= $parameters['name'];
			$user->email 	= $parameters['email'];
			//Si le mot de passe est defini
			if(!empty($parameters['password']))
				$user->password 	= bcrypt($parameters['password']);
			$user->save();

			//On retire les roles
			$user->roles()->detach();
			//On ajoute le role selectionné
			$user->roles()->attach($parameters['role_id']);

			return redirect()->route('viewUsers')->with('success', 'L\'utilisateur à été mis à jour.');
		}

		$roles = Role::get();

		return view('user/addUser', ['user' => $user, 'roles' => $roles]);
	}

	/**
	 * [profileUser description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function profileUser(Request $request)
	{
		//$user = User::find($id);
		$user = Auth::user();

		if ($request->isMethod('post'))
		{
			$this->validate($request, [
				'name' => 'required|max:200'
				, 'password' => 'min:6'
				]);

			$parameters = $request->except(['_token']);

			$user->name 	= $parameters['name'];
			//Si le mot de passe est defini
			if(!empty($parameters['password']))
				$user->password 	= bcrypt($parameters['password']);
			$user->save();

			return redirect()->route('profileUser')->with('success', 'L\'utilisateur à été mis à jour.');
		}

		$roles = Role::get();

		return view('user/profileUser', ['user' => $user]);
	}

	/**
	 * [createUser description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function createUser(Request $request)
	{
		$request->user()->authorizeRoles('administrateur');
		//
		if ($request->isMethod('post'))
		{
			$this->validate($request, [
				'name' => 'required|max:200'
				, 'email' => 'required|email|max:255|unique:users'
				, 'password' => 'required|min:6'
				, 'role_id' => 'required'
				]);

			$parameters = $request->except(['_token']);

       			//Reference::create($parameters);
			$attributes = ['email' => $parameters['email']];
			if (! $user = User::withTrashed()->where($attributes)->first()) {
				$user = new User($attributes);
			}
			if ($user->trashed())
			{
				$user->restore();
			}
			$user->name 		= $parameters['name'];
			$user->email 		= $parameters['email'];
			$user->password 	= bcrypt($parameters['password']);
			$user->save();

			//On retire les roles
			$user->roles()->detach();
			//On ajoute le role selectionné
			$user->roles()->attach($parameters['role_id']);

			return redirect()->route('viewUsers')->with('success', 'L\'utilisateur a été ajouté.');
		}

		$roles = Role::get();
		return view('user/addUser', ['roles' => $roles]);
	}

	/**
	 * [deleteUser description]
	 * @return [type]     [description]
	 */
	public function deleteUser(Request $request, $id)
	{
		$request->user()->authorizeRoles('administrateur');

		$user = User::find($id);
		$user->delete();

		return redirect()->route('viewUsers')->with('success', 'L\'utilisateur à été supprimé.');
	}
}
