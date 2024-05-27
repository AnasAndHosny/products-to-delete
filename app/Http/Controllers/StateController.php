<?php

namespace App\Http\Controllers;

use App\Http\Requests\State\StoreStateRequest;
use App\Http\Requests\State\UpdateStateRequest;
use App\Http\Responses\Response;
use App\Models\State;
use App\Services\StateService;
use Illuminate\Http\JsonResponse;
use Throwable;

class StateController extends Controller
{
    private StateService $stateService;

    public function __construct(StateService $stateService)
    {
        $this->stateService = $stateService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->stateService->index();
            return Response::Success($data['state'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error($data, $message);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStateRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->stateService->store($request);
            return Response::Success($data['state'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error($data, $message);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(State $state): JsonResponse
    {
        $data = [];
        try {
            $data = $this->stateService->show($state);
            return Response::Success($data['state'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error($data, $message);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStateRequest $request, State $state): JsonResponse
    {
        $data = [];
        try {
            $data = $this->stateService->update($request, $state);
            return Response::Success($data['state'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error($data, $message);
        }
    }
}
