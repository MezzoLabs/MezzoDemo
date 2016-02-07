<?php


namespace App\Magazine\Events\Http\Pages\Events;

use MezzoLabs\Mezzo\Cockpit\Pages\Forms\IndexTableColumn;
use MezzoLabs\Mezzo\Cockpit\Pages\Forms\IndexTableColumns;
use MezzoLabs\Mezzo\Cockpit\Pages\Resources\IndexResourcePage;

class IndexEventPage extends IndexResourcePage
{
    protected $view = 'modules.events::pages.events.index';

    public $filtersView = 'modules.events::partials.event_index_filters';

    public function boot()
    {
        $this->options('order', 1);
    }


    public function columns() : IndexTableColumns
    {
        $columns = parent::columns();

        $columns['_start'] = IndexTableColumn::makeFromCalculatedValue('_start', 'Start', \Doctrine\DBAL\Types\Type::DATETIME);
        $columns['_end'] = IndexTableColumn::makeFromCalculatedValue('_end', 'End', \Doctrine\DBAL\Types\Type::DATETIME);
        $columns['_distance'] = IndexTableColumn::makeFromCalculatedValue('_distance', 'Distance', 'distance');
        $columns['_distance']->options->put('column', 'distance');

        return $columns;
    }


}