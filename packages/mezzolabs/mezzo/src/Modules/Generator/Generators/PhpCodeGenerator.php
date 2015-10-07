<?php


namespace MezzoLabs\Mezzo\Modules\Generator\Generators;


use MezzoLabs\Mezzo\Core\Schema\Attributes\AtomicAttribute;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;

class PhpCodeGenerator
{

    /**
     * @var array
     */
    private $lines;

    public function __construct()
    {

    }

    /**
     * Form an array string out of a Collection or an array.
     *
     * @param array $array
     * @return string
     */
    public function arrayString($array = [])
    {
        $this->lines = [];

        $i = 0;
        foreach ($array as $key => $element) {

            $parameter = $this->toParameter($element);

            if ($key === $i) {
                $this->line($parameter);
            } else {
                $this->line("'" . $key . "' => " . $parameter);
            }

            $i++;
        }

        $elementsString = implode(', ' . static::nl(2), $this->lines);

        return '[' . static::nl(2) . $elementsString . static::nl(1) . '];';
    }

    public function rulesArray(ModelSchema $model)
    {
        $atomicAttributes = $model->attributes()->atomicAttributes();

        $rulesArray = [];
        $atomicAttributes->each(function (AtomicAttribute $attribute) use (&$rulesArray) {
            $rulesArray[$attribute->name()] = $attribute->rules()->toString();
        });

        return $this->arrayString($rulesArray);
    }

    public function openingTag()
    {
        return '<?php';
    }

    private function set($string)
    {
        $this->string = $string;
    }


    private function toParameter($var)
    {
        return static::parameterize($var);
    }

    /**
     * @return AnnotationGenerator
     */
    public function annotationGenerator()
    {
        return new AnnotationGenerator();
    }

    /**
     * Procudes a php code parameter from a variable.
     *
     * @param $var
     * @return string
     */
    public static function parameterize($var)
    {
        if (is_numeric($var)) return $var;

        return "'" . $var . "'";
    }

    /**
     * Creates a new line with a correct indent (no tabs but spaces)
     *
     * @param int $tabs
     * @return string
     */
    public static function nl($tabs = 1)
    {
        $indent = "";
        for ($i = 0; $i != $tabs; $i++) {
            $indent .= '    ';
        }

        return "\r\n" . $indent;
    }

    private function line($line)
    {
        $this->lines[] = $line;
    }
}