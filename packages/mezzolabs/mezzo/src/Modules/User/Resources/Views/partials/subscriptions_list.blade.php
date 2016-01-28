<div class="subscriptions">
    <div class="row subscription" ng-repeat="subscription in vm.content.subscriptions track by $index">

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


        <!--
        <div class="col-md-12">
            <div class="form-group">
                <label>Plan</label>
                <input class="form-control" type="text" disabled value="@{{ subscription.plan }}"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>From</label>
                <input class="form-control" type="text" disabled
                       value="@{{ subscription.created_at }}"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>To</label>
                <input class="form-control" type="text" disabled
                       value="@{{ subscription.subscribed_until }} (@{{ vm.timeLeft(subscription) }})"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Cancelled</label>
                <input type="checkbox" class="checkbox" disabled
                       ng-checked="subscription.cancelled == 1"/>
            </div>
        </div>
        <div class="col-md-12 text-right">
            <div class="btn-group">
            <span class="btn btn-default" ng-if="subscription.cancelled == 0"
                  ng-click="vm.changeCancel(subscription, 1)">Cancel</span>
            <span class="btn btn-default" ng-if="subscription.cancelled == 1"
                  ng-click="vm.changeCancel(subscription, 0)">Uncancel</span>
                <span class="btn btn-danger" ng-click="vm.deleteSubscription(subscription)">Delete</span>
            </div>
            <hr/>
        </div>-->
    </div>
</div>