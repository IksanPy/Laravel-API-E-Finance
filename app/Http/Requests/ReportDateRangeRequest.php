<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReportDateRangeRequest extends FormRequest
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
            'start_date' => 'required|date_format:Y-m-d|before_or_equal:end_date|required_with:end_date',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
            'type' => Rule::in(['debit', 'credit'])
        ];
    }
}
