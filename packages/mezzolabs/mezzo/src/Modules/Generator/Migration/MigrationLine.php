<?php


namespace MezzoLabs\Mezzo\Modules\Generator\Migration;


use Illuminate\Support\Collection;

class MigrationLine {

    /**
     * The parts of the migration line
     *
     * @var Collection
     */
    protected $parts;

    public function __construct($parts = [])
    {
        $this->parts = new Collection($parts);

        $this->prependTableVariable();
    }

    /**
     * Return the final string
     *
     * @return string
     */
    public function build(){
        return implode('->', $this->parts->toArray()) . ';';
    }

    /**
     * Add a part to the fluent migration string
     *
     * @param $string
     */
    protected function addPart($string){
        $this->parts->push($string);
    }

    /**
     * Add a function call to the fluent migration string
     *
     * @param $functionName
     * @param array $parameters
     */
    public function addFunction($functionName, $parameters = []){
        $function = $functionName . '(' . $this->parameterList($parameters) . ')';
        $this->addPart($function);
    }

    public function addColumn($type, $columnName, $parameters = []){
        array_unshift($parameters, $columnName);

        $this->addFunction($type, $parameters);
    }

    public function addPrimaryKey(){
        $this->addFunction('increments', 'id');
    }

    public function addForeignKey($foreign_key, $otherTable = '', $references = 'id', $onDelete = 'cascade'){
        $this->addFunction('foreign', $foreign_key);
        $this->addFunction('references', $references);
        $this->addFunction('otherTable', $otherTable);
        $this->addFunction('onDelete', 'cascade');
    }

    public function addPrimary($columns){
        $this->addPart('primary([' . $this->parameterList($columns) .'])');
    }

    public function addTimestamps(){
        $this->addFunction('timestamps');
    }

    /**
     * Prepend '$table' to the line if it isn`t already there.
     *
     * @return void
     */
    private function prependTableVariable(){
        if($this->parts->first() === '$table') return;

        $this->parts->prepend('$table');
    }

    /**
     * Create a string list from a parameter array.
     *
     * @param array $parameters
     * @return string
     */
    private function parameterList($parameters = []){
        if(empty($parameters)) return '';

        if(!is_array($parameters)) $parameters = [$parameters];

        $newParameters = [];
        foreach($parameters as $parameter){
            if(is_numeric($parameter))
                $newParameters[] = '\'' . $parameter . '\'';
            else
                $newParameters[] = $parameter;
        }

        return implode(', ', $parameters);
    }

    /**
     * Start a new MigrationLine, beginning with the column name.
     *
     * @param $type
     * @param $name
     * @param array $parameters
     * @return MigrationLine
     */
    public static function column($type, $name, $parameters = []){
        $line = new MigrationLine();
        $line->addColumn($type, $name, $parameters);

        return $line;
    }

    /**
     * Start a new MigrationLine, beginning with '$table'.
     *
     * @return MigrationLine
     */
    public static function start(){
        return new MigrationLine();
    }

} 