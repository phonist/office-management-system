<?php

namespace App\Repositories\Eloquents;

use App\SalaryComponent;
use App\Repositories\Interfaces\ISalaryComponentRepository;
use Illuminate\Http\Request;
use Auth;

class SalaryComponentRepository implements ISalaryComponentRepository{
    protected $salaryComponents;

    public function __construct(SalaryComponent $salaryComponents){
        $this->salaryComponents = $salaryComponents;
    }

    public function all(){
        return $this->salaryComponents->where('user_id',Auth::user()->id)
                                      ->orderBy('created_at','asc')
                                      ->get();
    }

    public function store(Request $request){
        $salarycomponent = $this->salaryComponents;
        $salarycomponent->component_name = $request->component_name;
        $salarycomponent->type = (int)$request->type;
        $salarycomponent->total_payable = $request->total_payable;
        $salarycomponent->cost_company = $request->cost_company;
        $salarycomponent->value_type = (int)$request->value_type;
        $salarycomponent->user_id = Auth::user()->id;
        return [
            'result' => $salarycomponent->save(),
            'salaryComponent' => $salarycomponent
        ];
    }

    public function update(Request $reqeust, $id){
        $salarycomponent = $this->salaryComponents->find($id);
        $salarycomponent->component_name = $request->component_name;
        $salarycomponent->type = (int)$request->type;
        $salarycomponent->total_payable = $request->total_payable;
        $salarycomponent->cost_company = $request->cost_company;
        $salarycomponent->value_type = (int)$request->value_type;
        $salarycomponent->user_id = Auth::user()->id;
        return [
            'result' => $salarycomponent->save(),
            'salaryComponent' => $salarycomponent
        ];
    }

    public function destroy($id){
        $salarycomponent = $this->salaryComponents->find($id);
        return [
            'result' => $salarycomponent->delete()
        ];
    }
}