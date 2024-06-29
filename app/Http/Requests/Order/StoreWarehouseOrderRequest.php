<?php

namespace App\Http\Requests;

use App\Http\Responses\Response;
use App\Models\Order;
use App\Rules\OrderableFrom;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get the available employable types from the Employee model
        $availableOrderableFrom = array_keys(Order::getAvailableOrderableFrom());

        return [
            'orderable_from_type' => ['required', 'in:' . implode(',', $availableOrderableFrom)],
            'orderable_from_id' => ['required', new OrderableFrom($this->orderable_from_type)],
            'products' => ['array', 'present'],
            'products.*.id' => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
            'products.*.cost' => ['required', 'regex:/^\d+(\.\d{1,2})?$/', 'min:0'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Throw a validationException with the translated error messages
        throw new ValidationException($validator, Response::Validation([], $validator->errors()));
    }
}
