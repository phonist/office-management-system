<?php

namespace App\Repositories\Interfaces;

use App\EmployeeSupervisor;
use Illuminate\Http\Request;

interface IEmployeeSupervisorRepository{
    public function checkSupervisorsExistsById($id);
    public function getSupervisoryById($id);
    public function store(Request $request);
    public function update(Request $request, EmployeeSupervisor $employeeSupervisor);
    public function destroy($id);
}