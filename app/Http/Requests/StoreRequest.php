<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|min:5|unique:stores,name',
            'description' => 'nullable|string|max:255',
            'logo_image' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:2048',
            'slug' => 'unique:stores,slug',
            'status' => 'required|in:active,inactive'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Store name is required.',
            'name.string' => 'Store name must be a string.',
            'name.min' => 'Store name must be at least 5 characters.',
            'name.unique' => 'This store name already exists.',

            'description.string' => 'Description must be a string.',
            'description.max' => 'Description cannot exceed 255 characters.',

            'logo_image.image' => 'Logo must be an image file.',
            'cover_image.image' => 'Cover image must be an image file.',

            'status.required' => 'Status is required.',
            'status.in' => 'Status must be either active or inactive.',
        ];
    }
}
