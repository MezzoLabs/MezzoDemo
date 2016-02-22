<?php


namespace App\Magazine\Newsletter\Campaigns;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

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


}