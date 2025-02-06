<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ProductRequest extends FormRequest
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
            'product_name' => 'required|string',
            'active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'product_name.required' => "mahsulot nomini kiriting",
            'product_name.string' => "mahsulot nomini yozuv shaklida kiriting",
            'active.boolean' => "mahsulot nomini holatini kiriting",
        ];
    }



    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'message' => 'Validation failed',
    //         'errors' => $validator->errors(),
    //     ], 422));
    // }
    protected function failedValidation(Validator $validator)
    {
        $generatedErrors = (new ValidationException($validator))->errors();
        $message = "";
        if ($generatedErrors) {
            foreach ($generatedErrors as $key => $error) {
                if (!empty($error)) {
                    $count = count($error);
                    for ($i = 0; $i < $count; $i++) {
                        $message .= " " . $error[$i];
                    }
                }
            }
        }

        throw new HttpResponseException(
            response()->json([
                "message" => $message,
                'errors' => $generatedErrors
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

}
