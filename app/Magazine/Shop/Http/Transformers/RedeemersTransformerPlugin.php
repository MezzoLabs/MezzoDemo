<?php


namespace App\Magazine\Shop\Http\Transformers;


use App\Magazine\Shop\Domain\Models\Voucher;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoModel;
use MezzoLabs\Mezzo\Http\Transformers\Plugins\TransformerPlugin;

class RedeemersTransformerPlugin extends TransformerPlugin
{

    /**
     * @param MezzoModel $model
     * @return array
     */
    public function transform(MezzoModel $model) : array
    {
        if (!$model instanceof Voucher) {
            return [];
        }

        return [
            '_redeemers_amount' => $model->redeemersAmount()
        ];
    }
}