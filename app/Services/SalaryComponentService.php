<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ISalaryComponentRepository;

class SalaryComponentService {
    protected $salaryComponents;

    public function __construct(ISalaryComponentRepository $salaryComponents){
        $this->salaryComponents = $salaryComponents;
    }

    public function all(){
        return $this->salaryComponents->all();
    }

    public function store(Request $request){
        return $this->salaryComponents->store($request);
    }

    public function update(Request $request, $id){
        return $this->salaryComponents->update($request, $id);
    }

    public function destroy($id){  
        return $this->salaryComponents->destroy($id);
    }
}