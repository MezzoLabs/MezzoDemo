<?php


namespace MezzoLabs\Mezzo\Modules\Generator\Generators;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;
use MezzoLabs\Mezzo\Core\Schema\Relations\ManyToMany;
use MezzoLabs\Mezzo\Core\Schema\Relations\RelationSide;
use MezzoLabs\Mezzo\Modules\Generator\Schema\ModelParentSchema;

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
        $this->addLine($this->doctrine('Mezzo\Attribute', [
            'type' => $attribute->type()->name(),
            'hidden' => implode(',', $attribute->hiddenInForms())
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

    /**
     * @param string $indent
     * @return string
     */
    protected function pullLines($indent = '    ')
    {
        $string = $this->multiple($this->lines->toArray(), $indent);

        $this->lines = new Collection();

        return $string;
    }

    /**
     * Make a string out of multiple annotation strings
     *
     * @param array $lines
     * @param string $indent
     * @return string
     */
    protected function multiple(array $lines = [], $indent  = '    ')
    {
        return implode("\n" . $indent, $lines);
    }

    /**
     * @param ModelSchema $modelSchema
     * @return string
     */
    public function classAnnotations(ModelParentSchema $modelParent)
    {
        $modelSchema = $modelParent->modelSchema();

        $this->addLine('* App\Mezzo\Generated\ModelParents\\' . $modelParent->name());
        $this->addLine('*');

        $modelSchema->attributes()->each(function(Attribute $attribute){
            $variableType = trim($attribute->type()->variableType());
            $name = $attribute->name();
            $this->addLine("* @property " . $variableType . " $" . $name . "");
        });

        $modelSchema->relationSides()->each(function(RelationSide $relationSide){
            $otherSide = $relationSide->otherSide();
            $relatedClass = $otherSide->modelReflection()->className();

            if ($relationSide->hasMultipleChildren())
                $this->addLine('* @property EloquentCollection $' . $relationSide->naming());
            else
                $this->addLine('* @property \\' . $relatedClass . ' $' . $relationSide->naming());
        });


        return $this->pullLines('');
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
                'table' => $relation->joinTable(),
                'column' => $relation->joinColumn()
            ]));


        return $this->pullLines();
    }

    public function phpGenerator()
    {
        return new PhpCodeGenerator();
    }
}