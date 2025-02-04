<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class IncomeRequest extends FormRequest
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
            'supplier_product_id' => 'required|numeric',
            'currency_id' => 'required|int',
            'per_purchase_USD' => 'numeric',
            'per_purchase_UZS' => 'numeric',
            'measurement_id' => 'required|int|exists:measurements,id',
            'quantity' => 'required|numeric'
        ];
    }

    public function messages(): array
{
    return [
        'supplier_product_id.required' => 'mahsulot va taminotchisini kiriting',
        'supplier_product_id.numeric' => 'mahsulot va taminotchisini raqam shaklida kiriting',
            'currency_id.required' => 'valuta kiriting',
            'currency_id.int' => 'valutani raqam shaklida kiriting',
            'per_purchase_USD.numeric' => 'dollarni raqam shaklida kiriting',
            'per_purchase_UZS.numeric' => 'dollarni raqam shaklida kiriting',
            'measurement_id.numeric' => "o'lchov birligini raqam shaklida kiriting",
            'measurement_id.exists' => "o'lchov birligi mavjud emas",
            'quantity.numeric' => "miqdorni raqam shaklida kiriting",
            'quantity.required' => "miqdorni kiriting"
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
