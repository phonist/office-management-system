<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface IRoleEmployeeRepository{
    public function store(Request $request, $employee);
    public function destroy($id);
}