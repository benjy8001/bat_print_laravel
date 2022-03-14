<?php

use Illuminate\Database\Seeder;
use rotostock\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$role_employee = new Role();
    	$role_employee->name = 'utilisateur';
    	$role_employee->description = 'Compte utilisateur';
    	$role_employee->save();

    	$role_manager = new Role();
    	$role_manager->name = 'administrateur';
    	$role_manager->description = 'Compte administrateur';
    	$role_manager->save();
    }
}
