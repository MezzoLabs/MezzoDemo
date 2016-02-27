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
     * @return NewsletterRecipient
     * @throws \MezzoLabs\Mezzo\Exceptions\RepositoryException
     */
    public function registerEmail($email)
    {
        $existing = $this->findByEmail($email);

        if ($existing) {
            return $existing;
        }

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

        $recipient->state = NewsletterRecipient::STATE_REJECTED;

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

    /**
     * @param $email
     * @return NewsletterRecipient
     */
    public function findByEmail($email)
    {
        return $this->findBy('email', $email);
    }

    public function updateConfirmationText($id, $emailText)
    {
        return $this->update([
            'confirmation_text' => $emailText
        ], $id);
    }

    /**
     * @param \App\User $user
     * @return NewsletterRecipient
     */
    public function createFromUser(\App\User $user)
    {
        return $this->registerEmail($user->email);
    }

    public function confirmedEmails()
    {
        return $this->where('state', '=', NewsletterRecipient::STATE_CONFIRMED)->get()->pluck('email');
    }


}