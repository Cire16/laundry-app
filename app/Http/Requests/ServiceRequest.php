<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price_per_kg' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_acrtive' => 'boolean',
            'sort_order' => 'integer|min:0',
        ];
    }
}
