<?php


namespace App\Http\Controllers\Profile;


use App\Http\Controllers\Controller;
use App\Http\Requests\AddVoucherRequest;
use App\Magazine\Shop\Domain\Repositories\VoucherRepository;
use App\Magazine\Shop\Domain\Services\VoucherService;

class SubscriptionProfileController extends Controller
{
    /**
     * @var VoucherRepository
     */
    private $vouchers;

    /**
     * @var VoucherService
     */
    private $voucherService;

    public function __construct(VoucherRepository $vouchers, VoucherService $voucherService)
    {
        $this->vouchers = $vouchers;
        $this->voucherService = $voucherService;
    }

    public function getIndex()
    {
        return view('magazine.profile.subscription', ['user' => \Auth::user()]);
    }

    /**
     * @param AddVoucherRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addVoucher(AddVoucherRequest $request)
    {
        $voucher = $this->vouchers->findByKeyOrFail($request->get('code'));

        if ($voucher->isRedeemedBy(\Auth::user())) {
            return \Redirect::back()->with('error', 'Already used this voucher.');
        }


        if (!$voucher->canBeRedeemedBy(\Auth::user())) {
            return \Redirect::back()->with('error', 'This voucher is not active anymore.');
        }

        if ($voucher->type != \App\Voucher::TYPE_SUBSCRIPTION) {
            return \Redirect::back()->with('error', 'Voucher has wront type.');
        }

        $this->voucherService->redeem($voucher, \Auth::user());

        return \Redirect::route('profile.subscription')->withMessage('Voucher redeemed. Added ' . $voucher->getOption('days') . ' days.');


    }
}