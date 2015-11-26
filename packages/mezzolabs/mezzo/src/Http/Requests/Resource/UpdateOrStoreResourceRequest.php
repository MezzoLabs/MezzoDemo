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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->modelReflection()->rules();
    }

    /**
     * Creates a form object for the current resource request.
     *
     * @return FormObject|GenericFormObject
     */
    public function formObject()
    {
        if (!$this->formObject) {
            $this->formObject = new GenericFormObject($this->modelReflection(), $this->all());
        }

        return $this->formObject;
    }
}