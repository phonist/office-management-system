<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Http\Traits\UseUuid;

class EmployeeAward extends Model
{
    use UseUuid;
    
    protected $fillable=[
        'employee_id',
        'award',
        'gift',
        'amount',
        'month',
        'department_id'
    ];

    public function userId($id){
        $userId = EmployeeAward::where('id',$id)->first()->employee_id;
        return User::where('id',$userId)->id_number;
    }

    public function userFName($id){
        $userId = EmployeeAward::where('id',$id)->first()->employee_id;
        return User::where('id',$userId)->f_name;
    }

    public function userLName($id){
        $userId = EmployeeAward::where('id',$id)->first()->employee_id;
        return User::where('id',$userId)->l_name;
    }

    public function timeFormat($dateTime){
        return Carbon::parse($dateTime)->format('d M Y');
    }
}

