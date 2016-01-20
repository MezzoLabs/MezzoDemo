<?php


namespace MezzoLabs\Mezzo\Modules\User\Http\Requests;

use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;

class UpdateUserRequest extends UpdateResourceRequest
{
    use StoresOrUpdatesUser;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();

        return $this->unsetPasswordConfirmationRules($rules);
    }

    public function all()
    {
        $all = parent::all();

        return $all;
    }

}