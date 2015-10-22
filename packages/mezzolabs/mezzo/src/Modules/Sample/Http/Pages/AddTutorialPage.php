<?php


namespace MezzoLabs\Mezzo\Modules\Sample\Http\Pages;

use MezzoLabs\Mezzo\Cockpit\Pages\Resources\AddResourcePage;
use MezzoLabs\Mezzo\Cockpit\Pages\Resources\ListResourcePage;

class AddTutorialPage extends AddResourcePage
{
    protected $action = "TutorialController@create";
}