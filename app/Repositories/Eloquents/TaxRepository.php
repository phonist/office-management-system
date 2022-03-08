<?php

namespace App\Repositories\Eloquents;

use App\Tax;
use Auth;
use App\Repositories\Interfaces\ITaxRepository;
use Illuminate\Http\Request;

class TaxRepository implements ITaxRepository{
    protected $taxes;

    public function __construct(Tax $taxes){
        $this->taxes = $taxes;
    }

    public function all(){
        return $this->taxes->where('user_id',Auth::user()->id)
                        ->orderBy('created_at', 'asc')
                        ->get();
    }

    public function store(Request $request){
        $tax = $this->taxes;
        $tax->name = $request->name;
        $tax->rate = $request->rate;
        $tax->type = $request->type;
        $tax->user_id = Auth::user()->id;
        return [
            'result' => $tax->save(),
            'tax' => $tax
        ];
    }
    public function update(Request $request, $id){
        $tax = $this->taxes->find($id);
        $tax->name = $request->name;
        $tax->rate = $request->rate;
        $tax->type = $request->type;
        $tax->user_id = Auth::user()->id;
        return [
            'result' => $tax->save(),
            'tax' => $tax
        ];
    }
    public function destroy($id){
        $tax = $this->taxes->find($id);
        return [
            'result' => $tax->delete()
        ];
    }
}