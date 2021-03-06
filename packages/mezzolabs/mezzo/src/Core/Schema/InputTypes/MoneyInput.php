<?php
namespace MezzoLabs\Mezzo\Core\Schema\InputTypes;

use Doctrine\DBAL\Types\Type;

class MoneyInput extends NumberInput
{
    /**
     * @var string
     */
    protected $doctrineType = Type::FLOAT;

    protected $htmlTag = "input:number";

    protected $htmlAttributes = [
        'step' => '0.01'
    ];


}