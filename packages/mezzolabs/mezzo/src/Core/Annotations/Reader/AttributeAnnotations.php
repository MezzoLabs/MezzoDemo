<?php


namespace MezzoLabs\Mezzo\Core\Annotations\Reader;


use MezzoLabs\Mezzo\Core\Annotations\Attribute as AttributeAnnotation;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Core\Schema\Relations\Relation;
use MezzoLabs\Mezzo\Core\Schema\ValidationRules\Rules;
use MezzoLabs\Mezzo\Exceptions\AnnotationException;

class AttributeAnnotations extends PropertyAnnotations
{
    /**
     * @var InputType
     */
    protected $inputType;

    /**
     * @var Relation
     */
    protected $relation;

    public function isRelation()
    {
        return $this->inputType()->isRelation();
    }

    /**
     * @return InputType
     * @throws \MezzoLabs\Mezzo\Exceptions\InvalidArgumentException
     */
    public function inputType()
    {
        if (!$this->inputType)
            $this->inputType = InputType::make($this->inputTypeString());

        return $this->inputType;
    }

    /**
     * @return string
     */
    public function inputTypeString()
    {
        return $this->attributeAnnotation()->type;
    }

    /**
     * @return AttributeAnnotation
     * @throws AnnotationException
     */
    public function attributeAnnotation()
    {
        return $this->get('Attribute');
    }

    /**
     * @return array
     */
    public function options()
    {
        return [
            'rules' => $this->modelReflection()->rules($this->name()),
            'visible' => !in_array($this->name(), $this->modelReflection()->instance()->getHidden())
        ];
    }

    /**
     * Checks if the given annotations list is correct.
     * @return bool
     * @throws AnnotationException
     */
    protected function validate()
    {
        if (!$this->annotations->have('Attribute')) {
            throw new AnnotationException('A attribute need to have an attribute annotation.');
        }

        return true;
    }

    public function relation(){
        if(!$this->isRelation()) return null;

        if(!$this->relation)
            $this->relation = $this->findRelation();

        return $this->relation;
    }

    /**
     * @return Relation|null
     * @throws AnnotationException
     */
    protected function findRelation(){
        $relationAnnotationsCollection = $this->model()->relationAnnotations();

        $relation = null;

        $relationAnnotationsCollection->each(function(RelationAnnotations $relationAnnotations) use (&$relation){
            if($relationAnnotations->relation()->columns()->has($this->qualifiedColumn())){
                $relation = $relationAnnotations->relation();
            }
        });

        if(!$relation){
            throw new AnnotationException('Cannot find a relation for attribute ' . $this->qualifiedColumn());
        }

        return $relation;
    }
}