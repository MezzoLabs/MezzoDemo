<?php


namespace App\Listeners\UserWasVerified;


use App\Events\UserWasVerified;
use App\Magazine\Newsletter\Domain\Services\MailchimpNewsletterService;

class SubscribeToNewsletter
{
    /**
     * @var MailchimpNewsletterService
     */
    protected $service;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(MailchimpNewsletterService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  UserWasVerified $event
     * @return void
     */
    public function handle(UserWasVerified $event)
    {
        $user = $event->user;
        $subscriptionData = [
            'GENDER' => ($user->gender == 'm') ? 'Male' : 'Female',
            'FNAME' => $user->first_name,
            'LNAME' => $user->last_name,
        ];

        $this->service->addEmailToList($user->email, $subscriptionData);
    }
}