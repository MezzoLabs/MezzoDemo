<?php


namespace App\Magazine\Events\Http\Pages\Events;

use MezzoLabs\Mezzo\Cockpit\Pages\Resources\IndexResourcePage;

class IndexEventPage extends IndexResourcePage
{
    protected $view = 'modules.events::pages.events.index';


    public function boot()
    {
        $this->options('order', 1);
    }


    public function columns()
    {
        $columns = parent::columns();

        $columns['_start'] = ['type' => \Doctrine\DBAL\Types\Type::DATETIME, 'title' => 'Start'];
        $columns['_end'] = ['type' => \Doctrine\DBAL\Types\Type::DATETIME, 'title' => 'End'];

        return $columns;
    }


}