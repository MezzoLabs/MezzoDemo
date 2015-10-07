<?php
namespace MezzoLabs\Mezzo\Core\Schema\InputTypes;

use Carbon\Carbon;
use Doctrine\DBAL\Types\Type;

class TextInput extends SimpleInput
{
    protected $doctrineType = Type::DATETIME;

    protected $variableType = Carbon::class;

}