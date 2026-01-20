<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:admins,email',
            'username'     => 'required|string|max:255|unique:admins,username',
            'password'     => 'required|string|min:8|max:255',
            'phone_number' => 'required|string|max:20|unique:admins,phone_number',
            'super_admin'  => 'nullable|boolean',
            'store_id'     => 'nullable|exists:stores,id',
            'status'       => 'nullable|in:active,inactive',
        ];
    }
}
