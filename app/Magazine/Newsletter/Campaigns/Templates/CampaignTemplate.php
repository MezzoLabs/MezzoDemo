<?php


namespace App\Magazine\Newsletter\Campaigns\Templates;


use App\Magazine\Newsletter\Domain\Models\Campaign;

abstract class CampaignTemplate
{
    /**
     * @param Campaign $campaign
     * @param $email
     * @param array $mergeData
     * @return string
     */
    abstract public function render(Campaign $campaign, $email, $mergeData = []) : string;
}