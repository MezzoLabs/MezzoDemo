<?php


namespace App\Magazine\General\Http\Pages;


use App\Magazine\General\Http\Controllers\MagazineOptionsController;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Modules\General\Options\OptionsPage\OptionsPage;

class MagazineOptionsPage extends OptionsPage
{
    protected $controller = MagazineOptionsController::class;

    protected $action = "show";

    protected $view = 'modules.general.magazine::options';

    protected $optionFields = [
        'magazine::ads_1',
        'magazine::ads_2',
        'magazine::name',
        'magazine::public',
        'magazine::social-media_facebook',
        'magazine::social-media_youtube',
        'magazine::social-media_twitter',
        'magazine::social-media_gplus',
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