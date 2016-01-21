<!-- Bottom Container -->
<div class="panel panel-bordered">

    <div class="panel-heading">
        <h3>{{ str_plural($model_reflection->name()) }} (@{{ vm.getModels().length }})</h3>
    </div>
    <div class="panel-body">
        <div class="progress" ng-show="vm.loading">
            <div class="progress-bar progress-bar-danger progress-bar-striped active" style="width: 100%">Please
                be patient...
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th></th>
                    <th>
                        <input type="checkbox" ng-model="vm.selectAll" ng-change="vm.updateSelectAll()">
                    </th>

                    @foreach($module_page->columns() as $name => $column)
                        <th ng-init="vm.addAttribute('{{ $name }}', '{{ $column['type'] }}')">{{ $column['title'] }}</th>
                    @endforeach
                </tr>
                </thead>
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
            </table>
        </div>
        <div class="text-right">

            <uib-pagination total-items="vm.getModels().length" previous-text="<" next-text=">" ng-model="vm.currentPage" items-per-page="vm.perPage" ng-change="vm.pageChanged()"></uib-pagination>

        </div>

    </div>
</div>
<!-- Bottom Container -->