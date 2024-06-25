<?php

namespace App\Services;

use App\Models\Role;
use App\Models\Employee;
use App\Http\Resources\RoleResource;
use App\Http\Resources\EmployeeCollection;

class RoleService
{

    public function warehouseRolesList(): array
    {
        $role = RoleResource::collection(Role::ofTypeName('Warehouse')->get());
        $message = __('messages.index_success', ['class' => __('roles')]);
        $code = 200;
        return ['data' => $role, 'message' => $message, 'code' => $code];
    }

    public function distributionCenterRolesList(): array
    {
        $role = RoleResource::collection(Role::ofTypeName('DistributionCenter')->get());
        $message = __('messages.index_success', ['class' => __('roles')]);
        $code = 200;
        return ['data' => $role, 'message' => $message, 'code' => $code];
    }
}
