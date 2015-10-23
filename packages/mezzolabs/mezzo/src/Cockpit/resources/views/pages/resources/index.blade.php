<div class="wrapper">

    <!-- Top Container -->
    <div class="well">

        <!-- Search -->
        <input type="search" class="form-control pull-right" style="display: inline-block; width: 200px"
               placeholder="Search" ng-model="vm.searchText">
        <!-- Search -->

        <!-- Add new -->
        <button type="button" class="btn btn-primary" ng-click="vm.create()">
            <span class="ion-plus"></span>
            Add new
        </button>
        <!-- Add new -->

        <!-- Edit -->
        <button type="button" class="btn btn-default" ng-disabled="!vm.canEdit()" ng-click="vm.edit()">
            <span class="ion-edit"></span>
            Edit
        </button>
        <!-- Edit -->

        <!-- Delete selected -->
        <button type="button" class="btn btn-default" ng-disabled="!vm.canRemove()" ng-click="vm.remove()">
            <span class="ion-trash-b"></span>
            Delete
            <span class="badge" ng-bind="vm.countSelected()"></span>
        </button>
        <!-- Delete selected -->

    </div>
    <!-- Top Container -->

    <!-- Table Container -->

    <h1>{{ str_plural($model->name()) }}</h1>

    <div class="well">
        <table class="table table-striped table-responsive" data-model="{{ $model->name() }}">
            <thead>
            <tr>
                @foreach($model->attributes() as $attribute)
                    <th>{{ $attribute->title() }}</th>@endforeach
            </thead>
            </tr>
            <tbody>
            <tr ng-repeat="model in vm.getModels() track by $index">
                <td>
                    <input type="checkbox" ng-model="model._meta.selected">
                </td>
                <td ng-repeat="value in vm.getModelValues(model)" ng-bind="value"></td>
            </tr>
            </tbody>
        </table>
    </div>

</div>