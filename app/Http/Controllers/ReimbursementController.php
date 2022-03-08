<?php

namespace App\Http\Controllers;

use App\Reimbursement;
use App\Employee;
use App\Department;
use Illuminate\Http\Request;
use Auth;
use App\Exports\ReimbursementExport;
use App\Services\ReimbursementService;

class ReimbursementController extends Controller
{   
    protected $reimbursements;

    public function __construct(ReimbursementService $reimbursements){
        $this->reimbursements = $reimbursements;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = $this->reimbursements->getDepartments();
        $employees = $this->reimbursements->getEmployees();
        $reimbursements = $this->reimbursements->all();
        return view('admin.reimbursements.index',['departments'=>$departments,'employees'=>$employees,'reimbursements'=>$reimbursements]);   
    }

    public function approval(){
        $departments = Department::all();
        $employees = Employee::where('id',Auth::user()->id)->get();
        $reimbursements = Reimbursement::where('employee_id',Auth::user()->id)->where('m_approved',0)->where('a_approved',0)->get();
        return view('users.reimbursements.approval',['departments'=>$departments,'employees'=>$employees,'reimbursements'=>$reimbursements]);
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
        //
        if(Auth::user()->hasRole('admin')){
            $reimbursement = $this->reimbursements->store($request);
        }else{
            // $date = Carbon::parse($request->date)->format('Y-m-d');
            // $jobHistory = JobHistory::CheckRecordExist(Auth::user()->id);
            // if($jobHistory){
            //     $department_id = JobHistory::departmentId(Auth::user()->id);
            // }else{
            //     $department_id = null;
            // }
            // $store = Reimbursement::create([
            //     'date'=>$date,
            //     'description'=>$request->memo,
            //     'employee_id'=>Auth::user()->id,
            //     'department_id'=>$department_id,
            //     'amount'=>doubleval($request->amount),
            //     'm_approved'=>0,
            //     'a_approved'=>0,
            // ]);
        }
        
        return redirect()->action('ReimbursementController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reimbursement  $reimbursement
     * @return \Illuminate\Http\Response
     */
    public function show(Reimbursement $reimbursement)
    {
        //
        return response()->json($reimbursement);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reimbursement  $reimbursement
     * @return \Illuminate\Http\Response
     */
    public function edit(Reimbursement $reimbursement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reimbursement  $reimbursement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reimbursement $reimbursement)
    {
        //
        // return response()->json($request);
        // $date = Carbon::parse($request->date)->format('Y-m-d');
        // $update = Reimbursement::where('id',$reimbursement->id)->update([
        //     'department_id' => (int)$request->department_id,
        //     'employee_id' => (int)$request->employee_id,
        //     'date'=>$date,
        //     'amount'=>doubleval($request->amount),
        //     'description'=>$request->memo,
        //     // 'm_approved'=>$request->m_approved,
        //     'm_comment'=>$request->manager_comment,
        //     'a_approved'=>(int)$request->approved_admin,
        //     'a_comment'=>$request->admin_comment
        // ]);
        $reimbursement = $this->reimbursements->update($request, $reimbursement->id);
        return redirect()->action('ReimbursementController@index');
    }

    public function export(){
        return (new ReimbursementExport)->download('quotations.csv');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reimbursement  $reimbursement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reimbursement $reimbursement)
    {
        $this->reimbursements->destroy($reimbursement->id);
        return response()->json($reimbursement);
    }
}
