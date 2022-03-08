<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Employee;
use App\UserAttachment;
use App\ContactDetail;
use App\EmployeeDependent;
use App\EmployeeCommencement;
use App\JobHistory;
use App\EmployeeSalary;
use App\EmployeeSupervisor;
use App\EmployeeSubordinate;
use App\EmployeeDeposit;
use App\EmployeeLogin;
use App\Department;
use App\EmployeeStatus;
use App\JobCategory;
use App\JobTitle;
use App\WorkShift;
use App\Attendance;
use App\Role;
use App\RoleUser;
use Carbon\Carbon;
use App\Imports\EmployeeImport;
use App\Exports\EmployeeExport;
use Session;
use Response;
use Excel;
use File;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
    }

    public function storeSkin(Request $request){
        $userId = Auth::user()->id;
        
        $updateSkin = User::where('id',1)->update([
            'skin'=>$request->bodySkin
        ]);

        if($updateSkin){
            return response()->json($userId);
        }else{
            return response()->json($userId);
        }
        
    }

    public function getSkin(){
        $userId = Auth::user()->id;
        $skin = User::select('skin')->where('id',$userId)->first()->skin;
        return response()->json($skin);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function add(Request $request){
        
    }

    /*
    *Import a list of employees from csv files
    */
    public function import(){
    }

    public function downloadEmployeeSample(){
    }

    public function importEmployee(Request $request){
       
    }

    public function export(){
        return (new EmployeeExport)->download('employee.csv');
    }

    public function terminate(Request $request){
        // return response()->json($request);
    }

    public function terminateList(){
    }

    public function show(User $user)
    {   
    }

    public function employeeDependents(User $user){
        
    }

    public function employeeCommencements(User $user){
        
    }

    public function employeeSalaries(User $user){
        
    }

    public function reportTo(User $user){
        
    }

    public function directDeposit(User $user){
        
    }

    public function employeeLogin(User $user){

        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('employee_photo')) {
            $image = $request->file('employee_photo');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/employeesPhoto');
            $image->move($destinationPath, $name);
        }else{
            $name = NULL;
        }
        $store = DB::table('users')->insertGetId([
            'name'  =>$request->first_name." ".$request->last_name,
            'email' =>$request->email,
            'f_name'=>$request->first_name,
            'l_name'=>$request->last_name,
            'dob'=>$request->date_of_birth,
            'marital_status'=>$request->marital_status,
            'country'=>$request->country,
            'blood_group'=>$request->blood_group,
            'id_number'=>$request->id_number,
            'religious'=>$request->religious,
            'gender'=>$request->gender,
            'photo'=>$name,
            'terminate_status'=>0,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
        $user = User::where('id',$store)->first();
        //default is user

        // return response()->json($request->role);
        // $user->attachRole($request->role);//role_ id

        $role_user = new RoleUser();
        $role_user->role_id = $request->role;
        $role_user->user_id = $user->id;
        $role_user->save();

        return redirect()->route('users.index');   
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        if(Auth::user()->hasRole('admin')){
            if ($request->hasFile('employee_photo')) {
                $image = $request->file('employee_photo');
                $name = $image->getClientOriginalName();
                $destinationPath = public_path('/employeesPhoto');
                $image->move($destinationPath, $name);
            }else{
                $name = NULL;
            }
            $update = User::where('id',$user->id)->update([
                'name'  =>$request->first_name." ".$request->last_name,
                'email' =>$request->email,
                'f_name'=>$request->first_name,
                'l_name'=>$request->last_name,
                'dob'   =>$request->date_of_birth,
                'marital_status'=>$request->marital_status,
                'country'=>$request->country,
                'blood_group'=>$request->blood_group,
                'id_number'=>$request->id_number,
                'religious'=>$request->religious,
                'gender'=>$request->gender,
                'photo'=>$name,
                'updated_at'=>Carbon::now()
            ]);
            $user = User::where('id',$user->id)->first();
            
            // $user->roles()->sync($request->role);
            $role_user = new RoleUser();
            $role_user->role_id = $request->role;
            $role_user->user_id = $user->id;
            $role_user->save();
            return redirect()->route('users.show',$user->id);
        }else{
            $update = User::where('id',$user->id)->update([
                'password'  =>bcrypt($request->password),
            ]);
            return redirect()->route('users.show',$user->id);
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        // $delete = User::find($user->id);
        // $delete->delete();
        // if($delete){
        //     // Session::flash('success', 'Employee Data Deleted!');
        //     flash()->success('Employee Data Deleted!');
        // }else{
        //     // Session::flash('failure', 'Something went wrong!');
        //     flash()->error('Something went wrong!');
        // }
        // return redirect()->action(
        //     'UserController@index'
        // );
    }

    public function delete(User $user){
        // $delete = User::find($user->id);
        // $delete->delete();
        // if($delete){
        //     // Session::flash('success', 'Employee Data Deleted!');
        //     flash()->success('Employee Data Deleted!');
        // }else{
        //     // Session::flash('failure', 'Something went wrong!');
        //     flash()->error('Something went wrong!');
        // }
        // return redirect()->action(
        //     'UserController@index'
        // );
    }

    public function showAttendances(User $user, Request $request){
        $year = $request->year;
        $januaryds = 0; $februaryds=0; $marchds = 0; $aprilds=0; $mayds=0; $juneds=0; $julyds=0; $augustds=0; $septemberds=0; $octoberds=0; $novemberds=0; $decemberds=0;
        $monthArr = [$januaryds, $februaryds, $marchds, $aprilds, $mayds, $juneds, $julyds, $augustds, $septemberds, $octoberds, $novemberds, $decemberds];
        for($i=1; $i<=12; $i++){
            $date = Carbon::parse($year.'-'.$i);
            $monthArr[$i-1] = $date->daysInMonth;
        }
       
        if($request == null || $request == ""){
            $attendances = null;
            $user_id     = Auth::user()->id;
            return view('users.attendances.showAttendances',['attendances'=>$attendances,'id'=>$user_id,'year'=>$year,'month'=>$monthArr]);
        }else{
            $attendances = Attendance::whereYear('date',$year)->where('employee_id',Auth::user()->id)->get();
            $user_id     = Auth::user()->id;
            // return response()->json($user_id);
            return view('users.attendances.showAttendances',['attendances'=>$attendances,'id'=>$user_id,'year'=>$year,'month'=>$monthArr]);
        }
    }

    public function setAttendanceYear(Request $request){
        
        $year = Carbon::parse($request->date)->format('Y');
       
        return redirect()->route('profiles.showAttendances',['year'=>$year]);
    }
}
