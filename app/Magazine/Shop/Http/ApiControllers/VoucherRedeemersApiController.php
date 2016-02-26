<?php


namespace App\Magazine\Shop\Http\ApiControllers;


use App\Magazine\Shop\Domain\Repositories\VoucherRepository;
use MezzoLabs\Mezzo\Http\Controllers\ApiResourceController;
use MezzoLabs\Mezzo\Http\Controllers\HasDefaultApiResourceFunctions;
use MezzoLabs\Mezzo\Http\Requests\Resource\IndexResourceRequest;

class VoucherRedeemersApiController extends ApiResourceController
{
    use HasDefaultApiResourceFunctions {
        index as resourceIndex;
        store as defaultStore;
        update as defaultUpdate;
    }

    public $model = \App\Voucher::class;
    /**
     * @var VoucherRepository
     */
    private $vouchers;


    public function __construct(VoucherRepository $vouchers)
    {

        $this->vouchers = $vouchers;
    }


    public function index(IndexResourceRequest $request, $id)
    {
        $user = $this->vouchers->findOrFail($id);

        return $this->resourceResponse()->indexRelation($vouche, $request->queryObject(), $this->subscriptions);
    }
}