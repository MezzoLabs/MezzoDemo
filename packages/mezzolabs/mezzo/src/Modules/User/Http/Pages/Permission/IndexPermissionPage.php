<?php


namespace MezzoLabs\Mezzo\Modules\Permission\Http\Pages\Permission;

use MezzoLabs\Mezzo\Cockpit\Pages\Resources\IndexResourcePage;

class IndexPermissionPage extends IndexResourcePage
{

    public function boot()
    {
        $this->options('permissions', 'administrate');
    }
}