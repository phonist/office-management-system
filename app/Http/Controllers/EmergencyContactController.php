<?php

namespace App\Http\Controllers;

use App\EmergencyContact;
use Illuminate\Http\Request;
use App\Services\EmergencyContactService;

class EmergencyContactController extends Controller
{
    protected $emergencyContacts;

    public function __construct(
        EmergencyContactService $emergencyContacts
    ){
        $this->emergencyContacts = $emergencyContacts;
    }

    public function store(Request $request)
    {
        $result = $this->emergencyContacts->store($request);
        return redirect()->route('employees.contactDetails',$request->employee_id);
    }

    public function edit(EmergencyContact $emergencyContact)
    {
        return response()->json($emergencyContact);
    }

    public function update(Request $request, EmergencyContact $emergencyContact)
    {
        $result = $this->emergencyContacts->update($request, $emergencyContact);
        return redirect()->route('employees.contactDetails',$emergencyContact->employee_id);
    }

    public function delete(Request $request){
        $result = $this->emergencyContacts->destroy($request);
        return redirect()->route('employees.contactDetails',$request->employee_id);
    }
}
