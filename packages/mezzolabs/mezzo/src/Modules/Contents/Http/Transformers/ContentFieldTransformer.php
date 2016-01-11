<?php


namespace MezzoLabs\Mezzo\Modules\Contents\Http\Transformers;


use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Http\Transformers\EloquentModelTransformer;
use MezzoLabs\Mezzo\Modules\Contents\Domain\Models\ContentField;

class ContentFieldTransformer extends EloquentModelTransformer
{
    /**
     * @var string
     */
    protected $modelName = ContentField::class;

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [

    ];

    protected $defaultIncludes = [

    ];

    public function transform($model)
    {
        if (!$model instanceof ContentField)
            throw new InvalidArgumentException($model);

        return [
            $model->name => $model->value
        ];

    }
}