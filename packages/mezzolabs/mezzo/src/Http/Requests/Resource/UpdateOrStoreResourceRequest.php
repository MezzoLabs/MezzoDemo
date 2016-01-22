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
        if (!method_exists($newModel, 'defaultData')) {
            return;
        }

        $isUpdate = $this instanceof UpdateResourceRequest;
        $overwriteData = array_dot($newModel->defaultData($this->all()));


        foreach ($overwriteData as $key => $value) {

            //Only set the default data on a update request when the key is not set
            if ($isUpdate && ($this->has($key) && empty($this->get($key))) ) {
                $this->offsetSet($key, $value);
                continue;
            }

            //Do Always set the default data on a store request
            if (!$isUpdate && (!$this->has($key) || empty($this->get($key))) ) {
                $this->offsetSet($key, $value);
                continue;
            }
        }


    }


    /**
     * Get the validator instance for the request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected
    function getValidatorInstance()
    {
        //pull the default data in before validation.
        $this->formObject();
        return parent::getValidatorInstance();
    }
}