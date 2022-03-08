<?php

namespace App\Repositories\Eloquents;

use App\EmergencyContact;
use App\Repositories\Interfaces\IEmergencyContactRepository;
use Illuminate\Http\Request;

class EmergencyContactRepository implements IEmergencyContactRepository{
    protected $emergencyContacts;

    public function __construct(EmergencyContact $emergencyContacts){
        $this->emergencyContacts = $emergencyContacts;
    }
    
    public function getByEmployeeId($id){
        return $this->emergencyContacts->where('employee_id',$id)->get();
    }

    public function store(Request $request){
        $emergencyContact = $this->emergencyContacts;
        $emergencyContact->name = $request->name;
        $emergencyContact->relationship = $request->relationship;
        $emergencyContact->home_tel = $request->home_telephone;
        $emergencyContact->mobile = $request->mobile;
        $emergencyContact->work_tel = $request->work_telephone;
        $emergencyContact->employee_id = $request->employee_id;
        return [
            'result' => $emergencyContact->save(),
            'emergencyContact' => $emergencyContact
        ];
    }

    public function update(Request $request, EmergencyContact $emergencyContact){
        $emergencyContact = $this->emergencyContacts->find($emergencyContact->id);
        $emergencyContact->name = $request->name;
        $emergencyContact->relationship = $request->relationship;
        $emergencyContact->home_tel = $request->home_telephone;
        $emergencyContact->mobile = $request->mobile;
        $emergencyContact->work_tel = $request->work_telephone;
        return [
            'result' => $emergencyContact->save(),
            'emergencyContact' => $emergencyContact
        ];
    }

    public function destroy($id){
        $emergencyContact = $this->emergencyContacts->find($id);
        return $emergencyContact->delete();
    }
}