<div class="wrapper">
    <table class="table">
        <thead>
            <tr>
                <th ng-repeat="column in vm.columns() track by $index" ng-bind="column"></th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="model in vm.models track by $index">
                <td ng-repeat="(key, value) in model" ng-bind="value"></td>
            </tr>
        </tbody>
    </table>
</div>