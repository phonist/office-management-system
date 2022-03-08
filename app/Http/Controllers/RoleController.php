<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use App\PermissionRole;
use Illuminate\Http\Request;
use App\Services\RoleService;

class RoleController extends Controller
{
    protected $roles;

    public function __construct(RoleService $roles){
        $this->roles = $roles;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $result = $this->roles->all();
        return view('admin.roles.index',[
            'roles'=>$result['roles'],
            'permissions'=>$result['permissions']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->roles->store($request);
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = $this->roles->getPermissionById($role->id);
        return response()->json(['role'=>$role,'permission'=>$permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $update = $this->roles->update($request, $role->id);
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role = $this->roles->destroy($role->id);
        return redirect()->action('RoleController@index');
    }
}
