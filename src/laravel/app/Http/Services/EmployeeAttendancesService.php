<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Resources\EmployeeAttendancesResource;
use App\Models\EmployeeAttendance;

class EmployeeAttendancesService
{
    public function index()
    {
    }

    public function store(Request $request)
    {

        $data = $request->all();

        $employeeAttendance = new EmployeeAttendance();
        $employeeAttendance->fill($data);
        $employeeAttendance->user_id = $data['id'];
        $employeeAttendance->save();

        // リソースクラスを用いてレスポンスを返す
        return new EmployeeAttendancesResource($employeeAttendance);
    }

    public function update(Request $request)
    {
        $userId = $request->id;

        $employeeAttendance = EmployeeAttendance::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($employeeAttendance) {
            $employeeAttendance->comment = $request->comment;
            $employeeAttendance->update();

            return new EmployeeAttendancesResource($employeeAttendance);
        }
    }

    public function show()
    {
        $userId = auth()->id(); // ログインしているユーザーのIDを取得

        $employeeAttendance = EmployeeAttendance::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();

        return new EmployeeAttendancesResource($employeeAttendance);
    }
}
