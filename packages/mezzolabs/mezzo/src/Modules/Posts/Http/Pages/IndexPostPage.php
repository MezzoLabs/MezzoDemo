<?php


namespace MezzoLabs\Mezzo\Modules\Posts\Http\Posts;

use MezzoLabs\Mezzo\Cockpit\Pages\Resources\IndexResourcePage;

class IndexPostPage extends IndexResourcePage
{
    protected $view = 'modules.posts::posts.index';


    public function boot()
    {
        $this->frontendOptions['backendPagination'] = true;
    }

}