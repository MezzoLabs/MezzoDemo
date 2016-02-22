<?php


namespace App\Magazine\Newsletter\Domain\Services;


use App\Magazine\Newsletter\Campaigns\DeliveryReport;
use App\Magazine\Newsletter\Campaigns\Templates\CampaignTemplate;
use App\Magazine\Newsletter\Campaigns\Templates\DefaultTemplate;
use App\Magazine\Newsletter\Domain\Models\Campaign;
use App\Magazine\Newsletter\Domain\Repositories\CampaignRepository;
use App\Magazine\Newsletter\Domain\Repositories\NewsletterRecipientRepository;
use App\Magazine\Newsletter\Exceptions\CampaignTemplateException;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class CampaignDeliverer
{
    public static $templates = [
        'default' => DefaultTemplate::class
    ];

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

    public function deliver(Campaign $campaign, $emails = []) : bool
    {
        $deliveryReport = new DeliveryReport();
        $emails = $this->emails($emails);


        $template = $this->makeTemplate($campaign->template);

        mezzo_dd($template);

        $deliveryReport->stop();
        return true;
    }

    /**
     * @param $key
     * @return CampaignTemplate
     * @throws CampaignTemplateException
     */
    public function makeTemplate($key) : CampaignTemplate
    {
        $class = static::$templates[$key];

        if (!$class || class_exists($class)) {
            throw new CampaignTemplateException('Template is invalid or not found.');
        }

        $template = app()->make($class);

        return $template;
    }

    public function emails($overwritingEmails)
    {
        if (!empty($overwritingEmails)) {
            return $overwritingEmails;
        }

        return $this->recipients->confirmedEmails();

    }

    /**
     * @return EloquentCollection
     */
    public function recipients()
    {
        return $this->recipients->query()->confirmedOnly()->get();
    }
}