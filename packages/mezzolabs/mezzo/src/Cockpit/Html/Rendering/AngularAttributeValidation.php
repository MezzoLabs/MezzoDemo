<?php


namespace MezzoLabs\Mezzo\Cockpit\Html\Rendering;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;

class AngularAttributeValidation
{
    /**
     * @var Attribute
     */
    protected $attribute;

    public function __construct(Attribute $attribute)
    {

        $this->attribute = $attribute;
    }

    /**
     * @return Collection
     */
    public function htmlAttributes()
    {
        $attributes = new Collection();

        $rules = $this->attribute->rules();

        if($rules->isRequired())
            $attributes->put('required', 'required');

        return $attributes;
    }
}