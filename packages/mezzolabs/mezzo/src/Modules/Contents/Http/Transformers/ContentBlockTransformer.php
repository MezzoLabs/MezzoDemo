<?php


namespace MezzoLabs\Mezzo\Modules\Contents\Http\Transformers;


use App\ContentBlock;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Http\Transformers\EloquentModelTransformer;

class ContentBlockTransformer extends EloquentModelTransformer
{
    /**
     * @var string
     */
    protected $modelName = ContentBlock::class;

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'fields'
    ];

    protected $defaultIncludes = [
        'fields'
    ];

    public function transform($model)
    {
        if (!$model instanceof ContentBlock)
            throw new InvalidArgumentException($model);

        return parent::transform($model);

    }

    public function includeFields(ContentBlock $block)
    {
        return $this->automaticCollection($block->fields);
    }
}