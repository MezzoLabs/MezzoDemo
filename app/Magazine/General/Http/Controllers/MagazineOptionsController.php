<?php

namespace App\Magazine\General\Http\Controllers;


use App\Magazine\General\Http\Pages\MagazineOptionsPage;
use MezzoLabs\Mezzo\Http\Controllers\CockpitController;

class MagazineOptionsController extends CockpitController
{
    public function __construct()
    {
        $this->module = mezzo()->module('general');

        parent::__construct();
    }

    public function show()
    {
        return $this->page(MagazineOptionsPage::class);
    }
}