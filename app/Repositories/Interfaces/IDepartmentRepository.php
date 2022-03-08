<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface IDepartmentRepository{
    public function all();
    public function getDepartmentById($id);
    public function store(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);
}