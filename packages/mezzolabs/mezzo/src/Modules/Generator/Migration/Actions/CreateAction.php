<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Migration\Actions;

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
        $string = "";

        $lines = new MigrationLines($this->attribute);
        $lines->get()->each(function(MigrationLine $line) use ($string){
            $string .= $line->build();
        });

        return $string;
    }

    /**
     * The line that will be copied in the migration file inside the "down" function.
     *
     * @return string
     */
    public function migrationDown()
    {
        return '$table->dropColumn(\''. $this->attribute()->name() .'\');';
    }


}