<?php


namespace MezzoLabs\Mezzo\Core\Validation;


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
}