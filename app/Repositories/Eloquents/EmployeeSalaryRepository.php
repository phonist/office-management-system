<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeSalaryRepository;
use App\EmployeeSalary;
use Illuminate\Http\Request;

class EmployeeSalaryRepository implements IEmployeeSalaryRepository{
    protected $employeeSalaries;

    public function __construct(EmployeeSalary $employeeSalaries){
        $this->employeeSalaries = $employeeSalaries;
    }

    public function checkSalaryExists($id){
        return $this->employeeSalaries->where('employee_id',$id)->first() == null ? false: true;
    }

    public function getSalaryById($id){
        return [
            'salary' => $this->employeeSalaries->where('employee_id',$id)->first()
        ];
    }

    public function storeSalaryById($id){
        $salary = $this->employeeSalaries;
        $salary->employee_id = $id;
        return [
            'result' => $salary->save(),
            'salary' => $salary
        ];
    }

    public function update(Request $request, EmployeeSalary $employeeSalary){
        $employeeSalary = $this->employeeSalaries->find($employeeSalary->id);
        $employeeSalary->type = $request->type;
        $employeeSalary->pay_grade = $request->grade_id;
        $employeeSalary->comment = $request->comment;
        $employeeSalary->basic_payment = $request->basic_payment;
        $employeeSalary->car_allowance = $request->car_allowance;
        $employeeSalary->medical_allowance = $request->medical_allowance;
        $employeeSalary->living_allowance = $request->living_allowance;
        $employeeSalary->house_rent = $request->house_rent;
        $employeeSalary->gratuity = $request->gratuity;
        $employeeSalary->pension = $request->pension;
        $employeeSalary->insurance = $request->insurance;
        $employeeSalary->total_deduction = $request->total_deduction;
        $employeeSalary->total_payable = $request->total_payable;
        $employeeSalary->cost_to_company = $request->total_cost_company;
        $employeeSalary->hourly_salary = $request->hourly_salary;
        return [
            'result' => $employeeSalary->save(),
            'employeeSalary' => $employeeSalary
        ];
    }
}