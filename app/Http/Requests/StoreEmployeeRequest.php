<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
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
        $employeeId = $this->input('id'); // for unique rules in update

        return [
            'id'         => ['nullable', Rule::exists('employees', 'id')],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'company_id' => ['required', Rule::exists('companies', 'id')],
            'email'      => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('employees', 'email')->ignore($employeeId),
            ],
            'phone'      => ['nullable', 'integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'first_name' => __('first name'),
            'last_name'  => __('last name'),
            'company_id' => __('company'),
            'email'      => __('email'),
            'phone'      => __('phone'),
        ];
    }
}
