<?php


namespace App\Magazine\Subscriptions\Html\Rendering;


use App\Magazine\Subscriptions\Schema\SubscriptionInput;
use Mezzolabs\Mezzo\Cockpit\Html\Rendering\Handlers\RelationAttributeMultipleRenderer;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;

class SubscriptionsAttributeRenderer extends RelationAttributeMultipleRenderer
{
    /**
     * Checks if this handler is responsible for rendering this kind of input.
     *
     * @param InputType $inputType
     * @return boolean
     */
    public function handles(InputType $inputType)
    {
        return $inputType instanceof SubscriptionInput;
    }

    /**
     * Render the attribute to HTML.
     *
     * @param array $options
     * @return string
     * @throws \MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderingException
     */
    public function render(array $options = [])
    {
        return $this->view('modules.subscriptions::subscription_nested_form', [

        ]);
    }

    public function before() : string
    {
        return '';
    }

    public function after() : string
    {
        return "";
    }
}