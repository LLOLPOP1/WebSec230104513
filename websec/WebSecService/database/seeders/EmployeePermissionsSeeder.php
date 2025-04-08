<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EmployeePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds to give Employees product management permissions.
     */
    public function run(): void
    {
        // Get the Employee role
        $employeeRole = Role::findByName('Employee');
        
        // Get product-related permissions
        $addProducts = Permission::findByName('add_products');
        $editProducts = Permission::findByName('edit_products');
        $deleteProducts = Permission::findByName('delete_products');
        
        // Give permissions to the Employee role if they don't already have them
        if (!$employeeRole->hasPermissionTo('add_products')) {
            $employeeRole->givePermissionTo($addProducts);
        }
        
        if (!$employeeRole->hasPermissionTo('edit_products')) {
            $employeeRole->givePermissionTo($editProducts);
        }
        
        if (!$employeeRole->hasPermissionTo('delete_products')) {
            $employeeRole->givePermissionTo($deleteProducts);
        }
        
        $this->command->info('Product management permissions added to Employee role');
    }
} 