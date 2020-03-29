<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$adminRole = Role::where('name', 'admin')->firstOrFail(); 
    	$managerRole = Role::where('name', 'manager')->firstOrFail();                       
    	// Admin
        $adminUser  = User::firstOrCreate([
            'email' => "admin@dxc.com",
            ],
            [
        	'name' => "Administrator",
            'email' => "admin@dxc.com",
            'designation' =>'Admin',
            'password' => Hash::make('password'),
        ]);
        $adminUser->assignRole($adminRole);
        
        // Manager
        $managerUser  = User::firstOrCreate([
            'email' => "manager@dxc.com"
            ],
            [
        	'name' => "Manager",
            'email' => "manager@dxc.com",
            'designation' =>'Manager',
            'password' => Hash::make('password'),
        ]);
        $managerRole = Role::where('name', 'manager')->firstOrFail();            
        $managerUser->assignRole($managerRole);
    }
}
