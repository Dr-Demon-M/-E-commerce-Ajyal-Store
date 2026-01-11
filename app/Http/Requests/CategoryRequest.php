<?php

namespace App\Http\Requests;

use App\Rules\Filter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $id = $this->route('category'); // في متغير اسمه نيم من الراوت الحالي حط فيه قيمة الكاتيجوري
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($id),
                // 'unique:categories,name,' . $id, 
                // function ($attribute, $value, $fails) {
                //     if (strtolower($value) == 'php') {
                //         $fails('Not Avilable Name');
                //     }
                // }
                new Filter(['php', 'html']) // filter in app/Rules
            ],
            'parent_id' => 'nullable|integer|exists:Categories,id',
            'image' => 'image',
            'status' => 'required|in:active,archived'
        ];
    }
}
