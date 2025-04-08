<?php
// This file should be run from the project root with: php employee_product_permissions.php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

try {
    // Get Employee role
    $employeeRole = Role::where('name', 'Employee')->first();
    
    if (!$employeeRole) {
        echo "❌ Employee role not found. Please run php artisan db:seed --class=RoleSeeder first.\n";
        exit(1);
    }
    
    // Get permissions
    $addProducts = Permission::where('name', 'add_products')->first();
    $editProducts = Permission::where('name', 'edit_products')->first();
    $deleteProducts = Permission::where('name', 'delete_products')->first();
    
    // Assign permissions
    $permissionsAssigned = [];
    
    if (!$employeeRole->hasPermissionTo('add_products')) {
        $employeeRole->givePermissionTo($addProducts);
        $permissionsAssigned[] = 'add_products';
    }
    
    if (!$employeeRole->hasPermissionTo('edit_products')) {
        $employeeRole->givePermissionTo($editProducts);
        $permissionsAssigned[] = 'edit_products';
    }
    
    if (!$employeeRole->hasPermissionTo('delete_products')) {
        $employeeRole->givePermissionTo($deleteProducts);
        $permissionsAssigned[] = 'delete_products';
    }
    
    if (empty($permissionsAssigned)) {
        echo "✅ Employee role already has all product management permissions.\n";
    } else {
        echo "✅ Assigned " . implode(', ', $permissionsAssigned) . " permissions to Employee role.\n";
    }
    
    // Clear cache
    Artisan::call('cache:clear');
    echo "✅ Cache cleared successfully.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
} 