<?php


namespace MezzoLabs\Mezzo\Modules\Contents\Http\Requests;


use MezzoLabs\Mezzo\Core\Validation\Validator;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

trait IsRequestWithContentBlocks
{
    protected function validateContentBlocks()
    {
        if (!$this->has('blocks') || !is_array($this->get('blocks')))
            throw new BadRequestHttpException('There are no blocks for this content.');

        $blocksArray = $this->get('blocks');

        foreach ($blockArrays as $blockArray) {
            $validator = Validator::make($blocksArray['fields']);

        }
        mezzo_dd($blocks);
    }
}