<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMockEndpointRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Or add policy logic later
    }

    public function rules(): array
    {
        return [
            'method'       => 'required|string|in:GET,POST,PUT,PATCH,DELETE',
            'path'         => 'required|string|max:255',
            'schema'       => 'required',
            'status_code'  => 'nullable|integer|min:100|max:599',
            'delay_ms'     => 'nullable|integer|min:0|max:10000',
            'response_body' => ['nullable', 'array'],
        ];
    }
}
