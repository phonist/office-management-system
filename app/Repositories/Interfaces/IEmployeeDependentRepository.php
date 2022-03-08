<?php

namespace App\Repositories\Interfaces;

use App\EmployeeDependent;
use Illuminate\Http\Request;

interface IEmployeeDependentRepository{
    public function checkDependentExists($id);
    public function getDependentById($id);
    public function store(Request $request);
    public function update(Request $request, EmployeeDependent $employeeDependent);
    public function destroy($id);
}