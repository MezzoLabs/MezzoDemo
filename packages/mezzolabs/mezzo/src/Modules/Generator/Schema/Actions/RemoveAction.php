<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Schema\Actions;

class RemoveAction extends AttributeAction{

    /**
     * The line that will be copied in the migration file inside the "up" function.
     *
     */
    public function migrationUp()
    {
        // TODO: Implement migrationUp() method.
    }

    /**
     * The line that will be copied in the migration file inside the "down" function.
     *
     * @return string
     */
    public function migrationDown()
    {
        // TODO: Implement migrationDown() method.
    }

    /**
     * Will return a qualified name that is different from all other possible actions.
     *
     * @return string
     */
    public function qualifiedName()
    {
        // TODO: Implement qualifiedName() method.
    }
}