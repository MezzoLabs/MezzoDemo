<?php


namespace MezzoLabs\Mezzo\Modules\Contents\Http\Transformers;


use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Http\Transformers\Transformer;
use MezzoLabs\Mezzo\Modules\Contents\Contracts\ContentBlockTypeContract;

class ContentBlockTypeTransformer extends Transformer
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
    ];

    protected $defaultIncludes = [
    ];

    public function transform($blockType)
    {
        if (!$blockType instanceof ContentBlockTypeContract)
            throw new InvalidArgumentException($blockType);


        $html = (\Input::get('html') != 'raw') ?
            route('cockpit::contents.block-type.html', ['hash' => $blockType->hash()]) :
            $blockType->inputsView()->render();

        return [
            'key' => $blockType->key(),
            'hash' => $blockType->hash(),
            'html' => $html
        ];
    }

}