<?php

namespace App\Repositories\Interfaces;

use App\EmployeeSubordinate;
use Illuminate\Http\Request;

interface IEmployeeSubordinateRepository{
    public function checkSubordinatesExists($id);
    public function getSubordinateById($id);
    public function store(Request $request);
    public function update(Request $request, EmployeeSubordinate $employeeSubordinate);
    public function destroy($id);
}