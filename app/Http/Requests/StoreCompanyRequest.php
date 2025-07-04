<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCompanyRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $id = $this->input('id'); // For update (optional)

        return [
            'id'      => ['nullable', 'integer', Rule::exists('companies', 'id')],
            'name'    => 'required|string|max:255',
            'email'   => [
                'nullable',
                'email',
                Rule::unique('companies', 'email')->ignore($id),
            ],
            'logo'    => 'nullable|image|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url',
        ];
    }

    /**
     * Custom attribute names for validation errors.
     */
    public function attributes(): array
    {
        return [
            'name'  => __('name'),
            'email' => __('email'),
            'logo'  => __('logo'),
            'website' => __('website'),
        ];
    }
}
