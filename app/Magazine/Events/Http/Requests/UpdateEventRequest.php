<?php


namespace App\Magazine\Events\Http\Requests;


use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;

class UpdateEventRequest extends UpdateResourceRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();

        foreach ($rules as $key => $string) {
            $isEndDate = preg_match('@^(days\.\d+\.)end$@', $key, $matches);

            if($isEndDate)
                $rules[$key] = str_replace('after:start', 'after:' .$matches[1] . 'start', $string);
        }

        return $rules;
    }

    public function validate()
    {
        //$this->validateDaysNotOverlapping($this->get('days'), []);

        parent::validate();
    }
}