<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SupplierProductRequest extends FormRequest
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
            'supplier_id' => 'required|int',
            'product_id' => 'required|int',
        ];
    }

    public function messages(): array
    {
        return [
            'supplier_id.required' => "taminotchi malumotini kiriting",
            'supplier_id.int' => "taminotchi malumotini raqam shaklida kiriting",
            'product_id.required' => "mahsulot ma'lumotini kiriting",
            'product_id.int' => "mahsulot malumotini raqam shaklida kiriting"
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
