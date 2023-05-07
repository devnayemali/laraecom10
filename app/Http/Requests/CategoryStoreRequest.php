<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_name' => 'required|max:255',
            'status' => 'numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'category_name.required' => 'The Category Name is required',
            'category_discount.numeric' => 'The Category Discount must be a number',
            'status.required' => 'Select Category Status',
            'status.numeric' => 'Select Category Status'
        ];
    }
}
