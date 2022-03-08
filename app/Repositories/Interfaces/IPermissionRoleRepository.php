<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface IPermissionRoleRepository{
    public function store(Request $request, $role_id);
    public function destroy($id);
}