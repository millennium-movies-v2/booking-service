<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'string', 'uuid'],
            'screening_id' => ['required', 'string', 'uuid'],

            'seats' => ['required', 'array', 'min:1'],

            'seats.*.seat_ids'   => ['required', 'array', 'min:1'],
            'seats.*.seat_ids.*' => ['required', 'string', 'uuid'],

            'seats.*.pricing'             => ['required', 'array'],
            'seats.*.pricing.type'        => ['required', 'string'],
            'seats.*.pricing.unit_price'  => ['required', 'numeric', 'min:0'],
        ];
    }

}
