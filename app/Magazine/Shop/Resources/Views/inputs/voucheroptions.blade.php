<input type="hidden" name="options._json" value="true">
<div class="form-group">
    <label>{{ trans('mezzo.modules.shop.vouchers.for_user') }}</label>
    <mezzo-relation-input name="options.forUser" data-related="User"></mezzo-relation-input>
</div>
<div class="form-group">
    <label>{{ trans('mezzo.modules.shop.vouchers.subscription_months') }}</label>
    <input type="number" name="options.months" class="form-control">
</div>
<div class="form-group">
    <label>{{ trans('mezzo.modules.shop.vouchers.money_coupon') }}</label>
    {!! cockpit_form()->inputField('options.money', \MezzoLabs\Mezzo\Core\Schema\InputTypes\MoneyInput::class) !!}
</div>