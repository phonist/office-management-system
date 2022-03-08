<?php

namespace App\Services;

use App\ContactDetail;
use App\Repositories\Interfaces\IContactDetailRepository;
use App\Repositories\Interfaces\IEmployeeRepository;
use App\Repositories\Interfaces\IEmergencyContactRepository;
use Illuminate\Http\Request;

class ContactDetailService{
    protected $contactDetails;
    protected $employees;
    protected $emergencyContacts;

    public function __construct(
        IContactDetailRepository $contactDetails,
        IEmployeeRepository $employees,
        IEmergencyContactRepository $emergencyContacts
    ){
        $this->contactDetails = $contactDetails;
        $this->employees = $employees;
        $this->emergencyContacts = $emergencyContacts;
    }

    public function updateOrCreate(Request $request){
        return $this->contactDetails->updateOrCreate($request);
    }    

    public function show(ContactDetail $contactDetail){
        $employee = $this->employees->getById($contactDetail->employee_id);
        $emergencyContacts = $this->emergencyContacts->getByEmployeeId($contactDetail->employee_id);
        return [
            'employee' => $employee,
            'emergencyContacts' => $emergencyContacts
        ];
    }
}