<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IRoleRepository;
use App\Role;
use Auth;
use Illuminate\Http\Request;

class RoleRepository implements IRoleRepository{
    protected $roles;

    public function __construct(Role $roles){
        $this->roles = $roles;
    }

    public function all(){
        return $this->roles->where('user_id',Auth::user()->id)->get();
    }

    public function store(Request $request){
        $role = $this->roles;
        $role->name         = $request->name;
        $role->display_name = $request->display_name; // optional
        $role->description  = $request->description; // optional
        $role->user_id = Auth::user()->id;
        $role->save();
        return [
            'result' => $role->save(),
            'role' => $role
        ];
    }

    public function update(Request $request, $id){
        $role = $this->roles->find($id);
        $role->name         = $request->name;
        $role->display_name = $request->display_name; // optional
        $role->description  = $request->description; // optional
        $role->user_id = Auth::user()->id;
        return [
            'result' => $role->save(),
            'role' => $role
        ];
    }

    public function destroy($id){
        $role = $this->roles->find($id);
        return [
            'result' => $role->delete()
        ];
    }

    public function getPermissionById($id){
        return $this->roles->permissions()->select('id')->get();
    }


}