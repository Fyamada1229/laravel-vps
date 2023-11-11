<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\EmployeeAttendancesService;
use App\Models\EmployeeAttendance;

class EmployeeAttendancesController extends Controller
{
    public function index()
    {
    }

    public function store(Request $request, EmployeeAttendancesService $service)
    {
        $employeeAttendance = $service->store($request);
        return $employeeAttendance;
    }

    public function update(Request $request, EmployeeAttendancesService $service)
    {
        $employeeAttendance = $service->update($request);
        return $employeeAttendance;
    }

    public function show(Request $request, EmployeeAttendancesService $service)
    {
        $employeeAttendance = $service->show();
        return $employeeAttendance;
    }

    public function userSearch(Request $request, EmployeeAttendancesService $service)
    {
        $employeeAttendance = $service->userSearch($request);
        return $employeeAttendance;
    }
}
