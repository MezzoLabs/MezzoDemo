<?php


namespace App\Magazine\General\Http\Pages;


use App\Magazine\General\Http\Controllers\MagazineOptionsController;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Modules\General\Http\AbstractPages\OptionsPage;

class MagazineOptionsPage extends OptionsPage
{
    protected $controller = MagazineOptionsController::class;

    protected $action = "show";

    protected $title = "Options for a magazine";

    protected $view = 'modules.general.magazine::options';

    protected $optionFields = [
        'magazine.ad1',
        'magazine.ad2',
        'magazine.name',
        'magazine.public',
        'magazine.social-media.facebook',
        'magazine.social-media.youtube',
        'magazine.social-media.twitter',
        'magazine.social-media.gplus',
    ];

    /**
     * Create a new module page.
     *
     * @param ModuleProvider $module
     */
    public function __construct(ModuleProvider $module)
    {
        parent::__construct($module);

        $this->options('renderedByFrontend', false);
    }

    public function store()
    {

    }

    /**
     * @return Collection
     */
    protected function additionalData()
    {
        $additionalData =  parent::additionalData();

        $additionalData['options'] = $this->optionFields();

        return $additionalData;
    }


}