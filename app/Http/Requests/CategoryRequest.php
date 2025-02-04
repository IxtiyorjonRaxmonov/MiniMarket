<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
        return [
            'category_name' => 'required|string|max:150',
            'parent_id' => 'numeric',
            'active' => 'boolean'
        ];
    }


        public function messages(): array
    {
        return [
            'category_name.required' => 'kategoriya nomi yozilishi shart',
            'category_name.max' => "kategoriya nomida eng ko'pi 150 ta harf yozish mumkin",
            'category_name.string' => 'kategoriya nomi yozuv shaklida yozilishi shart',
            'parent_id.numeric' => "qo'shimcha kategoriya raqam shaklida yozilishi shart",
            'active.boolean' => "kategoriya aktivligi turi noto'g'ri shaklda kiritildi",
        ];
    }


   
        protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422));
    }

}
