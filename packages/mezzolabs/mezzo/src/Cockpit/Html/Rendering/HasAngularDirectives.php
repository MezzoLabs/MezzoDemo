<?php

namespace MezzoLabs\Mezzo\Cockpit\Html\Rendering;


use Collective\Html\HtmlBuilder;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;
use MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderingException;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\TypedFiles\TypedFileAddon;

/**
 * Class HasAngularDirectives
 * @package MezzoLabs\Mezzo\Cockpit\Html\Rendering
 *
 * @property HtmlBuilder $html
 */
trait HasAngularDirectives
{
    /**
     * @param RelationAttribute $attribute
     * @return string
     */
    public function relationship(RelationAttribute $attribute) : string
    {
        $htmlAttributes = [
            'data-related' => $attribute->relationSide()->otherModelReflection()->name(),
            'name' => $attribute->name()
        ];

        if ($attribute->hasMultipleChildren()) $htmlAttributes[] = 'multiple';

        $validationRules = (new HtmlRules($attribute->rules()))->attributes()->toArray();

        $htmlAttributes = array_merge($htmlAttributes, $validationRules);

        return '<mezzo-relation-input ' . $this->html->attributes($htmlAttributes) . '></mezzo-relation-input>';
    }

    /**
     * @param string $name
     * @param bool $multiple
     * @param string $fileType
     * @return string
     */
    public function filePicker(RelationAttribute $attribute) : string
    {
        $fileTypeModel = $attribute->otherModelReflection()->instance();

        if (!$fileTypeModel instanceof TypedFileAddon)
            throw new AttributeRenderingException('Invalid image model');

        $htmlAttributes = [
            'data-file-type' => $fileTypeModel->fileType()->name(),
            'name' => $attribute->name()
        ];

        if ($attribute->hasMultipleChildren()) $htmlAttributes[] = 'multiple';


        $validationRules = (new HtmlRules($attribute->rules()))->attributes()->toArray();
        $htmlAttributes = array_merge($htmlAttributes, $validationRules);
        $htmlAttributesString = $this->html->attributes($htmlAttributes);

        return "<mezzo-file-picker {$htmlAttributesString}></mezzo-file-picker>";
    }
}