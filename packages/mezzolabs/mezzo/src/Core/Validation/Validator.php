<?php


namespace MezzoLabs\Mezzo\Core\Validation;


use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoModel;
use MezzoLabs\Mezzo\Core\Permission\PermissionGuard;

class Validator
{
    /**
     * Create a new Validator instance.
     *
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return \Illuminate\Validation\Validator
     * @static
     */
    public static function make($data, $rules, $messages = array(), $customAttributes = array())
    {
        return \Illuminate\Support\Facades\Validator::make($data, $rules, $messages, $customAttributes);
    }

    /**
     * @param $rulesArray
     * @return array
     */
    public static function removeRequiredRules($rulesArray, array $forColumns = [])
    {
        return static::removeRulesType('required', $rulesArray, $forColumns);
    }

    public static function removeUniqueRules($rulesArray, array $forColumns = [])
    {
        return static::removeRulesType('unique', $rulesArray, $forColumns);
    }

    /**
     * @param $ruleType
     * @param array $rulesArray
     * @param array $forColumns
     * @return array
     */
    protected static function removeRulesType($ruleType, array $rulesArray, array $forColumns = [])
    {
        $updateRules = [];
        foreach ($rulesArray as $column => &$rule) {
            if (!in_array($column, $forColumns)) {
                $updateRules[$column] = $rule;
                continue;
            }

            $changedRule = preg_replace("/(" . $ruleType . "[^|]*)/", "", $rule);
            $changedRule = trim(str_replace('||', '', $changedRule), '|');

            $updateRules[$column] = $changedRule;
        }

        return $updateRules;
    }

    public function onSaving(MezzoModel $model)
    {
        if (!$this->permissionGuard()->allowsCreateOrEdit($model))
            $this->permissionGuard()->fail('Failed on the second level.');

        if (!$model->exists) {
            $model->validateOrFail($model->getAttributes(), 'create');
            return;
        }

        $model->validateOrFail($model->getDirty(), 'update');
        return;

    }

    public function onDeleting(MezzoModel $model)
    {
        if (!$this->permissionGuard()->allowsDelete($model))
            $this->permissionGuard()->fail('Failed on the second level.');

        return true;
    }

    public function permissionGuard()
    {
        return PermissionGuard::make();
    }

}