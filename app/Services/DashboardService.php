<?php

namespace App\Services;

use App\Repositories\Interfaces\IOrderRepository;
use App\Repositories\Interfaces\IClientRepository;
use Carbon\Carbon;

class DashboardService{
    protected $orders;

    public function __construct(
        IOrderRepository $orders,
        IClientRepository $clients
    ){
        $this->orders = $orders;
        $this->clients = $clients;
    }

    public function chartSales(){
        $salePerMonth = [0,0,0,0,0,0,0,0,0,0,0,0];
        $result = $this->orders->all();
        foreach($result as $data)
            $salePerMonth[(int)Carbon::parse($data->created_at)->format('m')-1]++;
        return $salePerMonth;
    }

    public function chartClients(){
        $clientPerMonth = [0,0,0,0,0,0,0,0,0,0,0,0];
        $result = $this->clients->all();
        foreach($result as $data)
            $clientPerMonth[(int)Carbon::parse($data->created_at)->format('m')-1]++;
        return $clientPerMonth;
    }
}