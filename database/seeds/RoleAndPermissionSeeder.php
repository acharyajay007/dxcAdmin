<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole  = Role::firstOrCreate(['name' => 'admin']); 
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $employeeRole  = Role::firstOrCreate(['name' => 'employee']);  
		$addEmployeePermission = Permission::firstOrCreate(['name' => 'employee-add']);
		$editEmployeePermission = Permission::firstOrCreate(['name' => 'employee-edit']);
		$deleteEmployeePermission = Permission::firstOrCreate(['name' => 'employee-delete']);
        $viewEmployeePermission = Permission::firstOrCreate(['name' => 'employee-view']);
        $listEmployeePermission = Permission::firstOrCreate(['name' => 'employee-list']);
		$profilePermission = Permission::firstOrCreate(['name' => 'profile']);
        $adminRole->givePermissionTo([$addEmployeePermission, $editEmployeePermission, $deleteEmployeePermission, $viewEmployeePermission, $listEmployeePermission, $profilePermission]);
        $managerRole->givePermissionTo([$viewEmployeePermission, $listEmployeePermission, $profilePermission]);
        $employeeRole->givePermissionTo([$profilePermission]);
    }
}
