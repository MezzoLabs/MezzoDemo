<?php

namespace MezzoLabs\Mezzo\Console\Commands;

use Illuminate\Console\Command;

abstract class MezzoCommand extends Command{

    public function abstractName(){
        $signature = $this->signature;

        $signature = str_replace('mezzo:', 'mezzo.commands.', $signature);
        $signature = str_replace(':', '.', $signature);

        return $signature;
    }

} 