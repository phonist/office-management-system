<?php

namespace App\Repositories\Interfaces;

use App\EmployeeDeposit;
use Illuminate\Http\Request;

interface IEmployeeDepositRepository{
    public function checkDepositExists($id);
    public function getDepositById($id);
    public function storeDepositById($id);
    public function updateOrCreate(Request $request);
    public function update(Request $request, EmployeeDeposit $employeeDeposit);
}