<?php

namespace App\Repositories\Interfaces;

use App\EmployeeLogin;
use Illuminate\Http\Request;

interface IEmployeeLoginRepository{
    public function checkLoginExists($id);
    public function getLoginById($id);
    public function storeLogin($id, $f_name);
    public function update(Request $request, EmployeeLogin $employeeLogin);
}