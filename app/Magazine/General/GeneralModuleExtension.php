<?php


namespace App\Magazine\General;


use App\Magazine\General\Http\Pages\MagazineOptionsPage;
use MezzoLabs\Mezzo\Core\Modularisation\Extensions\ModuleExtension;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\UrlInput;
use MezzoLabs\Mezzo\Modules\General\GeneralModule;

class GeneralModuleExtension extends ModuleExtension
{
    /**
     * @var array
     */
    protected $pages = [
        MagazineOptionsPage::class
    ];


    /**
     * @return GeneralModule
     */
    public function module()
    {
        return parent::module();
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->loadViewsFrom(app_path() . '/Magazine/General/Resources/view', 'modules.general.magazine');

        \Event::listen('mezzo.cockpit.routes_included', function () {
            require(app_path('Magazine/General/Http/routes.php'));
        });

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->module()->optionRegistry()->register([
            'magazine.social-media.youtube' => [
                'title' => 'Social media: Youtube',
                'rules' => 'required|url',
                'inputType' => UrlInput::class
            ]
        ]);

    }
}