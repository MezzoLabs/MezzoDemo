<?php


namespace App\Listeners\UserWasRegistered;


use App\Events\UserWasRegistered;
use App\Magazine\Newsletter\Domain\Repositories\NewsletterRecipientRepository;
use App\Magazine\Newsletter\Domain\Services\NewsletterService;

class SendNewsletterConfirmationRequest
{
    /**
     * @var NewsletterService
     */
    private $newsletterService;

    /**
     * @var NewsletterRecipientRepository
     */
    private $recipients;

    /**
     * Create the event listener.
     *
     * @param NewsletterService $newsletterService
     * @param NewsletterRecipientRepository $recipients
     */
    public function __construct(NewsletterService $newsletterService, NewsletterRecipientRepository $recipients)
    {

        $this->newsletterService = $newsletterService;
        $this->recipients = $recipients;
    }

    /**
     * Handle the event.
     *
     * @param  UserWasRegistered $event
     * @return void
     */
    public function handle(UserWasRegistered $event)
    {
        if (!$event->subscribeToNewsletter) {
            return;
        }

        $this->newsletterService->signupEmail($event->user->email);
    }
}