<?php

namespace App;

use App\Magazine\Newsletter\Domain\Models\Campaign as NewsletterModuleCampaign;

class Campaign extends NewsletterModuleCampaign
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
