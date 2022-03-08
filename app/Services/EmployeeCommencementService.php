<?php

namespace App\Services;

use App\EmployeeCommencement;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IEmployeeCommencementRepository;

class EmployeeCommencementService {
    protected $employeeCommencements;

    public function __construct(
        IEmployeeCommencementRepository $employeeCommencements
    ){
        $this->employeeCommencements = $employeeCommencements;
    }

    public function updateOrCreate($request){
        return $this->employeeCommencements->updateOrCreate($request);
    }
}