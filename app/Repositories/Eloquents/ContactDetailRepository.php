<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IContactDetailRepository;
use App\ContactDetail;
use Illuminate\Http\Request;

class ContactDetailRepository implements IContactDetailRepository{
    protected $contactDetails;

    public function __construct(
        ContactDetail $contactDetails
    ){
        $this->contactDetails = $contactDetails;
    }

    public function checkContactDetailExists($id){
        return $this->contactDetails->where('employee_id',$id)->first() == null ? false:true;
    }

    public function getContactDetailById($id){
        return [
            'contactDetail'=>$this->contactDetails->where('employee_id',$id)->first()
        ];
    }

    public function storeContactDetailById($id){
        $contactDetail = $this->contactDetails;
        $contactDetail->employee_id = $id;
        return [
            'result' => $contactDetail->save(),
            'contactDetail' => $contactDetail
        ];
    }
    
    public function updateOrCreate(Request $request){
        $result = $this->contactDetails->updateOrCreate(
            [
                'employee_id'=>$request->employee_id
            ],
            [
                'street1'=>$request->address_1,
                'street2'=>$request->address_2,
                'city'=>$request->city,
                'state'=>$request->state,
                'zip'=>$request->postal,
                'country'=>$request->country,
                'home_tel'=>$request->home_telephone,
                'work_email'=>$request->work_email,
                'work_tel'=>$request->work_telephone,
                'other_email'=>$request->other_email,
                'mobile'=>$request->mobile
            ]
        );
        return $result;
    }
}