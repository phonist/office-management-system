<?php

namespace App\Services;

use App\Repositories\Interfaces\IRoleRepository;
use App\Repositories\Interfaces\IPermissionRepository;
use App\Repositories\Interfaces\IPermissionRoleRepository;
use Illuminate\Http\Request;

class RoleService{
    protected $roles;
    protected $permissions;
    protected $permissionRoles;

    public function __construct(
        IRoleRepository $roles,
        IPermissionRepository $permissions,
        IPermissionRoleRepository $permissionRoles
    ){
        $this->roles = $roles;
        $this->permissions = $permissions;
        $this->permissionRoles = $permissionRoles;
    }

    public function all(){
        $roles = $this->roles->all();
        $permissions = $this->permissions->all();
        return [
            'roles' => $roles,
            'permissions' => $permissions
        ];
    }

    public function store(Request $request){
        $role = $this->roles->store($request);
        if($request->permission !== null){
            foreach($request->permission as $permission){
                $permission_role = $this->permissionRoles->store($request, $role->id);
            }
        }
        return [
            'result' => true
        ];
    }

    public function update(Request $request, $id){
        $role = $this->roles->update($request, $id);
        $delete = $this->permissionRoles->destroy($id);
        if($request->permission !== null)
            foreach($request->permission as $permission){
                $permission_role = $this->permissionRoles->store($request, $id);
            }
        return [
            'result' => true
        ];
    }

    public function getPermissionById($id){
        return $this->roles->getPermissionById($id);
    }
}