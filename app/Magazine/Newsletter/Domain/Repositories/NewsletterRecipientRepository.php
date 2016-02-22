<?php


namespace App\Magazine\Newsletter\Domain\Repositories;


use App\Magazine\Newsletter\Exceptions\BlacklistedRecipientException;
use App\NewsletterRecipient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;

class NewsletterRecipientRepository extends ModelRepository
{
    /**
     * @param $email
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \MezzoLabs\Mezzo\Exceptions\RepositoryException
     */
    public function registerEmail($email)
    {
        return $this->create([
            'email' => $email,
            'state' => NewsletterRecipient::STATE_CONFIRMATION_PENDING,
            'ip_address' => Request::ip(),
            'confirmation_code' => str_random(30),
            'confirmation_text' => '',
            'confirmed_at' => null
        ]);
    }

    /**
     * @param $code
     * @return NewsletterRecipient
     * @throws BlacklistedRecipientException
     */
    public function confirm($code)
    {
        $recipient = $this->findByCodeOrFail($code);

        if ($recipient->state == NewsletterRecipient::STATE_BLACKLISTED) {
            throw new BlacklistedRecipientException('Cannot confirm a blacklisted recipient.');
        }

        $recipient->state = NewsletterRecipient::STATE_CONFIRMED;
        $recipient->ip_address = Request::ip();
        $recipient->confirmed_at = Carbon::now();

        $recipient->save();

        return $recipient;
    }

    /**
     * @param $code
     * @return NewsletterRecipient
     * @throws BlacklistedRecipientException
     */
    public function reject($code)
    {
        $recipient = $this->findByCodeOrFail($code);

        if ($recipient->state == NewsletterRecipient::STATE_BLACKLISTED) {
            throw new BlacklistedRecipientException('Cannot reject a blacklisted recipient.');
        }

        $recipient->state = NewsletterRecipient::STATE_BLACKLISTED;
        $recipient->confirmed_at = null;

        $recipient->save();

        return $recipient;
    }

    /**
     * @param $code
     * @return NewsletterRecipient
     */
    public function findByCodeOrFail($code)
    {
        return $this->findByOrFail('confirmation_code', $code);
    }

    public function updateConfirmationText($id, $emailText)
    {
        return $this->update([
            'confirmation_text' => $emailText
        ], $id);
    }


}