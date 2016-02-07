<?php


namespace MezzoLabs\Mezzo\Cockpit\Pages\Resources;


use MezzoLabs\Mezzo\Core\Permission\PermissionGuard;

class EditResourcePage extends ResourcePage
{
    protected $action = 'edit';

    protected $options = [
        'visibleInNavigation' => false,
        'appendToUri' => '/{id}'
    ];

    protected $view = 'cockpit::pages.resources.edit';

    /**
     * Check if the current user is allowed to view this page.
     *
     * @return bool
     */
    public function isAllowed()
    {
        if (!parent::isAllowed()) {
            return false;
        }

        return PermissionGuard::make()->allowsEdit($this->model()->instance(true));
    }

}