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

        $employeeAttendance = EmployeeAttendance::whereDate('attendance_time', $date)->first();

        if ($employeeAttendance) {
            $employeeAttendance->attendance_time = $attendance_time;
            $employeeAttendance->save();
        } else {
            $employeeAttendance = EmployeeAttendance::create([
                'name' => $request->name,
                'user_id' => $request->user_id,
                'attendance_time' => $attendance_time,
                'is_attendance' => "1"
            ]);
        }

        $date = $request->date;
        $departure_time = $request->departure_time;

        $departure = Departure::whereDate('departure_time', $date)->first();

        if ($departure) {
            $departure->departure_time = $departure_time;
            $departure->save();
        } else {
            $departure = Departure::create([
                'name' => $request->name,
                'user_id' => $request->user_id,
                'departure_time' => $departure_time,
                'is_attendance' => "1"
            ]);
        }

        return response()->json([
            'departure' => $departure,
            'employeeAttendance' => $employeeAttendance
        ]);
    }
}
