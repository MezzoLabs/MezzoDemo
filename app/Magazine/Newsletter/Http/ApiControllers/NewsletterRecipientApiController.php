<?php


namespace App\Magazine\Newsletter\Http\ApiControllers;


use MezzoLabs\Mezzo\Http\Controllers\GenericApiResourceController;
use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;

class NewsletterRecipientApiController extends GenericApiResourceController
{
    public function resendConfirmation(UpdateResourceRequest $request, $id)
    {
        $recipient = $request->currentModelInstance();


        return $this->response()->result(1, 'Confirmation sent to ' . $recipient->email, 'Sent');
    }

}