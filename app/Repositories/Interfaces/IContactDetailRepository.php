<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface IContactDetailRepository {
    public function checkContactDetailExists($id);
    public function getContactDetailById($id);
    public function storeContactDetailById($id);
    public function updateOrCreate(Request $request);
}