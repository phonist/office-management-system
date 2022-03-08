<?php

namespace App\Repositories\Interfaces; 

use Illuminate\Http\Request;

interface IInventoryRepository{
    public function all();
    public function getNameById($id);
    public function store(Request $request, $file_name);
    public function getById($id);
    public function update(Request $request, $file_name, $id);
    public function destroy($id);
    public function getQuantity($id);
    public function updateQuantity($id, $quantity);
}