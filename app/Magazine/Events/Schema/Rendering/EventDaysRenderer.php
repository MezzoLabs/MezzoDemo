<?php


namespace App\Magazine\Events\Schema\Rendering;


use App\Magazine\Events\Schema\InputTypes\EventDaysInput;
use Carbon\Carbon;
use MezzoLabs\Mezzo\Core\Helpers\StringHelper;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderingHandler;

class EventDaysRenderer extends AttributeRenderingHandler
{

    /**
     * Checks if this handler is responsible for rendering this kind of input.
     *
     * @param InputType $inputType
     * @return boolean
     */
    public function handles(InputType $inputType)
    {
        return $inputType instanceof EventDaysInput;
    }

    /**
     * Render the attribute to HTML.
     *
     * @return string
     */
    public function render()
    {
        return view('modules.events::event_days_input', ['renderer' => $this]);
    }

    public function dateTimeLocal($date)
    {
        return StringHelper::datetimeLocal($date);
    }

    /**
     * @return string
     */
    public function eventStart()
    {
        Carbon::setLocale('de');

        if(!$this->event()) return "-";

        return $this->event()->start()->formatLocalized('%A %d.%B.%Y %H:%M');
    }

    /**
     * @return string
     */
    public function eventEnd()
    {
        if(!$this->event()) return "-";

        return $this->event()->end()->formatLocalized('%A %d.%B.%Y %H:%M');
    }

    /**
     * @return \App\Event|null
     */
    public function event()
    {
        return $this->modelInstance();
    }
}