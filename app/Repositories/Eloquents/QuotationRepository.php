<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IQuotationRepository;
use Illuminate\Http\Request;
use App\Quotation;
use App\Client;
use Auth;

class QuotationRepository implements IQuotationRepository{
    protected $quotations;
    protected $clients;

    public function __construct(Quotation $quotations, Client $clients){
        $this->quotations = $quotations;
        $this->clients = $clients;
    }

    public function all(){
        return $this->quotations->leftjoin('clients','quotations.client_id','clients.id')
                        ->where('clients.user_id',Auth::user()->id)
                        ->addSelect(['client'=>$this->clients->select('name')->whereColumn('id','quotations.client_id')])
                        ->orderBy('quotations.created_at','asc')
                        ->get();
    }

    public function store(Request $request){
        $quotation = $this->quotations;
        $quotation->client_id = $request->client_id;
        $quotation->estimate_date = $request->est_date;
        $quotation->expiration_date = $request->exp_date;
        $quotation->total = $request->total;
        $quotation->g_total = $request->g_total;
        $quotation->tax = $request->tax;
        $quotation->discount = $request->discount;
        $quotation->status = 'pending';
        $quotation->order_note = $request->order_note;
        $quotation->order_activities = $request->order_activities;
        $quotation->invoice_number = $request->invoice_number;
        return [
            'result'=>$quotation->save(),
            'quotation'=>$quotation
        ];
    }

    public function show(Quotation $quotation){
        return $this->quotations->where('id',$quotation->id)->get();
    }

    public function edit(Quotation $quotation){
        return $this->quotations->where('id',$quotation->id)->get();
    }

    public function update(Request $request, Quotation $quotation){
        $quotation = $this->quotations->find($quotation->id);
        $quotation->estimate_date = $request->est_date;
        $quotation->expiration_date = $request->exp_date;
        $quotation->total = $request->total;
        $quotation->g_total = $request->g_total;
        $quotation->tax = $request->tax;
        $quotation->discount = $request->discount;
        $quotation->order_note = $request->order_note;
        $quotation->order_activities = $request->order_activities;
        return [
            'result' => $quotation->save(),
            'quotation' => $quotation
        ];
    }

    public function destroy(Quotation $quotation){
        $quotation = $this->quotations->find($quotation->id);
        return $quotation->delete();
    }
}