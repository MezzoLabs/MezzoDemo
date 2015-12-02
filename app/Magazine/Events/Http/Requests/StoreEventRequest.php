<?php


namespace App\Magazine\Events\Http\Requests;


use Illuminate\Support\Facades\Auth;
use MezzoLabs\Mezzo\Http\Requests\Resource\StoreResourceRequest;
use MezzoLabs\Mezzo\Modules\Addresses\Http\Requests\HasNestedAddress;

class StoreEventRequest extends StoreResourceRequest
{
    use HasNestedAddress, HandlesEventDays;

    /**
     * Called right after a request is constructed
     */
    protected function boot()
    {
        parent::boot();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  parent::rules();

        unset($rules['user_id']);

        return $rules;
    }


    /**
     * Validate the class instance.
     *
     * @return void
     */
    public function validate()
    {
        $this->validateDaysNotOverlapping($this->get('days', []));
        parent::validate();
    }

    /**
     * Creates a form object for the current resource request.
     *
     * @return FormObject|GenericFormObject
     */
    public function formObject()
    {
        $formObject = parent::formObject();

        if (empty($formObject->data()->get('user_id', '')))
            $formObject->data()->put('user_id', Auth::user()->id);

        return $formObject;
    }
}