<?php


namespace App\Magazine\Newsletter\Campaigns;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class DeliveryReport
{
    /**
     * @var EloquentCollection
     */
    public $recipients;

    /**
     * @var Carbon
     */
    public $start;

    /**
     * @var Carbon
     */
    public $end;

    /**
     * @var Collection
     */
    public $failedRecipients;

    /**
     * @var Collection
     */
    public $emails = [];

    public function __construct()
    {
        $this->setStart(Carbon::now());
    }

    /**
     * @param EloquentCollection $recipients
     * @return DeliveryReport
     */
    public function setRecipients($recipients)
    {
        $this->recipients = $recipients;
        return $this;
    }

    /**
     * @return EloquentCollection
     */
    public function recipients()
    {
        return $this->recipients;
    }

    /**
     * @param Carbon $start
     * @return DeliveryReport
     */
    public function setStart($start)
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @param Carbon $end
     * @return DeliveryReport
     */
    public function setEnd($end)
    {
        $this->end = $end;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function start()
    {
        return $this->start;
    }

    /**
     * @return Carbon
     */
    public function end()
    {
        return $this->end;
    }

    /**
     * @return bool|\DateInterval
     */
    public function duration()
    {
        return $this->end()->diff($this->start());
    }

    /**
     * @return string
     */
    public function durationForHumans()
    {
        return $this->end()->diffForHumans($this->start());
    }

    public function stop()
    {
        return $this->setEnd(Carbon::now());
    }

    /**
     * @param array $failedRecipients
     * @return $this
     */
    public function setFailedRecipients($failedRecipients)
    {
        $this->failedRecipients = new Collection($failedRecipients);

        return $this;
    }

    /**
     * @param array $emails
     * @return $this
     */
    public function setEmails($emails)
    {
        $this->emails = new Collection($emails);
        return $this;
    }

    /**
     * @return Collection
     */
    public function successfulEmails()
    {
        return $this->emails->filter(function ($email) {
            return !$this->failedRecipients->has($email);
        });
    }


}