<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Migration\Actions;

use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;

class CreateAction extends AttributeAction{

    /**
     * The line that will be copied in the migration file inside the "up" function.
     *
     */
    public function migrationUp()
    {
       $columnType = $this->attribute()->
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