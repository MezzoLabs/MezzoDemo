<?php


namespace App\Magazine\Shop\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class SetProductAmountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'integer|between:0,20'
        ];
    }
}