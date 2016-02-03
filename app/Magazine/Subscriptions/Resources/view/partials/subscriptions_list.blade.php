<div class="subscriptions">
    <div class="row subscription" ng-repeat="subscription in vm.relationItems track by $index">

        {!! cockpit_form()->open(['angular' => true, 'name' => 'vm.forms[$index]']) !!}


        <input value="@{{ vm.inputs['subscriptions.'+ $index +'.id'] }}" name="subscriptions.@{{ $index }}.id"
               type="hidden">

        {!! $model_reflection->schema()->attributes('subscriptions')->render(
        ['index' => '@{{ $index }}', 'ngModel' => true]) !!}

        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-block btn-danger" ng-click="vm.deleteSubscription(subscription)">
                    Delete
                </button>
            </div>
            <div class="col-md-6">
                {!! cockpit_form()->submitCreate($model_reflection, null) !!}
            </div>
        </div>
        {!! cockpit_form()->close() !!}

        <hr/>

    </div>
</div>