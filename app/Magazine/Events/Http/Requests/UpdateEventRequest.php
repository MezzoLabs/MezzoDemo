<?php


namespace App\Magazine\Events\Http\Requests;


use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;

class UpdateEventRequest extends UpdateResourceRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        mezzo_dd(parent::rules());
    }

    public function validate()
    {
        parent::validate();
    }
}