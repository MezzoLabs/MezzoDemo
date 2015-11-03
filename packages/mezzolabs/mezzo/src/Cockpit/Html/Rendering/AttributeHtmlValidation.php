<?php


namespace MezzoLabs\Mezzo\Cockpit\Html\Rendering;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;

class AttributeHtmlValidation
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

        if ($this->maxLength() > 0)
            $attributes->put('maxlength', $this->maxLength());

        if ($this->minLength() > 0)
            $attributes->put('minLength', $this->minLength());

        if ($rules->isRequired())
            $attributes->put('required', 'required');

        $attributes->put('data-validation-rules', $rules->toString());

        return $attributes;
    }

    /**
     * How many characters are allowed for this attribute.
     *
     * @return int
     * @throws \MezzoLabs\Mezzo\Exceptions\MezzoException
     */
    protected function maxLength()
    {
        if ($this->rules()->has('max'))
            return $this->rules()->get('max')->parameters(0);

        if ($this->rules()->has('between'))
            return $this->rules()->get('between')->parameters(1);


        return 0;
    }

    protected function rules()
    {
        return $this->attribute->rules();
    }

    /**
     * How many characters this attribute should have.
     *
     * @return int
     * @throws \MezzoLabs\Mezzo\Exceptions\MezzoException
     */
    protected function minLength()
    {
        if ($this->rules()->has('min'))
            return $this->rules()->get('min')->parameters(0);

        if ($this->rules()->has('between'))
            return $this->rules()->get('between')->parameters(0);


        return 0;
    }
}