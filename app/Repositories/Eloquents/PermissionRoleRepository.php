<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IPermissionRoleRepository;
use App\PermissionRole;
use Illuminate\Http\Request;

class PermissionRoleRepository implements IPermissionRoleRepository{
    protected $permissionRoles;

    public function __construct(PermissionRole $permissionRoles){
        $this->permissionRoles = $permissionRoles;
    }

    public function store(Request $request, $role_id){
        $permission_role = $this->permissionRoles;
        $permission_role->role_id = $role_id;
        $permission_role->permission_id = $request->permission;
        return [
            'result' => $permission_role->save(),
            'permission_role' => $permission_role
        ];
    }

    public function destroy($id){
        $permission_role = $this->permissionRole->where('role_id',$id);
        return [
            'result' => $permission_role->delete()
        ];
    }
}