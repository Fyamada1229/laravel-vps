<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DepartureResource;
use App\Http\Services\DepartureService;

class DepartureController extends Controller
{

    public function index()
    {
    }

    public function store(Request $request, DepartureService $service)
    {
        $departure = $service->store($request);
        return $departure;
    }

    public function show(Request $request, DepartureService $service)
    {
        $departure = $service->show();
        return $departure;
    }
}
