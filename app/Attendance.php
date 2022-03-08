<?php

namespace App;
use App\Department;
use App\Employee;
use App\Leavetype;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;
class Attendance extends Model
{
    //
    use UseUuid;
    
    protected $fillable = [
        'date',
        'department_id',
        'employee_id',
        'leave_id',
        'in',
        'out'
    ];

    public function department($id){
        return Department::select('name')->where('id',$id)->first() == '' ? '':Department::select('name')->where('id',$id)->first()->name;
    }

    public function employee($id){
        return Employee::select('name')->where('id_number',$id)->first() == ''?'':Employee::select('name')->where('id_number',$id)->first()->name;
    }

    public function leave($id){
        return Leavetype::where('id',$id)->first()->name;
    }
}
