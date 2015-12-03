<?php


namespace MezzoLabs\Mezzo\Modules\General\Options;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput;

class OptionField
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Collection
     */
    protected $settings;

    private $default = [
        'rules' => 'required',
        'inputType' => TextInput::class
    ];

    /**
     * @param string $name
     * @param array|Collection $settings
     */
    public function __construct($name, $settings = [])
    {
        $this->name = $name;
        $this->settings = (new Collection($this->default))->merge($settings);
    }

    /**
     * @return Collection
     */
    public function settings()
    {
        return $this->settings;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Returns the rules string
     *
     * @return string
     */
    public function rules()
    {
        return $this->settings->get('rules');
    }

    /**
     * Returns an instance of the input type.
     *
     * @return InputType
     */
    public function inputType()
    {
        return app()->make($this->settings->inputType());
    }

}