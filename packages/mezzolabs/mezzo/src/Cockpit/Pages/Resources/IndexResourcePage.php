<?php


namespace MezzoLabs\Mezzo\Cockpit\Pages\Resources;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Cockpit\Pages\Forms\IndexTableColumn;
use MezzoLabs\Mezzo\Cockpit\Pages\Forms\IndexTableColumns;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;

abstract class IndexResourcePage extends ResourcePage
{
    protected $action = 'index';

    protected $view = 'cockpit::pages.resources.index';

    protected $options = [
        'visibleInNavigation' => true,
        'appendToUri' => ''
    ];

    /**
     * Options that will be passed to the frontend controller in the vm.init function.
     *
     * @var array
     */
    protected $frontendOptions = [
        'backendPagination' => false
    ];

    /**
     * Returns the columns of the index table.
     *
     * @return array
     */
    public function columns() : IndexTableColumns
    {
        $attributes = $this->model()->attributes()->visibleInForm('index');

        $columns = new IndexTableColumns();
        $attributes->each(function (Attribute $attribute) use (&$columns) {
            $columns->put(
                $attribute->naming(),
                IndexTableColumn::makeFromAttribute($attribute)
            );
        });

        return $columns;
    }

    /**
     *
     *
     * @return Collection
     */
    public function frontendOptions()
    {
        return new Collection($this->frontendOptions);
    }
}