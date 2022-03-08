<?php

namespace App\Services;

use App\Repositories\Interfaces\IQuotationRepository;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IQuotationProductRepository;
use App\Repositories\Interfaces\IClientRepository;
use App\Repositories\Interfaces\IInventoryRepository;
use App\Quotation;
use App\Exports\QuotationExport;
use App\Services\BaseService;

class QuotationService extends BaseService{
    protected $quotations;
    protected $quotationProducts;
    protected $clients;
    protected $inventories;
    protected $bases;

    public function __construct(
        IQuotationRepository $quotations,
        IQuotationProductRepository $quotationProducts,
        IClientRepository $clients,
        IInventoryRepository $inventories,
        BaseService $bases
    ){
        $this->quotations = $quotations;
        $this->quotationProducts = $quotationProducts;
        $this->clients = $clients;
        $this->inventories = $inventories;
        $this->bases = $bases;
    }

    public function all(){
        return $this->quotations->all();
    }

    public function create(){
        $inventories = $this->inventories->all();
        $clients = $this->clients->all();
        return [
            'inventories' => $inventories,
            'clients' => $clients
        ];
    }

    public function store(Request $request, $inventories){
        $latest = Quotation::latest()->first();
        $request->invoice_number = $this->bases->invoiceNumber($latest, 'QUO');
        $quotation = $this->quotations->store($request);
        for($i=0;$i<$inventories['count'];$i++){
            $this->quotationProducts->updateOrCreate(
                $inventories['id'][$i], 
                $inventories['desc'][$i],
                $inventories['qty'][$i],
                $inventories['rate'][$i],
                $inventories['amt'][$i],
                $quotation['quotation']->id
            );
        }
        return [
            'result' => true
        ];
    }

    public function show(Quotation $quotation){
        $quotations = $this->quotations->show($quotation);
        $client = $this->clients->getById($quotation->client_id);
        $quotation_products = $this->quotationProducts->getByQuotationId($quotation->id);
        return ['quotation'=>$quotations, 'client'=>$client, 'quotation_products'=>$quotation_products];
    }

    public function edit(Quotation $quotation){
        $quotations = $this->quotations->edit($quotation);
        $client = $this->clients->getById($quotation->client_id);
        $quotation_products = $this->quotationProducts->getByQuotationId($quotation->id);
        $inventories = $this->inventories->all();
        return [
            'quotations'=>$quotations, 
            'client'=>$client, 
            'quotation_products'=>$quotation_products,
            'inventories' => $inventories
        ];
    }

    public function update(Request $request, Quotation $quotation, $inventories){
        $quotation = $this->quotations->update($request, $quotation);
        //issue here
        for($i=0;$i<$inventories['count'];$i++){
            $this->quotationProducts->updateOrCreate(
                $inventories['id'][$i], 
                $inventories['desc'][$i],
                $inventories['qty'][$i],
                $inventories['rate'][$i],
                $inventories['amt'][$i],
                $quotation['quotation']->id
            );
        }
        //issue here
        $quotation_items = $this->quotationProducts->getByQuotationId($quotation['quotation']->id);
        foreach($quotation_items as $item){
            if(!in_array($item->inventory_id,$inventories['id'])){
                $this->quotationProducts->destroy($item->id);
            }
        }
        return [
            'result' => true,
        ];
    }

    public function destroy(Quotation $quotation){
        return $this->quotations->destroy($quotation);
    }

    public function exportQuotation(){
        return (new QuotationExport)->download('quotations.csv');
    }
}