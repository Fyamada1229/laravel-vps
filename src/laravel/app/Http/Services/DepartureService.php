<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Departure;
use App\Http\Resources\DepartureResource;

class DepartureService
{
    public function index()
    { }

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
    { }

    public function show()
    { }
}
