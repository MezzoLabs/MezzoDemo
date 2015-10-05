<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Migration\Actions;

use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Modules\Generator\Migration\MigrationLine;
use MezzoLabs\Mezzo\Modules\Generator\Migration\MigrationLines;

class CreateAction extends AttributeAction{

    /**
     * The line that will be copied in the migration file inside the "up" function.
     *
     */
    public function migrationUp()
    {
        $lines = new MigrationLines($this->attribute);

        $stringLines = new Collection();
        $lines->make()->each(function(MigrationLine $line) use (&$stringLines){
            $stringLines->push($line->build());
        });

        return $stringLines;
    }

    /**
     * The line that will be copied in the migration file inside the "down" function.
     *
     * @return string
     */
    public function migrationDown()
    {

        return new Collection(['$table->dropColumn(\''. $this->attribute()->name() .'\');']);
    }


}