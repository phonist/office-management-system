<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface IEmployeeRepository {
    public function all();
    public function store(Request $request, $file_name);
    public function getTerminate();
    public function update(Request $request, $id, $file_name);
    public function updatePassword($password, $id);
    public function destroy($id);
    public function getById($id);
    public function updateTerminationStatus($id,$status);
}