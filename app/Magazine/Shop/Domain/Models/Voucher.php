<?php

namespace App\Magazine\Shop\Domain\Models;


use App\Magazine\Shop\Domain\Repositories\VoucherRepository;
use App\Magazine\Shop\Domain\Services\VoucherService;
use App\Mezzo\Generated\ModelParents\MezzoVoucher;
use Illuminate\Support\Str;
use MezzoLabs\Mezzo\Exceptions\RepositoryException;

class Voucher extends MezzoVoucher
{
    public function redeem(User $forUser = null)
    {
        return app()->make(VoucherService::class)->redeem($this, $forUser);
    }

    /**
     * Data that will be added to the request if the field is empty
     *
     * @param array $requestData
     * @return array
     */
    public function defaultData(array $requestData) : array
    {
        return [
            'voucher_key' => Str::random(10),
            'type' => 'default'
        ];
    }

    /**
     * @return VoucherRepository
     * @throws RepositoryException
     */
    public static function repository()
    {
        return parent::repository();
    }


}