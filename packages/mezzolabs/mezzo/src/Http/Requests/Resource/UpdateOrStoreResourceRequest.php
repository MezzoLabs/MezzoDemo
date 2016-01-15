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
            $this->addDefaultData();
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

    public function addDefaultData()
    {
        $newModel = $this->newModelInstance();
        if (!method_exists($newModel, 'defaultCreateData')) {
            return;
        }

        $isUpdate = $this instanceof UpdateResourceRequest;

        if ($isUpdate)
            return;

        $defaultCreateData = array_dot($newModel->defaultCreateData($this->all()));

        foreach ($defaultCreateData as $key => $value) {
            if (!$this->has($key)) {
                $this->offsetSet($key, $value);
            }
        }
    }


    /**
     * Get the validator instance for the request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        //pull the default data in before validation.
        $this->formObject();
        return parent::getValidatorInstance();
    }
}