<?php

namespace App\Repositories\Roles;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesRepository implements RolesInterface
{

    public function index()
    {
        return Role::orderBy('id', 'DESC')->get();
    }

    public function create()
    {
        return Permission::get();
    }

    public function store($data)
    {
        try {
            $permissionsID = array_map(
                function ($value) {
                    return (int)$value;
                },
                $data['permission']
            );

            $role = Role::create(['name' => $data['name']]);
            $role->syncPermissions($permissionsID);
            return true;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }

    public function show($id): array
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();
        return ['role' => $role, 'rolePermissions' => $rolePermissions];
    }

    public function edit($id): array
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return ['role' => $role, 'permission' => $permission, 'rolePermissions' => $rolePermissions];
    }

    public function update($data, $id): bool
    {
        try {
            $permissionsID = array_map(
                function ($value) {
                    return (int)$value;
                },
                $data['permission']
            );

            $role = Role::find($id);
            $role->name = $data['name'];
            $role->save();
            $role->syncPermissions($permissionsID);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function destroy($id): bool
    {
        $role = Role::find($id);
        if ($role->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
