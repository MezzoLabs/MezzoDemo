<?php


namespace MezzoLabs\Mezzo\Core\Schema\Converters\Annotations;


use MezzoLabs\Mezzo\Core\Annotations\Reader\ModelAnnotations;
use MezzoLabs\Mezzo\Core\Schema\Converters\ModelConverter;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;

class ModelAnnotationsConverter extends ModelConverter
{

    /**
     * @param $toConvert
     * @return ModelSchema
     */
    public function run($toConvert)
    {
        return $this->fromModelAnnotations($toConvert);
    }

    /**
     * @param ModelAnnotations $modelAnnotations
     * @return ModelSchema
     */
    public function fromModelAnnotations(ModelAnnotations $modelAnnotations)
    {

    }
}