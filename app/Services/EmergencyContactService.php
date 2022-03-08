<?php

namespace App\Services;

use App\Repositories\Interfaces\IEmergencyContactRepository;
use Illuminate\Http\Request;
use App\EmergencyContact;

class EmergencyContactService{
    protected $emergencyContacts;

    public function __construct(
        IEmergencyContactRepository $emergencyContacts
    ){
        $this->emergencyContacts = $emergencyContacts;
    }

    public function store(Request $request){
        return $this->emergencyContacts->store($request);
    }

    public function update(Request $request, EmergencyContact $emergencyContact){
        return $this->emergencyContacts->update($request, $emergencyContact);
    }

    public function destroy(Request $request){
        $emergencyContactId_array = $request->emergencyContact;
        if($emergencyContactId_array!=null){
            foreach($emergencyContactId_array as $id){
                $this->emergencyContacts->destroy((int)$id);
            }
        
        }
        return true;
    }
}