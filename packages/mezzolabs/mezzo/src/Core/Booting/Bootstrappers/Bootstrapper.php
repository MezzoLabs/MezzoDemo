<?php
/**
 * Project: MezzoDemo | Bootstrapper.php
 * Author: Simon - www.triggerdesign.de
 * Date: 11.07.2015
 * Time: 15:24
 */

namespace MezzoLabs\Mezzo\Core\Booting\Bootstrappers;


use MezzoLabs\Mezzo\Core\Mezzo;

interface Bootstrapper {
    /**
     * Run the booting process for this service.
     *
     * @param Mezzo $mezzo
     * @return mixed
     */
    public function boot(Mezzo $mezzo);
} 