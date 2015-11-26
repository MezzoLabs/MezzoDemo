<?php


namespace App\Magazine\Events\Http\Requests;


use Illuminate\Support\Facades\Auth;
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
        if (!$this->has('user_id'))
            $this->offsetSet('user_id', Auth::user()->id);

        parent::validate();
    }




}