<?php

namespace App\Services;

use App\Repositories\Interfaces\IOrderRepository;
use App\Repositories\Interfaces\ISaleProductRepository;
use App\Repositories\Interfaces\IClientRepository;
use App\Repositories\Interfaces\IPaymentRepository;
use App\Repositories\Interfaces\IInventoryRepository;
use Illuminate\Http\Request;
use App\Exports\OrderExport;
use App\Exports\ProcessExport;
use App\Exports\PendingExport;
use App\Exports\DeliverExport;
use App\Order;
use App\Services\BaseService;

class OrderService extends BaseService{
    protected $orders;
    protected $saleProducts;
    protected $clients;
    protected $payments;
    protected $inventories;
    protected $bases;

    public function __construct(
        IOrderRepository $orders, 
        ISaleProductRepository $saleProducts, 
        IClientRepository $clients, 
        IPaymentRepository $payments,
        IInventoryRepository $inventories,
        BaseService $bases
    ){
        $this->orders = $orders;
        $this->saleProducts = $saleProducts;
        $this->clients = $clients;
        $this->payments = $payments;
        $this->inventories = $inventories;
        $this->bases = $bases;
    }

    public function all(){
        return $this->orders->all();
    }

    public function store(Request $request, $inventories){
        $latest = Order::latest()->first();
        $request->invoice_number = $this->bases->invoiceNumber($latest, 'INV');
        $result =  $this->orders->store($request);
        for($i = 0; $i < $inventories['count']; $i++){
            $this->saleProducts->storeByOrder(
                $inventories['id'][$i], 
                $inventories['desc'][$i],
                $inventories['qty'][$i],
                $inventories['rate'][$i],
                $inventories['amt'][$i],
                $result['order']->id
            );
        }
        return [
            'result' => true,
            'order' => $result['order']
        ];
    }

    public function create(){
        $inventories = $this->inventories->all();
        $clients = $this->clients->all();
        return [
            'inventories' => $inventories,
            'clients' => $clients
        ];
    }

    public function show(Order $order){
        $invoice = $this->orders->show($order);
        $sale_product = $this->saleProducts->getByOrder($invoice->id);
        $client = $this->clients->getById($invoice->client_id);
        $payments = $this->payments->getByOrder($invoice->id);
        return ['invoice'=>$invoice, 'sale_product'=>$sale_product, 'client'=>$client,'payments'=>$payments];
    }

    public function edit(Order $order){
        $invoice = $this->orders->edit($order);
        $inventories = $this->inventories->all();
        $sale_product = $this->saleProducts->getByOrder($invoice->id);
        $client = $this->clients->getById($invoice->client_id);
        return ['invoice'=>$invoice,'clients'=>$client,'sale_product'=>$sale_product,'inventories'=>$inventories];
    }

    public function update(Request $request, Order $order, $paid, $inventories){
        $result = true;
        $order = $this->orders->update($request, $order, $paid);
        for($i=0;$i<$inventories['count'];$i++){
            if(!array_key_exists($i, $inventories['sale_id'])){
                $this->saleProducts->store(
                    $inventories['id'][$i], 
                    $inventories['desc'][$i], 
                    $inventories['qty'][$i], 
                    $inventories['rate'][$i], 
                    $inventories['amt'][$i], 
                    $order['order']->id
                );
            }else{
                $this->saleProducts->update(
                    $inventories['sale_id'][$i],
                    $inventories['id'][$i], 
                    $inventories['desc'][$i], 
                    $inventories['qty'][$i], 
                    $inventories['rate'][$i], 
                    $inventories['amt'][$i], 
                    $order['order']->id
                );
            }
        }
        $sale_items = $this->saleProducts->getByOrder($order['order']->id);
        foreach($sale_items as $item){
            if(!in_array($item->inventory_id,$inventories['id'])){
                $this->saleProducts->destroy($item->id);
            }
        }
        return [
            'result' => $result
        ];
    }

    public function destroy(Order $order){
        return $this->orders->destroy($order);
    }

    public function exportOrder(){
        return (new OrderExport)->download('processing.csv');
    }

    public function exportProcessing(){
        return (new ProcessExport)->download('processing.csv');
    }

    public function exportPending(){
        return (new PendingExport)->download('pending.csv');
    }

    public function exportDeliver(){
        return (new DeliverExport)->download('delivery.csv');
    }

    public function getOrderTotal($order_id){
        return $this->orders->getOrderTotal($order_id);
    }

    public function updatePaid($order_id,$total, $balance){
        return $this->orders->updatePaid($order_id, $total, $balance);
    }

    public function getById($order_id){
        return $this->orders->getById($order_id);
    }

    public function getByStatus($status){
        return $this->orders->getByStatus($status);
    }

    public function updateStatus(Order $order, $status){
        return $this->orders->updateStatus($order, $status);
    }

    
}