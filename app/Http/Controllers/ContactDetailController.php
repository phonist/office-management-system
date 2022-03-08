<?php

namespace App\Http\Controllers;

use App\ContactDetail;
use App\EmergencyContact;
use App\Employee;
use App\User;
use Illuminate\Http\Request;
use App\Services\ContactDetailService;

class ContactDetailController extends Controller
{
    protected $contactDetails;

    public function __construct(ContactDetailService $contactDetails){
        $this->contactDetails = $contactDetails;
    }

    public function store(Request $request)
    {
        $result = $this->contactDetails->updateOrCreate($request);
        return redirect()->route('employees.contactDetails',$request->employee_id);
    }

    public function show(ContactDetail $contactDetail)
    {
        $result = $this->contactDetails->show($contactDetail);
        return view('admin.contactDetails.show',[
            'contactDetail'=>$contactDetail,
            'employee'=>$result['employee'],
            'emergencyContacts'=>$result['emergencyContacts']
        ]);
    }
}
