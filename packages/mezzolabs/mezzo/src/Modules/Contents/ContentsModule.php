<?php


namespace MezzoLabs\Mezzo\Modules\Contents;


use App\Content;
use App\ContentBlock;
use App\ContentField;
use App\Tutorial;
use App\User;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Modules\Contents\BlockTypes\ContentBlockTypeRegistrar;
use MezzoLabs\Mezzo\Modules\Contents\DefaultElements\BlockTypes\TextOnly;

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
        $this->registerBlock([
            TextOnly::class
        ]);
    }

    /**
     * @return ContentBlockTypeRegistrar
     */
    public function blockRegistrar()
    {
        return app()->make(ContentBlockTypeRegistrar::class);
    }

    /**
     * @param $contentBlock
     */
    public function registerBlock($contentBlock)
    {
        $this->blockRegistrar()->register($contentBlock);
    }
}