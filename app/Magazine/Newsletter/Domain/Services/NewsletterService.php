<?php


namespace App\Magazine\Newsletter\Domain\Services;


use App\Magazine\Newsletter\Domain\Repositories\CampaignRepository;
use App\Magazine\Newsletter\Domain\Repositories\NewsletterRecipientRepository;
use App\Magazine\Newsletter\Exceptions\ConfirmationEmailException;
use App\NewsletterRecipient;
use Illuminate\Support\Facades\Mail;

class NewsletterService
{
    /**
     * @var CampaignRepository
     */
    protected $campaigns;

    /**
     * @var NewsletterRecipientRepository
     */
    protected $recipients;

    public function __construct(CampaignRepository $campaigns, NewsletterRecipientRepository $recipients)
    {
        $this->campaigns = $campaigns;
        $this->recipients = $recipients;
    }

    /**
     * @param $code
     * @return \App\NewsletterRecipient
     */
    public function confirmRecipient($code)
    {
        return $this->recipients->confirm($code);
    }

    public function rejectRecipient($code)
    {
        return $this->recipients->reject($code);
    }

    /**
     * @param NewsletterRecipient $recipient
     * @return NewsletterRecipient
     * @throws ConfirmationEmailException
     */
    public function sendConfirmationMail(NewsletterRecipient $recipient)
    {
        if ($recipient->state != NewsletterRecipient::STATE_CONFIRMATION_PENDING) {
            return $recipient;
        }

        $mailText = view('modules.newsletter::emails.confirmation', $recipient->getAttributes())->render();

        $result = Mail::send([], [], function ($message) use ($recipient, $mailText) {
            $message
                ->to($recipient->email)
                ->subject('Confirm your newsletter')
                ->setBody($mailText, 'text/html');
        });


        if (!$result) {
            throw new ConfirmationEmailException();
        }

        $this->recipients->updateConfirmationText($recipient->id, $mailText);

        return $recipient;

    }
}