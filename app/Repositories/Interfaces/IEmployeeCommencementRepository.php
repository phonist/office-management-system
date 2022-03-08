<?php

namespace App\Repositories\Interfaces;

use App\EmployeeCommencement;
use Illuminate\Http\Request;

interface IEmployeeCommencementRepository{
    public function checkCommencementExists($id);
    public function getCommencementById($id);
    public function storeCommencementById($id);
    public function updateOrCreate(Request $request);
}