<?php


namespace MezzoLabs\Mezzo\Http\Requests\Resource;


use Mezzolabs\Mezzo\Cockpit\Http\FormObjects\FormObject;
use Mezzolabs\Mezzo\Cockpit\Http\FormObjects\GenericFormObject;

abstract class UpdateOrStoreResourceRequest extends ResourceRequest
{

    /**
     * @var FormObject
     */
    private $formObject = null;



    /**
     * Creates a form object for the current resource request.
     *
     * @return FormObject|GenericFormObject
     */
    public function formObject()
    {
        if (!$this->formObject) {
            $this->formObject = $this->makeFormObject();
            $this->formObject->setId($this->getId());
        }

        return $this->formObject;
    }

    protected function makeFormObject()
    {
        return new GenericFormObject($this->modelReflection(), $this->all());
    }

    /**
     * @return \Mezzolabs\Mezzo\Cockpit\Http\FormObjects\NestedRelations
     */
    public function nestedRelations()
    {
        return $this->formObject()->nestedRelations();
    }

    public function hasNestedRelations()
    {
        return !$this->nestedRelations()->isEmpty();
    }
}