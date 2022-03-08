<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IPayGradeRepository;
use App\PayGrade;
use Illuminate\Http\Request;
use Auth;

class PayGradeRepository implements IPayGradeRepository{
    protected $payGrades;

    public function __construct(PayGrade $payGrades){
        $this->payGrades = $payGrades;
    }

    public function all(){
        return $this->payGrades->where('user_id',Auth::user()->id)
                                ->orderBy('created_at','asc')
                                ->get();
    }
    public function store(Request $request){
        $payGrade = $this->payGrades;
        $payGrade->name = $request->grade_name;
        $payGrade->minimum = (double)$request->min_salary;
        $payGrade->maximum = (double)$request->max_salary;
        $payGrade->user_id = Auth::user()->id;
        return [
            'result' => $payGrade->save(),
            'payGrades' => $payGrade
        ];
    }
    public function update(Request $request, $id){
        $payGrade = $this->payGrades->find($id);
        $payGrade->name = $request->grade_name;
        $payGrade->minimum = (double)$request->min_salary;
        $payGrade->maximum = (double)$request->max_salary;
        $payGrade->user_id = Auth::user()->id;
        return [
            'result' => $payGrade->save(),
            'payGrades' => $payGrade
        ];
    }
    public function destroy($id){
        $payGrade = $this->payGrades->find($id);
        return [
            'result' => $payGrade->delete()
        ];
    }
}