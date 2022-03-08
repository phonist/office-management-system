<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\EmployeeTermination;

interface IEmployeeTerminationRepository{
    public function updateOrCreate(Request $request);
}