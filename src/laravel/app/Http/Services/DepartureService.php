<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Resources\DepartureResource;
use App\Models\Departure;
use App\Models\EmployeeAttendance;
use Carbon\Carbon;

class DepartureService
{
    public function index()
    {
    }

    public function store(Request $request)
    {
        $user_id = $request->id;

        $employeeAttendance = EmployeeAttendance::where('user_id', $user_id)->first();

        $attendance_time = Carbon::parse($employeeAttendance->attendance_time);
        $departure_time = Carbon::parse($request->departure_time);
        $workHours = $departure_time->diffInHours($attendance_time);

        $departure = new Departure();

        if ($workHours >= 8) {
            $departure->break_minutes = 60;
        } elseif ($workHours > 6) {
            $departure->break_minutes = 45;
        } else {
            $departure->break_minutes = 0;
        }

        $departure->departure_time = $request->departure_time;
        $departure->user_id = $user_id;
        $departure->name = $request->name;
        $departure->is_departure = $request->is_departure;
        $departure->next_reset_time = $request->next_reset_time;
        $departure->save();

        // リソースクラスを用いてレスポンスを返す
        return new DepartureResource($departure);
    }

    public function update(Request $request)
    {
        $userId = $request->id;

        $departure = Departure::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($departure) {
            $departure->comment = $request->comment;
            $departure->save();

            return new DepartureResource($departure);
        } else {
            return "該当するデータがないです。";
        }
    }

    public function show()
    {
        $userId = auth()->id(); // ログインしているユーザーのIDを取得

        $departure = Departure::where('user_id', $userId)
            ->where('next_reset_time', '1')
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$departure) {
            $departure = Departure::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->first();
        }

        return new DepartureResource($departure);
    }
}
