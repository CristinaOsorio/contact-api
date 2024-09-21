<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'birthday' => 'nullable|date',
            'company' => 'nullable|string|max:255',
            'website' => 'nullable|url',
            'phoneNumbers' => 'required|array',
            'phoneNumbers.*.number' => 'required|string',
            'emails' => 'required|array',
            'emails.*.address' => 'required|email',
            'addresses' => 'required|array',
            'addresses.*.location' => 'required|string',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors occurred.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
