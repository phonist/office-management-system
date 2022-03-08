<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LeaveType;
use Carbon\Carbon;
use App\Http\Traits\UseUuid;
class Application extends Model
{
    use UseUuid;
    protected $fillable=[
        'employee_id',
        'start',
        'end',
        'type_id',
        'date',
        'reason',
        'status'
    ];

    public function leaveType($id){
        $application = Application::where('id',$id)->exists();
        if($application){
            $leaveTypeId = Application::where('id',$id)->first()->type_id;
            return LeaveType::where('id',$leaveTypeId)->first()->name;
        }else{
            return "No Application Found";
        }
    }

    public function timeFormat($dateTime){
        return Carbon::parse($dateTime)->format('d M Y');
    }
}
