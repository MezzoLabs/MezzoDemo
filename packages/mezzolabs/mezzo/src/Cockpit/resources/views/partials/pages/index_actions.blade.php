<!-- Top Container -->
<div class="panel panel-bordered">
    <div class="panel-body">

        <!-- Search -->
        <input type="search" class="form-control pull-right" style="display: inline-block; width: 200px"
               placeholder="Search" ng-model="vm.searchText">
        <!-- Search -->

        <!-- Add new -->
        <a href="{{ $module_page->sibling('create')->url() }}" class="btn btn-primary">
            <span class="ion-plus"></span> {{ Lang::get('mezzo.general.add_new') }}
        </a>
        <!-- Add new -->

        <!-- Edit -->
        <button type="button" class="btn btn-default" ng-disabled="!vm.canEdit()" ng-click="vm.edit()">
            <span class="ion-edit"></span> {{ Lang::get('mezzo.general.edit') }}</button>
        <!-- Edit -->

        <button type="button" class="btn btn-default" ng-disabled="!vm.canEdit()" ng-click="vm.duplicate()">
            <span class="ion-ios-copy"></span> {{ Lang::get('mezzo.general.duplicate') }}</button>

        <!-- Delete -->
        <button type="button" class="btn btn-default" ng-disabled="!vm.canRemove()" ng-click="vm.remove()">
            <span class="ion-trash-b"></span> {{ Lang::get('mezzo.general.delete') }}
            <span class="badge" ng-bind="vm.countSelected()"></span>
        </button>
        <!-- Delete -->

        <!-- Deletion progress -->
        <div class="progress" style="display: inline-block; width: 200px; margin-top: auto; margin-bottom: auto"
             ng-show="vm.removing">
            <div class="progress-bar progress-bar-striped active" style="width: 100%">
                Deleting <span ng-bind="vm.removing"></span> models...
            </div>
        </div>
        <!-- Deletion progress -->

    </div>
</div>