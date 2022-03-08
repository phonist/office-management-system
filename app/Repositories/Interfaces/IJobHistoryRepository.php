<?php

namespace App\Repositories\Interfaces;

use App\JobHistory;
use Illuminate\Http\Request;

interface IJobHistoryRepository{
    public function checkJobHistoryExists($id);
    public function getJobHistoryById($id);
    public function checkJobHistoryExistByDepartmentId($id);
    public function getJobHistoryByDepartmentId($id);
    public function store(Request $request);
    public function update(Request $request, JobHistory $jobHistory);
    public function destroy($id);
}