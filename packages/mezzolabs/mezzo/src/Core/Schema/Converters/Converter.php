<?php

namespace MezzoLabs\Mezzo\Core\Schema\Converters;


use MezzoLabs\Mezzo\Core\Modularisation\Reflection\RelationshipReflection;

abstract class Converter {
    abstract public function run($toConvert);
} 