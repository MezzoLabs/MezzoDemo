<tbody>
<tr ng-repeat="model in vm.getPagedModels() track by $index">
    <td>
                            <span class="locked-for-user" title="Locked by @{{ vm.lockedBy(model) }}"
                                  ng-show="vm.isLocked(model)"><i class="ion-ios-locked"></i></span>
    </td>
    <td>
        <input type="checkbox" ng-model="model._meta.selected">
    </td>
    <td ng-repeat="value in vm.getModelValues(model) track by $index">
        <a href="" class="disabled" title="ID: @{{ model.id }}"
           ng-if="vm.displayAsLink($first, model)" ng-click="vm.editId(model.id)"
           ng-bind="value"></a>
        <span ng-if="!vm.displayAsLink($first, model)" ng-bind="value"></span>
    </td>
</tr>
</tbody>