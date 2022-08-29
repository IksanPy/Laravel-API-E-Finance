<?php

namespace App\Http\Requests\CashRecap;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCashRecapRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            // 'year_month' => ['required', 'date', 'unique:cash_recaps,year_month,NULL,id,user_id,' . auth()->id()],
            'year_month' => [
                'required',
                'date_format:Y-m',
                // membuat year-month dengan user_id yang sama akan terblok
                Rule::unique('cash_recaps')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                })
            ],
            'balance' => ['required', 'integer']
        ];
    }
}
