<?php

namespace App\Services;

use App\Repositories\Interfaces\IClientRepository;
use Illuminate\Http\Request;
use App\Client;

class ClientService{
    protected $clients;

    public function __construct(IClientRepository $clients){
        $this->clients = $clients;
    }

    public function all(){
        return $this->clients->all();
    }

    public function store(Request $request){
        return $this->clients->store($request);
    }

    public function downloadClientSample(){
        $file_path = storage_path() . "/app/downloads/client.csv";
        $headers = array(
            'Content-Type: csv',
            'Content-Disposition: attachment; filename=client.csv',
        );
        return ['result'=>file_exists($file_path),'file_path'=>$file_path,'headers'=>$headers];
    }

    public function import(Request $request){
        return $this->clients->import($request);
    }

    public function show(Client $client){
        return $this->clients->show($client);
    }

    public function edit(Client $client){
        return $this->clients->edit($client);
    }

    public function update(Request $request, Client $client){
        return $this->clients->update($request, $client);
    }

    public function destroy(Client $client){
        return $this->clients->destroy($client);
    }
}