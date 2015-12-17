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
            'multiple' => $attribute->hasMultipleChildren() ? 1 : 0,
            'related' => $attribute->getModel()->className()
        ];

        return '<mezzo-input-relation ' . $this->html->attributes($htmlAttributes) . '></mezzo-input-relation>';
    }
}