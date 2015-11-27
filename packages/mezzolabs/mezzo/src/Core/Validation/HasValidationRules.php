<?php


namespace MezzoLabs\Mezzo\Core\Validation;
use MezzoLabs\Mezzo\Http\Requests\Request;

/**
 * Class HasValidationRules
 * @package MezzoLabs\Mezzo\Core\Validation
 *
 * @property array $rules
 */
trait HasValidationRules
{

    public static function bootHasValidationRules()
    {
        static::saving(\MezzoLabs\Mezzo\Core\Validation\Validator::class . '@onSaving');
        static::deleting(\MezzoLabs\Mezzo\Core\Validation\Validator::class . '@onDeleting');
    }


    public function validateOrFail($data = [], $mode = "create")
    {
        if($mode == "create")
            return $this->validateCreate($data, true);

        return $this->validateUpdate($data, true);
    }

    public function validateCreate($data = [], $orFail = true)
    {
        return $this->validateWithRules($data, $this->getRules(), $orFail);
    }

    /**
     * @param array $data
     * @param array $rules
     * @param bool $orFail
     * @return \Illuminate\Validation\Validator
     * @throws ModelValidationFailedException
     */
    public function validateWithRules($data = [], $rules = [], $orFail = true)
    {
        $validator = $this->validator($data, $rules);

        if($orFail && $validator->fails()){
            throw new ModelValidationFailedException($this, $validator);
        }

        return $validator;
    }

    private function defaultData()
    {
        return Request::allInput();
    }

    /**
     * Create a new Validator instance.
     *
     * @param  array $data
     * @param  array $rules
     * @param  array $messages
     * @param  array $customAttributes
     * @return \Illuminate\Validation\Validator
     */
    protected function validator(array $data, array $rules, array $messages = [], array $customAttributes = [])
    {
        $factory = app()->make(\Illuminate\Validation\Factory::class);

        return $factory->make($data, $rules, $messages, $customAttributes);
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }

    public function validateUpdate($data = [], $orFail = true)
    {
        return $this->validateWithRules($data, $this->getUpdateRules($data), $orFail);
    }

    /**
     * Remove "required" rules for partially updates.
     *
     * @param array $data
     * @return array
     */
    public function getUpdateRules(array $data)
    {
        $changingColumns = array_keys($data);
        $unchangingColumns = array_diff(array_keys($this->getRules()), $changingColumns);

        $rules = Validator::removeRequiredRules($this->getRules(), $unchangingColumns);
        $rules = Validator::removeUniqueRules($rules, $unchangingColumns);

        return $rules;
    }

}