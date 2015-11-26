<?php


namespace App\Magazine\Events\Http\Requests;


use MezzoLabs\Mezzo\Http\Requests\Resource\StoreResourceRequest;
use MezzoLabs\Mezzo\Modules\Addresses\Http\Requests\HasNestedAddress;

class StoreEventRequest extends StoreResourceRequest
{
    use HasNestedAddress;

    /**
     * Validate the class instance.
     *
     * @return void
     */
    public function validate()
    {
        mezzo_dd($this->formObject()->rules());

        parent::validate();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $eventRules = $this->modelReflection()->rules();

        $eventRules = array_merge($eventRules, $this->addressRules('address'));

        return $eventRules;
    }



}