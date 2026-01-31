<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerProfileUpdateRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'district_id' => ['nullable', 'exists:districts,id'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'in:male,female,other'],
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'phone_number.required' => 'Nomor telepon harus diisi.',
            'date_of_birth.before' => 'Tanggal lahir harus sebelum hari ini.',
            'district_id.exists' => 'Kecamatan tidak valid.',
        ];
    }
}
