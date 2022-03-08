<?php

namespace App\Repositories\Interfaces;

use App\EmployeeSalary;
use Illuminate\Http\Request;

interface IEmployeeSalaryRepository{
    public function checkSalaryExists($id);
    public function getSalaryById($id);
    public function storeSalaryById($id);
    public function update(Request $request, EmployeeSalary $employeeSalary);
}