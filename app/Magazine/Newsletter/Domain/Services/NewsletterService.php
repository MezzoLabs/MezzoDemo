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
        $mailText = view('modules.newsletter::emails.confirmation', $recipient->getAttributes());

        $result = Mail::raw($mailText, function ($message) use ($recipient) {
            $message
                ->to($recipient->email)
                ->subject('Confirm your newsletter');
        });

        if (!$result) {
            throw new ConfirmationEmailException();
        }

        $this->recipients->updateConfirmationText($recipient->id, $mailText);

        return $recipient;

    }
}