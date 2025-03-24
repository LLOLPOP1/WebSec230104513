<?php

namespace App\Traits;

use App\Services\RoleService;

trait HasRoles
{
    public function hasRole($role): bool
    {
        return $this->role === $role;
    }

    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }

    public function isAdmin(): bool
    {
        return $this->role === RoleService::ADMIN;
    }

    public function isEmployee(): bool
    {
        return $this->role === RoleService::EMPLOYEE;
    }

    public function isCustomer(): bool
    {
        return $this->role === RoleService::CUSTOMER;
    }

    public function getDashboardRoute(): string
    {
        return RoleService::getDashboardRoute($this->role);
    }
} 