<?php


namespace MezzoLabs\Mezzo\Cockpit\Html\Rendering;

use Collective\Html\FormBuilder as CollectiveFormBuilder;
use Illuminate\Support\Collection;

class FormBuilder extends CollectiveFormBuilder
{
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
        $options = $this->mergeDefault([
            'class' => 'btn btn-primary btn-block',
            'ng-disabled' => 'vm.form.$invalid'
        ], $options);

        return parent::submit($value, $options);
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
        $options = $this->mergeDefault([
            'name' => "vm.form",
            'novalidate' => 'novalidate',
            'ng-submit' => 'vm.submit()'
        ], $options);

        return parent::open($options);
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
}