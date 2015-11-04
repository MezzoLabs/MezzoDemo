<?php
namespace MezzoLabs\Mezzo\Core\Schema\InputTypes;

use Carbon\Carbon;
use Doctrine\DBAL\Types\Type;

class DateTimeInput extends TextInput
{
    protected $htmlTag = 'input:datetime-local';

    protected $doctrineType = Type::DATETIME;

    protected $variableType = Carbon::class;

}