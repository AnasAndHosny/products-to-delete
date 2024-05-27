<?php

namespace App\Services;

use App\Http\Resources\CityResource;
use App\Http\Resources\StateResource;
use App\Models\City;
use App\Models\State;
use Illuminate\Support\Facades\App;

class CityService
{
    public function index(): array
    {
        $city = City::orderBy('name_' . App::getLocale())->get();
        $city = CityResource::collection($city);
        $message = __('messages.index_success', ['class' => __('cities')]);
        $code = 200;
        return ['city' => $city, 'message' => $message, 'code' => $code];
    }

    public function statesList(City $city): array
    {
        $state = State::where('city_id', $city->id)->orderBy('name_' . App::getLocale())->get();
        $state = StateResource::collection($state);
        $message = __('messages.index_success', ['class' => __('states')]);
        $code = 200;
        return ['state' => $state, 'message' => $message, 'code' => $code];
    }
}
