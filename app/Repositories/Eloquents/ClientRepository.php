<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IClientRepository;
use Illuminate\Http\Request;
use App\Imports\ClientsImport;
use App\Client;
use File;
use Excel;
use Auth;

class ClientRepository implements IClientRepository
{
    public function __construct(Client $clients)
    {
        $this->clients = $clients;
    }
    /**
     * Get all of the client for the given user.
     *
     * @param  Client  $client
     * @return Collection
     */
    public function all()
    {
        return $this->clients->where('user_id', Auth::user()->id)
                    ->orderBy('updated_at', 'desc')
                    ->get();
    }

    public function store(Request $request){
        $client = $this->clients;
        $client->company = $request->company_name;
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->fax = $request->fax;
        $client->email = $request->email;
        $client->website = $request->website;
        $client->billing_address = $request->b_address;
        $client->shipping_address = $request->s_address;
        $client->note = $request->note;
        $client->user_id = Auth::user()->id;
        return $client->save();
    }

    public function import(Request $request){
        $result = [];
        $client_name = [];
        if ($request->hasFile('import_file')) {
            $extension = File::extension($request->import_file->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->import_file->getRealPath();
                $data = Excel::import(new ClientsImport, $request->import_file);
                if(!empty($data)){
                    $result = ['result'=>true, 'status'=>'success','message'=>'Clients Data Imported!'];
                }else{
                    $result = ['result'=>false, 'status'=>'warning','message'=>'There is no data in csv file!'];
                }
            }else{
                $result = ['result'=>false, 'status'=>'warning','message'=>'Selected file is not csv!'];
            }
        }else{
            $result = ['result'=>false, 'status'=>'warning','message'=>'Something went wrong!'];
        }
        return $result;
    }

    public function show(Client $client){
        return $client;
    }

    public function edit(Client $client){
        return $client;
    }

    public function update(Request $request, Client $client){
        $client = $this->clients->find($client->id);
        $client->name = $request->name;
        $client->company = $request->company_name;
        $client->phone = $request->phone;
        $client->fax = $request->fax;
        $client->email = $request->email;
        $client->website = $request->website;
        $client->billing_address = $request->b_address;
        $client->shipping_address = $request->s_address;
        $client->note = $request->note;
        return $client->save();
    }

    public function destroy(Client $client){
        $client = $this->clients->find($client->id);
        return $client->delete();
    }

    public function getById($id){
        return $this->clients->where('id',$id)->get();
    }
}