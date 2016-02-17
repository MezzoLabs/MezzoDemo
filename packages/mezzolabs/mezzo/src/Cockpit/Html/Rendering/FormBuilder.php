<?php


namespace MezzoLabs\Mezzo\Cockpit\Html\Rendering;

use Collective\Html\FormBuilder as CollectiveFormBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use MezzoLabs\Mezzo\Cockpit\Html\Rendering\Inputs\InputRenderer;
use MezzoLabs\Mezzo\Core\Helpers\StringHelper;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;
use MezzoLabs\Mezzo\Modules\General\Options\OptionField;

class FormBuilder extends CollectiveFormBuilder
{
    use HasAngularDirectives;

    protected $formGroupName = null;

    protected $formOptions = [];

    /**
     * Create a submit button element.
     *
     * @param  string $value
     * @param  array $options
     *
     * @return string
     */
    public function submit($value = null, $options = [])
    {
        $ngFormName = $this->formOptions['name'] ?? 'vm.form';

        $options = $this->mergeDefault([
            'class' => 'btn btn-primary btn-block',
            'ng-class' => 'vm.submitButtonClass(' . $ngFormName . ')'
        ], $options);

        return parent::submit($value, $options);
    }

    public function submitEdit(MezzoModelReflection $model_reflection, $value = false)
    {
        $value = ($value !== false) ? $value : Lang::get('mezzo.general.edit_model', ['name' => $model_reflection->title()]);

        $options = [];

        return $this->submit($value, $options);
    }

    public function submitCreate(MezzoModelReflection $model_reflection, $value = false)
    {
        $value = ($value !== false) ? $value : Lang::get('mezzo.general.create_model', ['name' => $model_reflection->title()]);

        $options = [];

        if (!$model_reflection->canBeCreatedBy()) {
            $options['disabled'] = 'disabled';
        }

        return $this->submit($value, $options);
    }

    /**
     * @param $default
     * @param $options
     * @return array
     */
    protected function mergeDefault($default, $options)
    {
        $default = new Collection($default);
        $options = new Collection($options);

        return $default->merge($options)->toArray();
    }

    /**
     * Open up a new HTML form.
     *
     * @param  array $options
     *
     * @return string
     */
    public function open(array $options = [])
    {
        $this->formOptions = $options;

        if ($options['angular'] ?? false) {
            $ngFormName = $options['name'] ?? 'vm.form';
            return '<form name="' . $ngFormName . '" novalidate="novalidate" ng-submit="vm.submit($event, ' . $ngFormName . ')" data-mezzo-form-validation>';
        }

        return parent::open($options);
    }

    /**
     * Create a text input field.
     *
     * @param  string $name
     * @param  string $value
     * @param  array $options
     *
     * @return string
     */
    public function text($name, $value = null, $options = [])
    {
        return parent::text($name, $value, $options);
    }

    /**
     * Create an e-mail input field.
     *
     * @param  string $name
     * @param  string $value
     * @param  array $options
     *
     * @return string
     */
    public function email($name, $value = null, $options = [])
    {
        return parent::email($name, $value, $options);
    }

    /**
     * Create a time input field.
     *
     * @param  string $name
     * @param  string $value
     * @param  array $options
     *
     * @return string
     */
    public function time($name, $value = null, $options = [])
    {
        return parent::time($name, $value, $options);
    }

    /**
     * Create a file input field.
     *
     * @param  string $name
     * @param  array $options
     *
     * @return string
     */
    public function file($name, $options = [])
    {
        return parent::file($name, $options); // TODO: Change the autogenerated stub
    }

    /**
     * Create a textarea input field.
     *
     * @param  string $name
     * @param  string $value
     * @param  array $options
     *
     * @return string
     */
    public function textarea($name, $value = null, $options = [])
    {
        return parent::textarea($name, $value, $options);
    }

    /**
     * Create a button element.
     *
     * @param  string $value
     * @param  array $options
     *
     * @return string
     */
    public function button($value = null, $options = [])
    {
        return parent::button($value, $options);
    }


    /**
     * Create a form input field.
     *
     * @param  string $type
     * @param  string $name
     * @param  string $value
     * @param  array $options
     *
     * @return string
     */
    public function input($type, $name, $value = null, $options = [])
    {
        if (!isset($options['class']) && !in_array($type, ["hidden", "checkbox"]))
            $options['class'] = 'form-control';

        return parent::input($type, $name, $value, $options);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function hasModel()
    {
        return !empty($this->model);
    }

    public function openNestedRelation(RelationAttribute $attribute)
    {
        $ids = $this->nestedRelationIds($attribute->relationSide()->naming());

        $openingTag = "<div class=\"nested-relation\">";
        $openingTag .= $this->hiddenIdFields($attribute->relationSide()->naming(), $ids);

        return $openingTag;
    }

    protected function hiddenIdFields($naming, $ids)
    {
        if (empty($ids))
            return "";

        if (!is_array($ids))
            return $this->hidden($naming . '[id]', $ids);

        $html = "";

        $index = 0;
        foreach ($ids as $id) {
            $html .= $this->hidden($naming . '[' . $index . '][id]', $id);
            $index++;
        }

        return $html;
    }

    protected function nestedRelationIds($naming)
    {
        if (!$this->hasModel())
            return null;

        $attributeValue = $this->getModel()->getAttribute($naming);


        if (!$attributeValue instanceof EloquentCollection)
            return $attributeValue->id;


        return $attributeValue->pluck('id')->toArray();
    }

    public function closeNestedRelation()
    {
        return "</div>";
    }

    /**
     * Get the model value that should be assigned to the field.
     *
     * @param  string $name
     *
     * @return mixed
     */
    protected function getModelValueAttribute($name)
    {
        return parent::getModelValueAttribute($name);
    }

    public function optionField(OptionField $field)
    {
        $settings = $field->settings();

        if (!empty($field->value()))
            $settings->put('value', $field->value());

        return $this->inputField('options[' . $field->name() . ']', $field->inputType(), $field->settings());
    }

    public function inputField($name, $inputType = null, $settings = [])
    {
        if (is_string($inputType)) {
            $inputType = app()->make($inputType);
        }

        return (new InputRenderer($name, $inputType, $settings))->render();
    }

    public function formGroupOpen($name)
    {
        $this->formGroupName = $name;

        $class = 'form-group';
        if ($this->hasError($name)) $class .= ' has-error';

        $html = '<div class="' . $class . '">';

        return $html;
    }

    public function formGroupClose()
    {
        $html = '</div>';

        if ($this->hasError($this->formGroupName)) {
            $html = '<span class="help-block">' . $this->getError($this->formGroupName)[0] . '</span>' . $html;
        }


        $this->formGroupName = null;

        return $html;

    }

    protected function hasError($name)
    {
        $sessionName = StringHelper::fromArrayToDotNotation($name);
        return (Session::has('errors') && Session::get('errors')->has($sessionName));
    }

    protected function getError($name)
    {
        $sessionName = StringHelper::fromArrayToDotNotation($name);
        return Session::get('errors')->get($sessionName);
    }

    public function attributes($model, $attribute)
    {
        $attribute = mezzo()->attribute($model, $attribute);
        $htmlRules = (new HtmlRules($attribute->rules(), $attribute->type()))->attributes()->toArray();

        return $this->html->attributes($htmlRules);
    }

    public function title($model, $attribute)
    {
        $attribute = mezzo()->attribute($model, $attribute);
        return $attribute->title();
    }

}