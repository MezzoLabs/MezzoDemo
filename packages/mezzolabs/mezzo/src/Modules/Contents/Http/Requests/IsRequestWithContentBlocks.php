<?php


namespace MezzoLabs\Mezzo\Modules\Contents\Http\Requests;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Validation\Validator;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

trait IsRequestWithContentBlocks
{
    /**
     * @return bool
     */
    protected function validateContentBlocks()
    {
        if (!$this->has('blocks') || !is_array($this->get('blocks')))
            throw new BadRequestHttpException('There are no blocks for this content.');

        $blockArrays = $this->get('blocks');

        foreach ($blockArrays as $blockArray) {
            $this->validateContentBlock($blockArray);
        }

        return true;
    }

    /**
     * @param $data
     * @return bool
     */
    protected function validateContentBlock($data)
    {
        $data = new Collection($data);

        $block = new \App\ContentBlock();

        $this->validateContentBlockProperties($block, $data);
        $block->fill($data->toArray());

        $this->validateFields($block, $data->get('fields', []));


        return true;
    }

    /**
     * @param \App\ContentBlock $block
     * @param Collection $data
     * @return bool
     */
    private function validateContentBlockProperties(\App\ContentBlock $block, Collection $data)
    {
        // Do not check for the content id, because the parent model is not created yet.
        $blockRules = $block->getRules();
        unset($blockRules['content_id']);

        $blockValidator = Validator::make($data->toArray(), $blockRules);

        if ($blockValidator->fails())
            $this->failedValidation($blockValidator);

        return true;
    }

    /**
     * @param \App\ContentBlock $block
     * @param $fields
     * @return bool
     */
    private function validateFields(\App\ContentBlock $block, $fields)
    {
        $fieldsRules = $block->fieldsRules();
        $fieldsValidator = Validator::make($fields, $fieldsRules);

        if ($fieldsValidator->fails())
            $this->failedValidation($fieldsValidator);

        return true;
    }
}