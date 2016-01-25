<!-- Bottom Container -->
<div class="panel panel-bordered">

    <div class="panel-heading">
        <h3>{{ str_plural($model_reflection->name()) }} (@{{ vm.getModels().length }})</h3>
    </div>
    <div class="panel-body panel-body-nopadding">
        <div class="progress" ng-show="vm.loading">
            <div class="progress-bar progress-bar-danger progress-bar-striped active" style="width: 100%">Please
                be patient...
            </div>
        </div>

        <div class="table-responsive">
            <table ng-table="vm.tableParams" class="table table-responsive">
                @include('cockpit::partials.pages.index_table_heading')
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

                        <b ng-if="$first">
                            @{{ (model._is_published) ? '' : '- Private' }}
                        </b>

                        <span ng-if="!vm.displayAsLink($first, model)" ng-bind="value"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        @include('cockpit::partials.pages.index_pagination')


    </div>
</div>
<!-- Bottom Container -->