<?php


namespace MezzoLabs\Mezzo\Http\Requests\Resource;


class UpdateResourceRequest extends UpdateOrStoreResourceRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();

        /**
         * Remove "required" rules for partially updates.
         */
        foreach($rules as &$rule){
            $rule = str_replace(['required|', 'required'], '', $rule);
        }

        return $rules;
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}