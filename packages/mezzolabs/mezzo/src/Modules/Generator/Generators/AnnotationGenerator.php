<?php


namespace MezzoLabs\Mezzo\Modules\Generator\Generators;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Core\Schema\Relations\ManyToMany;
use MezzoLabs\Mezzo\Core\Schema\Relations\RelationSide;

class AnnotationGenerator
{
    /**
     * @var Collection
     */
    protected $lines;

    public function __construct()
    {
        $this->lines = new Collection();
    }

    /**
     * @param InputType $type
     * @return string
     */
    public function inputType(InputType $type)
    {
        return $this->doctrine('Mezzo\InputType', ['type' => $type->name()]);
    }

    public function doctrine($annotationClass, $array = [])
    {
        $parameters = array();

        foreach ($array as $key => $variable) {
            $value = PhpCodeGenerator::parameterize($variable);
            $parameters[] = $key . '=' . $value;
        }

        $parameterString = implode(', ', $parameters);

        if (!empty($parameterString))
            $string = $annotationClass . '(' . $parameterString . ')';
        else
            $string = $annotationClass;

        return $this->make($string);
    }

    public function make($type, $parameters = "")
    {
        $string = '* @' . $type;

        if (!empty($parameters)) $string .= " " . $parameters;

        return $string;
    }

    /**
     * Generate the annotation for an attribute.
     *
     * @param Attribute $attribute
     * @return string
     */
    public function attribute(Attribute $attribute)
    {
        $this->doctrine('Mezzo\Attribute', [
            'inputType' => $attribute->type()->name()
        ]);

        return $this->pullLines();
    }

    /**
     * @return string
     */
    protected function pullLines()
    {
        $string = $this->multiple($this->lines->toArray());

        $this->lines = new Collection();

        return $string;
    }

    /**
     * Make a string out of multiple annotation strings
     *
     * @param $lines
     * @return string
     */
    protected function multiple(array $lines = [])
    {
        return implode("\n    ", $lines);
    }

    public function relation(RelationSide $relationSide)
    {
        $relation = $relationSide->relation();
        $relationType = $relation->shortType();

        $this->addLine($this->doctrine('Mezzo\\Relations\\' . $relationType));

        $this->addLine($this->doctrine('Mezzo\\Relations\\From', [
            'table' => $relation->fromTable(),
            'primaryKey' => $relation->fromPrimaryKey(),
            'naming' => $relation->fromNaming()
        ]));

        $this->addLine($this->doctrine('Mezzo\\Relations\\To', [
            'table' => $relation->toTable(),
            'primaryKey' => $relation->toPrimaryKey(),
            'naming' => $relation->toNaming()
        ]));

        if ($relation instanceof ManyToMany)
            $this->addLine($this->doctrine('Mezzo\\Relations\\PivotTable', [
                'name' => $relation->pivotTable(),
                'fromColumn' => $relation->pivotColumnFrom(),
                'toColumn' => $relation->pivotColumnTo()
            ]));
        else
            $this->addLine($this->doctrine('Mezzo\\Relations\\JoinColumn', [
                'table' => $relation->toTable(),
                'column' => $relation->toPrimaryKey(),
            ]));


        return $this->pullLines();
    }

    /**
     * Add a line to the buffer.
     *
     * @param string $line
     */
    protected function addLine($line)
    {
        $this->lines->push($line);
    }

    public function phpGenerator()
    {
        return new PhpCodeGenerator();
    }
}