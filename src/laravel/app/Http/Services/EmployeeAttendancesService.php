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
            $employeeAttendance->save();

            return new EmployeeAttendancesResource($employeeAttendance);
        }
    }

    public function show()
    {
        $userId = auth()->id(); // ログインしているユーザーのIDを取得

        $employeeAttendance = EmployeeAttendance::where('user_id', $userId)
            ->where('next_reset_time', '1')
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$employeeAttendance) {
            $employeeAttendance = EmployeeAttendance::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->first();
        }

        return new EmployeeAttendancesResource($employeeAttendance);
    }

    public function userSearch(Request $request)
    {
        $userId = $request->id;

        $userId = $request->id;

        $employeeAttendance = EmployeeAttendance::select(
            'employee_attendances.*',
            'departures.departure_time',
            'departures.comment as end_comment',
            'departures.break_minutes as break_minutes',
        )
            ->leftJoin('departures', function ($join) {
                $join->on('employee_attendances.user_id', '=', 'departures.user_id')
                    ->whereRaw('DATE(employee_attendances.attendance_time) = DATE(departures.departure_time)');
            })
            ->where('employee_attendances.user_id', $userId)
            ->get();

        //dd($employeeAttendance);

        return new EmployeeAttendancesResource($employeeAttendance);
    }
}
