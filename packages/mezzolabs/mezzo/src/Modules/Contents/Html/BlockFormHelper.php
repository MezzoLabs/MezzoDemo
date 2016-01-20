<?php


namespace MezzoLabs\Mezzo\Modules\Contents\Html;


use Collective\Html\HtmlBuilder;
use MezzoLabs\Mezzo\Cockpit\Html\Rendering\FormBuilder;
use MezzoLabs\Mezzo\Cockpit\Html\Rendering\HtmlRules;
use MezzoLabs\Mezzo\Core\Schema\ValidationRules\Rules;
use MezzoLabs\Mezzo\Modules\Contents\Contracts\ContentBlockTypeContract;
use MezzoLabs\Mezzo\Modules\Contents\Contracts\ContentFieldTypeContract;

class BlockFormHelper
{
    /**
     * @var ContentBlockTypeContract
     */
    protected $block;

    /**
     * @var HtmlBuilder
     */
    protected $htmlBuilder;

    /**
     * @var FormBuilder
     */
    private $formBuilder;

    public function __construct(ContentBlockTypeContract $block, FormBuilder $formBuilder)
    {

        $this->block = $block;
        $this->formBuilder = $formBuilder;

        $this->htmlBuilder = app()->make(HtmlBuilder::class);

    }

    public function htmlAttributes(string $fieldName, array $mergeAttributes = [])
    {
        $field = $this->getField($fieldName);

        $mergeAttributes['name'] = $mergeAttributes['name'] ?? $this->block->inputName($fieldName);
        $mergeAttributes['ng-value'] = $mergeAttributes['ng-value'] ?? "block.fields." . $field->name();

        $htmlRules = (new HtmlRules(Rules::makeCollection($field->rulesString()), $field->inputType()))->attributes()->toArray();
        $typeAttributes = $field->inputType()->htmlAttributes();

        $attributes = array_merge($htmlRules, $typeAttributes, $mergeAttributes);

        return $this->htmlBuilder->attributes($attributes);
    }

    protected function getField(string $name) : ContentFieldTypeContract
    {
        return $this->block->fields()->get($name);
    }

    /**
     * @return FormBuilder
     */
    public function formBuilder()
    {
        return $this->formBuilder;
    }

    /**
     * @return HtmlBuilder
     */
    public function htmlBuilder()
    {
        return $this->htmlBuilder;
    }
}