<?php

namespace App\Services;

class RoleService
{
    public const ADMIN = 'admin';
    public const EMPLOYEE = 'employee';
    public const CUSTOMER = 'customer';

    public static function getAllRoles(): array
    {
        return [self::ADMIN, self::EMPLOYEE, self::CUSTOMER];
    }

    public static function getDashboardRoute(string $role): string
    {
        return match ($role) {
            self::ADMIN => 'admin.dashboard',
            self::EMPLOYEE => 'employee.dashboard',
            self::CUSTOMER => 'customer.dashboard',
            default => 'home'
        };
    }
} 