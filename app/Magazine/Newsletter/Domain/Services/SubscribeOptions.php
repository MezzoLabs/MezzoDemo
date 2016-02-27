<?php


namespace App\Magazine\Newsletter\Domain\Services;


class SubscribeOptions
{
    public $list;

    /**
     * @var array|\associative_array
     */
    public $email;

    public $merge_vars = null;

    public $email_type = 'html';

    public $double_optin = true;

    public $update_existing = false;

    public $replace_interests = true;

    public $send_welcome = false;

    public function __construct($list, $email)
    {
        $this->list = $list;
        $this->email = ['email' => $email];
    }


}