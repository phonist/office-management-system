<?php

namespace App\Services;

use App\EmployeeSalary;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IEmployeeSalaryRepository;

class EmployeeSalaryService {
    protected $employeeSalaries;

    public function __construct(
        IEmployeeSalaryRepository $employeeSalaries
    ){
        $this->employeeSalaries = $employeeSalaries;
    }

    public function update(Request $request, EmployeeSalary $employeeSalary){
        return $this->employeeSalaries->update($request, $employeeSalary);
    }
}