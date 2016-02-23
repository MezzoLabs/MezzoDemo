<label ng-if="vm.inputs['type'] != 'default'">Optionen</label>
<input type="hidden" name="options._json" value="true">
<div class="form-group" ng-if="vm.inputs['type'] == 'subscription'">
    <label>{{ trans('mezzo.modules.shop.vouchers.subscription_days') }}</label>
    <input type="number" name="options.days" class="form-control">
</div>
<div class="form-group" ng-if="vm.inputs['type'] == 'coupon'">
    <label>{{ trans('mezzo.modules.shop.vouchers.money_coupon') }}</label>
    {!! cockpit_form()->inputField('options.money', \MezzoLabs\Mezzo\Core\Schema\InputTypes\MoneyInput::class) !!}
</div>
<div class="form-group" ng-if="vm.inputs['type'] == 'coupon'">
    <label>{{ trans('mezzo.modules.shop.vouchers.discount_percent') }}</label>
    {!! cockpit_form()->inputField('options.discount_percent', \MezzoLabs\Mezzo\Core\Schema\InputTypes\PercentInput::class) !!}
</div>
<br ng-if="vm.inputs['type'] != 'normal'"/>
