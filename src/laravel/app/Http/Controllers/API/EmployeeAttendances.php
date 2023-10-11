<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmployeeAttendance;
use App\Http\Services\EmployeeAttendancesService;

class EmployeeAttendances extends Controller
{
    public function index()
    { }

    public function store(Request $request, EmployeeAttendancesService $service)
    {
        $employeeAttendance = $service->store($request);
        //dd($employeeAttendance);
        return $employeeAttendance;
    }
}
