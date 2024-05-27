<?php

namespace App\Http\Controllers;

use App\Http\Responses\Response;
use App\Models\City;
use App\Services\CityService;
use Illuminate\Http\JsonResponse;
use Throwable;

class CityController extends Controller
{
    private CityService $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->cityService->index();
            return Response::Success($data['city'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error($data, $message);
        }
    }

    /**
     * Display a listing of the states from specific City.
     */
    public function statesList(City $city): JsonResponse
    {
        $data = [];
        try {
            $data = $this->cityService->statesList($city);
            return Response::Success($data['state'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error($data, $message);
        }
    }
}
