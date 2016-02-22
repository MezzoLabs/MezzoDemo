<?php


namespace App\Magazine\Newsletter\Http\ApiControllers;


use App\Magazine\Newsletter\Domain\Models\NewsletterRecipient;
use App\Magazine\Newsletter\Domain\Services\NewsletterService;
use MezzoLabs\Mezzo\Http\Controllers\GenericApiResourceController;
use MezzoLabs\Mezzo\Http\Requests\Resource\ResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;

class NewsletterRecipientApiController extends GenericApiResourceController
{
    /**
     * @var NewsletterService
     */
    private $newsletterService;

    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }


    /**
     * @param UpdateResourceRequest $request
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function resendConfirmation(UpdateResourceRequest $request, $id)
    {
        $recipient = $this->currentRecipient($request);

        if ($recipient->state != NewsletterRecipient::STATE_CONFIRMATION_PENDING) {
            return $this->response()->result(2, $recipient->email . ' already confirmed or rejected the newsletter.', 'Sent');
        }

        $this->newsletterService->sendConfirmationMail($recipient);

        return $this->response()->result(1, 'Confirmation sent to ' . $recipient->email, 'Sent');
    }

    /**
     * @param ResourceRequest $request
     * @return NewsletterRecipient
     */
    private function currentRecipient(ResourceRequest $request)
    {
        return $request->currentModelInstance();
    }



}