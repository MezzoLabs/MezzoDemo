<?php


namespace App\Magazine\Newsletter\Domain\Services;


use Mailchimp;

class NewsletterService
{
    /**
     * @var Mailchimp
     */
    protected $mailchimp;


    /**
     * @var string
     */
    protected $listId;

    /**
     * Pull the Mailchimp-instance (including API-key) from the IoC-container.
     * @param Mailchimp $mailchimp
     */
    public function __construct(Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
        $this->listId = env('MAILCHIMP_LIST', '123123');
    }

    /**
     * Access the mailchimp lists API
     */
    public function addEmailToList($email, $data = [])
    {
        $options = new SubscribeOptions($this->listId, $email);

        $options->merge_vars = $data;
        $options->double_optin = false;
        $options->update_existing = true;
        $options->send_welcome = true;

        $this->mailchimp->lists
            ->subscribe(
                $options->list,
                $options->email,
                $options->merge_vars,
                $options->email_type,
                $options->double_optin,
                $options->update_existing,
                $options->replace_interests,
                $options->send_welcome

            );
    }

}