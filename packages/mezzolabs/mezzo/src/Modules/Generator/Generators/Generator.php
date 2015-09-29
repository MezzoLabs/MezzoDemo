<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Generators;


abstract class Generator {
    /**
     * Run the generator and save the files to the disk.
     *
     * @return mixed
     */
    abstract public function run();
} 