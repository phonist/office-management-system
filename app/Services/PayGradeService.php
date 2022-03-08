<?php

namespace App\Services;

use App\Repositories\Interfaces\IPayGradeRepository;

class PayGradeService{
    protected $payGrades;

    public function __construct(IPayGradeRepository $payGrades){
        $this->payGrades = $payGrades;
    }

    public function all(){
        return $this->payGrades->all();
    }

    public function store(Request $request){
        return $this->payGrades->store($request);
    }

    public function update(Request $request, $id){
        return $this->payGrades->update($request, $id);
    }

    public function destroy($id){
        return $this->payGrades->destroy($id);
    }
}