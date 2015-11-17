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

        return [
            'key' => $blockType->key(),
            'hash' => md5($blockType->key()),
            'html' => $blockType->inputsView()->render()
        ];
    }

}