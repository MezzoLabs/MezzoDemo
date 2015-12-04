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

    public function title()
    {
        if(!$this->settings()->has('title'))
            return ucfirst(str_replace('.', ' ', $this->name));

        return $this->settings()->get('title');
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
        return app()->make($this->settings->get('inputType'));
    }

    public function value()
    {
        return $this->options()->get($this->name());
    }

    /**
     * @return OptionsService
     */
    protected function options()
    {
        return app()->make(OptionsService::class);
    }


    public static function makeFromArray($name, array $settingsArray)
    {
        return new static($name, $settingsArray);
    }
}