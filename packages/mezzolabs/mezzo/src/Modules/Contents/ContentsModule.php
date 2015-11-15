<?php


namespace MezzoLabs\Mezzo\Modules\Contents;


use App\Content;
use App\ContentBlock;
use App\ContentField;
use App\Tutorial;
use App\User;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Modules\Contents\DefaultElements\BlockTypes\TextOnly;
use MezzoLabs\Mezzo\Modules\Contents\Types\BlockTypes\ContentBlockTypeRegistrar;

class ContentsModule extends ModuleProvider
{
    protected $models = [
        Content::class,
        ContentBlock::class,
        ContentField::class,
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->bindWithPrefix('blockregistrar', ContentBlockTypeRegistrar::class, true);
    }

    /**
     * Called when module is ready, model reflections are loaded.
     *
     * @return mixed
     */
    public function ready()
    {
        $this->loadViews();

        $this->registerBlock([
            TextOnly::class
        ]);
    }

    /**
     * @return ContentBlockTypeRegistrar
     */
    public function getBlockRegistrar()
    {
        return app()->make(ContentBlockTypeRegistrar::class);
    }

    /**
     * @param $contentBlock
     */
    public function registerBlock($contentBlock)
    {
        $this->getBlockRegistrar()->register($contentBlock);
    }
}