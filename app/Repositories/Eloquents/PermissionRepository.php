<?php

namespace App\Repositories\Eloquents;

use App\Permission;
use App\Repositories\Interfaces\IPermissionRepository;
use Auth;
use Illuminate\Http\Request;

class PermissionRepository implements IPermissionRepository{
    protected $permissions;

    public function __construct(Permission $permissions){
        $this->permissions = $permissions;
    }

    public function all(){
        return $this->permissions->where('user_id',Auth::user()->id)
                                 ->orderBy('created_at','asc')
                                 ->get();
    }

    public function store(Request $request){
        $permission = $this->permissions;
        $permission->name         =  $request->name;
        $permission->display_name = $request->display_name; // optional
        $permission->description  = $request->description; // optional
        $permission->user_id = Auth::user()->id;
        return [
            'result' => $permission->save(),
            'permission' => $permission
        ];
    }

    public function update(Request $request, $id){
        $permission = $this->permissions->find($id);
        $permission->name         =  $request->name;
        $permission->display_name = $request->display_name; // optional
        $permission->description  = $request->description; // optional
        $permission->user_id = Auth::user()->id;
        return [
            'result' => $permission->save(),
            'permission' => $permission
        ];
    }

    public function destroy($id){
        $permission = $this->permissions->find($id);
        return [
            'result' => $permission->delete()
        ];
    }
}