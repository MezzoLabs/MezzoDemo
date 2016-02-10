<?php


namespace App\Magazine\Shop\Html\Rendering;


use App\Magazine\Shop\Schema\InputTypes\VoucherOptionsInput;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderingHandler;

class VoucherOptionsRenderer extends AttributeRenderingHandler
{

    /**
     * Checks if this handler is responsible for rendering this kind of input.
     *
     * @param InputType $inputType
     * @return boolean
     */
    public function handles(InputType $inputType)
    {
        return $inputType instanceof VoucherOptionsInput;
    }

    /**
     * Render the attribute to HTML.
     *
     * @return string
     */
    public function render()
    {
        return $this->view('modules.shop::inputs.voucheroptions');
    }

    public function before() : string
    {
        return "";
    }

    public function after() : string
    {
        return "";
    }

}