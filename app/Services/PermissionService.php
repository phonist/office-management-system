<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IPermissionRepository;

class PermissionService{
    protected $permissions;

    public function __construct(IPermissionRepository $permissions){
        $this->permissions = $permissions;
    }

    public function all(){
        return $this->permissions->all();
    }

    public function store(Request $request){
        return $this->permissions->store($request);
    }

    public function update(Request $request, $id){
        return $this->permissions->update($request, $id);
    }

    public function destroy($id){
        return $this->permissions->destroy($id);
    }
}