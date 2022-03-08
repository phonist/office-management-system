<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IWithdrawalRepository;
use Illuminate\Http\Request;
use Auth;
use App\Withdrawal;

class WithdrawalRepository implements IWithdrawalRepository{
    protected $withdrawals;

    public function __construct(Withdrawal $withdrawals){
        $this->withdrawals = $withdrawals;
    }

    public function all(){
        return $this->withdrawals->leftjoin('inventories','inventories.id','withdrawals.inventory_id')
                                ->where('inventories.user_id',Auth::user()->id)
                                ->orderBy('withdrawals.created_at','asc')
                                ->get();
    }

    public function store(Request $request){
        $withdrawal = $this->withdrawals;
        $withdrawal->inventory_id = $request->inv_id;
        $withdrawal->w_quantity = $request->w_quantity;
        $withdrawal->project_id = $request->project_id;
        $withdrawal->withdrawer = Auth::user()->name;
        $withdrawal->save();
        return $withdrawal;
    }

    public function update(Request $request, $id){
        $withdrawal = $this->withdrawals->find($id);
        $withdrawal->w_quantity = $request->w_quantity;
        $withdrawal->project_id = $request->project_id;
        $withdrawal->withdrawer = Auth::user()->name;
        $withdrawal->save();
        return $withdrawal;
    }

    public function destroy($id){
        $withdrawal = $this->withdrawals->find($id);
        return $withdrawal->delete();
    }
}