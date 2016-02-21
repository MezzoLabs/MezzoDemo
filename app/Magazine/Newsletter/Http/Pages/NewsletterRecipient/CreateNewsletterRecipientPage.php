<?php


namespace App\Magazine\Newsletter\Http\Pages\NewsletterRecipient;


use MezzoLabs\Mezzo\Cockpit\Pages\Resources\CreateResourcePage;

class CreateNewsletterRecipientPage extends CreateResourcePage
{
    public function boot()
    {
        $this->options('visibleInNavigation', false);
        $this->options('enabled', false);
    }
}