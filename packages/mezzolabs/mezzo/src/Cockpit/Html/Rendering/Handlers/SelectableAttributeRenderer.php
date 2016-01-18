<?php


namespace Mezzolabs\Mezzo\Cockpit\Html\Rendering\Handlers;

use Illuminate\Support\Facades\Lang;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\SelectInput;
use MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderingHandler;

class SelectableAttributeRenderer extends AttributeRenderingHandler
{

    /**
     * Checks if this handler is responsible for rendering this kind of input.
     *
     * @param InputType $inputType
     * @return boolean
     */
    public function handles(InputType $inputType)
    {
        return $inputType instanceof SelectInput;
    }

    /**
     * Render the attribute to HTML.
     *
     * @return string
     */
    public function render()
    {
        $list = $this->makeListFromRules();

        return $this->formBuilder()->select($this->name(), $list, $this->value(), $this->htmlAttributes());
    }

    protected function makeListFromRules()
    {
        if (!$this->attribute()->hasRules() || !$this->attribute()->rules()->has('in'))
            return [];

        $list = [];
        foreach ($this->attribute()->rules()->get('in')->parameters() as $key) {
            $title = ucfirst($key);

            $langKey = 'mezzo.selects.' . $this->name() . '.' . $key;

            if (Lang::has($langKey))
                $title = Lang::get($langKey);

            $list[$key] = $title;
        }

        return $list;
    }


}