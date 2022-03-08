<?php

namespace App\Services;

use App\Repositories\Interfaces\IHolidayRepository;
use Illuminate\Http\Request;

class HolidayService {
    protected $holidays;

    public function __construct(
        IHolidayRepository $holidays
    ){
        $this->holidays = $holidays;
    }

    public function all(){
        return $this->holidays->all();
    }

    public function store(Request $request){
        return $this->holidays->store($request);
    }

    public function update(Request $request, $id){
        return $this->holidays->update($request, $id);
    }

    public function destroy($id){
        return $this->holidays->destroy($id);
    }
}