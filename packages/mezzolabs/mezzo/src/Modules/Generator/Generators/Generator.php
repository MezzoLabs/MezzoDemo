<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Generators;


abstract class Generator {
    /**
     * Run the generator and save the files to the disk.
     *
     * @return mixed
     */
    abstract public function run();

    /**
     * The path of the folder in which the files are created.
     *
     * @return string
     */
    abstract public function folderName();
} 