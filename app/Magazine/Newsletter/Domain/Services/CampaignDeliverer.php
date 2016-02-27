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
use Illuminate\Mail\Message as IlluminateMessage;
use Illuminate\Support\Collection;
use Swift_Mailer;
use Swift_Message;

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

    /**
     * @var Swift_Mailer
     */
    private $swift;

    /**
     * @var array
     */
    protected $failedRecipients = [];




    public function __construct(CampaignRepository $campaigns, NewsletterRecipientRepository $recipients)
    {
        $this->campaigns = $campaigns;
        $this->recipients = $recipients;
        $this->swift = app('swift.mailer');
    }

    public function deliver(Campaign $campaign, $emails = []) : DeliveryReport
    {
        $deliveryReport = new DeliveryReport();
        $emails = $this->emails($emails);

        $template = $this->makeTemplate($campaign->template);

        $emails->each(function ($email) use ($template, $campaign) {
            $this->deliverTemplateTo($template, $campaign, $email);
        });

        $deliveryReport
            ->setEmails($emails)
            ->setFailedRecipients($this->failedRecipients);

        $deliveryReport->stop();
        return $deliveryReport;
    }

    protected function deliverTemplateTo(CampaignTemplate $template, Campaign $campaign, $email)
    {
        $message = new IlluminateMessage(new Swift_Message);
        $message->subject($campaign->title);
        $message->from($this->fromAddress(), $this->fromName());
        $message->to($email);

        $content = $template->render($campaign, $email, ['message' => $message]);

        $message->setBody($content, 'text/html');

        $failedRecipients = [];
        $this->swift->send($message->getSwiftMessage(), $failedRecipients);

        $this->failedRecipients = array_merge($this->failedRecipients, $failedRecipients);
    }

    public function fromAddress()
    {
        return 'mail@example.org';
    }

    public function fromName()
    {
        return 'John Doe';
    }

    /**
     * @param $key
     * @return CampaignTemplate
     * @throws CampaignTemplateException
     */
    protected function makeTemplate($key) : CampaignTemplate
    {
        $class = static::$templates[$key];


        if (!$class || !class_exists($class)) {
            throw new CampaignTemplateException('Template is invalid or not found.');
        }

        $template = app()->make($class);

        return $template;
    }

    protected function emails($overwritingEmails) : Collection
    {
        if (!empty($overwritingEmails)) {
            return new Collection($overwritingEmails);
        }

        return $this->recipients->confirmedEmails();

    }

    /**
     * @return EloquentCollection
     */
    protected function recipients()
    {
        return $this->recipients->query()->confirmedOnly()->get();
    }
}