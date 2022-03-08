<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\EmergencyContact;

interface IEmergencyContactRepository{
    public function getByEmployeeId($id);
    public function store(Request $request);
    public function update(Request $request, EmergencyContact $emergencyContact);
    public function destroy($id);
}