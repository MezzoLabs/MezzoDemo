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
     * Called whenever a model with validation rules is updated or created.
     *
     * @param MezzoModel|HasValidationRules $model
     */
    public function onSaving(MezzoModel $model)
    {
        if ($model->permissionsPaused()) {
            return;
        }

        if (!$this->permissionGuard()->allowsCreateOrEdit($model))
            $this->permissionGuard()->fail('Failed on the second level.');

        if (!$model->exists) {
            $model->validateOrFail($model->getAttributes(), 'create');
            return;
        }

        $model->validateOrFail($model->getDirty(), 'update');
        return;

    }

    /**
     * Called whenever a model with validation rules is deleted.
     *
     * @param MezzoModel|HasValidationRules $model
     * @return bool|void
     */
    public function onDeleting(MezzoModel $model)
    {
        if ($model->permissionsPaused()) {
            return true;
        }

        if (!$this->permissionGuard()->allowsDelete($model))
            $this->permissionGuard()->fail('Failed on the second level.');

        return true;
    }

    public function permissionGuard()
    {
        return PermissionGuard::make();
    }

}