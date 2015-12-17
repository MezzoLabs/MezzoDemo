<?php

namespace MezzoLabs\Mezzo\Cockpit\Html\Rendering;


use Collective\Html\HtmlBuilder;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;

/**
 * Class HasAngularDirectives
 * @package MezzoLabs\Mezzo\Cockpit\Html\Rendering
 *
 * @property HtmlBuilder $html
 */
trait HasAngularDirectives
{
    public function relationship(RelationAttribute $attribute)
    {
        $htmlAttributes = [
            'data-multiple' => $attribute->hasMultipleChildren() ? 1 : 0,
            'data-related' => $attribute->getModel()->shortName()
        ];

        $validationRules = (new HtmlRules($attribute->rules()))->attributes()->toArray();

        $htmlAttributes = array_merge($htmlAttributes, $validationRules);

        return '<mezzo-input-relation ' . $this->html->attributes($htmlAttributes) . '></mezzo-input-relation>';
    }
}