<?php


namespace MezzoLabs\Mezzo\Cockpit\Pages\Resources;


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
     * Returns the columns of the index table.
     *
     * @return array
     */
    public function columns()
    {
        $attributes = $this->model()->attributes()->visibleInForm('index');

        $columns = [];
        $attributes->each(function (Attribute $attribute) use (&$columns) {
            $columns[$attribute->naming()] = [
                'type' => $attribute->type()->doctrineTypeName(),
                'title' => $attribute->title()
            ];
        });

        return $columns;
    }
}