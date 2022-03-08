<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use App\Services\DepartmentService;

class DepartmentController extends Controller
{
    protected $departments;

    public function __construct(DepartmentService $departments){
        $this->departments = $departments;
    }

    public function index()
    {
        $departments = $this->departments->all();
        return view('admin.departments.index',['departments'=>$departments]);
    }

    public function store(Request $request)
    {
        $department = $this->departments->store($request);
        return redirect()->action('DepartmentController@index');
    }

    public function edit(Department $department)
    {
        return response()->json($department);
    }

    public function update(Request $request, Department $department)
    {
        $department = $this->departments->update($request, $department->id);
        return redirect()->action('DepartmentController@index');
    }

    public function destroy(Department $department){
        $department = $this->departments->destroy($department->id);
        return redirect()->action('DepartmentController@index');
    }
}
