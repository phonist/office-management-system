<?php

namespace App\Services;

use App\Repositories\Interfaces\ITaxRepository;
use Illuminate\Http\Request;

class TaxService{
    protected $taxes;

    public function __construct(
        ITaxRepository $taxes
    ){
        $this->taxes = $taxes;
    }

    public function all(){
        return $this->taxes->all();
    }

    public function store(Request $request){
        return $this->taxes->store($request);
    }

    public function update(Request $request, $id){
        return $this->taxes->update($request, $id);
    }

    public function destroy($id){
        return $this->taxes->destroy($id);
    }
}