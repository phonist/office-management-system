<?php

namespace App\Http\Controllers;

use App\EmployeeCommencement;
use Illuminate\Http\Request;
use App\Services\EmployeeCommencementService;

class EmployeeCommencementController extends Controller
{
    protected $employeeCommencements;

    public function __construct(
        EmployeeCommencementService $employeeCommencements
    ){
        $this->employeeCommencements = $employeeCommencements;
    }

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $result = $this->employeeCommencements->updateOrCreate($request);
        return redirect()->route('employees.employeeCommencements',$request->employee_id);
    }

    public function show(EmployeeCommencement $employeeCommencement)
    {
        //
    }

    public function edit(EmployeeCommencement $employeeCommencement)
    {
        //
    }

    public function update(Request $request, EmployeeCommencement $employeeCommencement)
    {
        //
    }

    public function destroy(EmployeeCommencement $employeeCommencement)
    {
        //
    }
}
