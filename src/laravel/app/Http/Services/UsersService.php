<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\EmployeeAttendance;
use App\Models\Departure;
use Illuminate\Http\Request;
use App\Http\Resources\UsersResource;


class UsersService
{
    public function index()
    {
        $user = User::all();
        return $user;
    }

    public function show($id)
    {
        $user = User::find($id);
        return new UsersResource($user);
    }

    public function edit(Request $data)
    {
        $id = $data->id;
        $user = User::find($id);
        $user->name = $data->name;
        $user->comment = $data->comment;
        $user->update();

        return new UsersResource($user);
    }

    public function update(Request $request)
    {
        $date = $request->date;
        $attendance_time = $request->attendance_time;
        $user_id = intval($request->user_id);
        $break_minutes = intval($request->break_minutes);

        $employeeAttendance = EmployeeAttendance::where('user_id', $user_id)
            ->whereDate('attendance_time', $date)->first();

        if ($employeeAttendance) {
            $employeeAttendance->attendance_time = $attendance_time;
            $employeeAttendance->is_attendance = "1";
            $employeeAttendance->save();
        } else {
            $employeeAttendance = EmployeeAttendance::create([
                'name' => $request->name,
                'user_id' => $user_id,
                'attendance_time' => $attendance_time,
                'is_attendance' => "1",
            ]);
        }

        $date = $request->date;
        $departure_time = $request->departure_time;

        $departure = Departure::where('user_id', $user_id)
            ->whereDate('departure_time', $date)->first();

        if ($departure) {
            $departure->departure_time = $departure_time;
            $departure->break_minutes = $break_minutes;
            $departure->is_departure = "1";
            $departure->save();
        } else {
            $departure = Departure::create([
                'name' => $request->name,
                'user_id' => $user_id,
                'departure_time' => $departure_time,
                'is_departure' => "1",
                'break_minutes' => $break_minutes
            ]);
        }

        return response()->json([
            'departure' => $departure,
            'employeeAttendance' => $employeeAttendance
        ]);
    }
}
