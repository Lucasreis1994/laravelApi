<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Conversion;

class ConversionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Conversion $conversion)
    {
        return [
            'conversionValue' => 'required|numeric|min:1000|max:100000',
            'targetCurrency'  => [
                'required',
                Rule::in( $conversion->targetCurrency() ),
            ],
            'paymentMethod'   => [
                'required',
                Rule::in([1, 2]),
            ],
        ];
    }

    public function messages(){
        return [
            'conversionValue.min'     => 'O valor minimo é 1000',
            'conversionValue.max'     => 'O valor máximo é 100000',
            'conversionValue.numeric' => 'O valor Tem que ser numérico',

            'targetCurrency.required' => 'A moeda para conversão é obrigatória',
        ];
    }
}
