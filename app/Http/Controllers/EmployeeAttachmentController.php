<?php

namespace App\Http\Controllers;

use App\EmployeeAttachment;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Auth;

class EmployeeAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $attachment = $request->file('file');
            $name = $attachment->getClientOriginalName();
            $destinationPath = public_path('/employeeAttachments');
            $attachment->move($destinationPath, $name);
        }else{
            $name = "-";
        }
        $store = EmployeeAttachment::create([
            'name'=>$name,
            'description'=>$request->description,
            'added_by'=>Auth::user()->name,
            'employee_id'=>$request->user_id
        ]);
        return redirect()->route('employees.show',$request->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserAttachment  $userAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(UserAttachment $userAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserAttachment  $userAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAttachment $userAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserAttachment  $userAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAttachment $userAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserAttachment  $userAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAttachment $userAttachment)
    {
        //
    }

    public function delete(Request $request){
        $attachmentId_array = $request->personalAttach;
        if($attachmentId_array!=null){
            foreach($attachmentId_array as $id){
                $attachment = UserAttachment::find((int)$id);
                $attachment->delete();
            }
            return redirect()->route('employees.show',$request->employee_id);
        }else{
            return redirect()->route('employees.show',$request->employee_id);
        }
    }
}
