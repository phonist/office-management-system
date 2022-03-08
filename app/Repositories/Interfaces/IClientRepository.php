<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\Client;

interface IClientRepository
{
    public function all();
    public function store(Request $request);
    public function import(Request $request);
    public function show(Client $client);
    public function edit(Client $client);
    public function update(Request $request, Client $client);
    public function destroy(Client $client);
    public function getById($id);
}