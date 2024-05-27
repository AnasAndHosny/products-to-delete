<?php

namespace App\Services;

use App\Http\Resources\StateResource;
use App\Models\State;

class StateService
{
    public function index(): array
    {
        $state = StateResource::collection(State::all());
        $message = __('messages.index_success', ['class' => __('states')]);
        $code = 200;
        return ['state' => $state, 'message' => $message, 'code' => $code];
    }

    public function store($request): array
    {
        $state = State::query()->create([
            'name_ar' => $request['name_ar'],
            'name_en' => $request['name_en'],
            'city_id' => $request['city_id']
        ]);

        $state = new StateResource($state);
        $message = __('messages.store_success', ['class' => __('state')]);
        $code = 201;
        return ['state' => $state, 'message' => $message, 'code' => $code];
    }

    public function show(State $state): array
    {
        $state = new StateResource($state);
        $message = __('messages.show_success', ['class' => __('state')]);
        $code = 200;
        return ['state' => $state, 'message' => $message, 'code' => $code];
    }

    public function update($request, State $state): array
    {
        $state->update([
            'name_ar' => $request['name_ar'] ?? $state['name_ar'],
            'name_en' => $request['name_en'] ?? $state['name_en'],
            'city_id' => $request['city_id'] ?? $state['city_id']
        ]);

        $state = new StateResource($state);
        $message = __('messages.update_success', ['class' => __('state')]);
        $code = 200;
        return ['state' => $state, 'message' => $message, 'code' => $code];
    }
}
