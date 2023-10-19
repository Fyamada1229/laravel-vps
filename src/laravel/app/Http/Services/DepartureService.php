<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Resources\DepartureResource;
use App\Models\Departure;

class DepartureService
{
    public function index()
    {
    }

    public function store(Request $request)
    {

        $data = $request->all();

        $departure = new Departure();
        $departure->fill($data);
        $departure->user_id = $data['id'];
        $departure->save();

        // リソースクラスを用いてレスポンスを返す
        return new DepartureResource($departure);
    }

    public function edit()
    {
    }

    public function show()
    {
        $userId = auth()->id(); // ログインしているユーザーのIDを取得

        $departure = Departure::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();

        return new DepartureResource($departure);
    }
}
