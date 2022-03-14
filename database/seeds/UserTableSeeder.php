<?php

use Illuminate\Database\Seeder;
use rotostock\User;
use rotostock\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$role_utilisateur = Role::where('name', 'utilisateur')->first();
    	$role_administrateur  = Role::where('name', 'administrateur')->first();
    	//
    	$utilisateur = new User();
    	$utilisateur->name = 'Utilisateur Test';
    	$utilisateur->email = 'utilisateur@exemple.com';
    	$utilisateur->password = bcrypt('secret');
    	$utilisateur->save();
    	$utilisateur->roles()->attach($role_utilisateur);
    	//
    	$administrateur = new User();
    	$administrateur->name = 'Admin Test';
    	$administrateur->email = 'manager@exemple.com';
    	$administrateur->password = bcrypt('secret');
    	$administrateur->save();
    	$administrateur->roles()->attach($role_administrateur);
    	//
    	$administrateur = new User();
    	$administrateur->name = 'Benjamin Mabille';
    	$administrateur->email = 'benjamin.mabille@plug-it.com';
    	$administrateur->password = bcrypt('5kk1gd9s');
    	$administrateur->save();
    	$administrateur->roles()->attach($role_administrateur);
    }
}
