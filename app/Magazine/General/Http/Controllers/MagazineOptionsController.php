<?php

namespace App\Magazine\General\Http\Controllers;


use App\Magazine\General\Http\Pages\MagazineOptionsPage;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Http\Controllers\CockpitController;
use MezzoLabs\Mezzo\Http\Controllers\ResourceControllerContract;
use MezzoLabs\Mezzo\Modules\General\Domain\Repositories\OptionRepository;
use MezzoLabs\Mezzo\Modules\General\Options\OptionsPage\StoreOptionsPageRequest;

class MagazineOptionsController extends CockpitController implements ResourceControllerContract
{

    public function __construct()
    {
        $this->module = mezzo()->module('general');

        parent::__construct();
    }

    public function show()
    {
        return $this->page(MagazineOptionsPage::class);
    }

    public function store(StoreOptionsPageRequest $request)
    {
        foreach ($request->get('options') as $name => $value) {
            mezzo()->option($name, $value);
        }

        return $this->redirectToPage(MagazineOptionsPage::class)->with('message', 'Options saved.');
    }

    /**
     * @return MezzoModelReflection
     */
    function model()
    {
        return mezzo()->model(\App\Option::class);
    }

    /**
     * @return ModelRepository
     */
    function repository()
    {
        return OptionRepository::instance();
    }
}