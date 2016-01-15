<?php


namespace App\Listeners\UserWasVerified;


use App\Events\UserWasVerified;
use App\Magazine\NewsLetter\Services\NewsletterService;

class SubscribeToNewsletter
{
    /**
     * @var NewsletterService
     */
    protected $service;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(NewsletterService $service)
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