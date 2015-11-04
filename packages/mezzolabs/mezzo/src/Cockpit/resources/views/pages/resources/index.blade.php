@extends('cockpit::layouts.default.content.container')


@section('content')

    <div class="wrapper">

        <!-- Top Container -->
        <div class="well">

            <!-- Search -->
            <input type="search" class="form-control pull-right" style="display: inline-block; width: 200px"
                   placeholder="Search" ng-model="vm.searchText">
            <!-- Search -->

            <!-- Add new -->
            <a ui-sref="resource-create" class="btn btn-primary" ng-click="vm.create()">
                <span class="ion-plus"></span>
                Add new
            </a>
            <!-- Add new -->

            <!-- Edit -->
            <button type="button" class="btn btn-default" ng-disabled="!vm.canEdit()" ng-click="vm.edit()">
                <span class="ion-edit"></span>
                Edit
            </button>
            <!-- Edit -->

            <!-- Delete -->
            <button type="button" class="btn btn-default" ng-disabled="!vm.canRemove()" ng-click="vm.remove()">
                <span class="ion-trash-b"></span>
                Delete
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
        <!-- Top Container -->

        <!-- Bottom Container -->
        <div class="well">

            <h1>{{ str_plural($model->name()) }}</h1>

            <table class="table table-striped table-responsive">
                <thead>
                <tr>
                    <th>
                        <input type="checkbox" ng-model="vm.selectAll" ng-change="vm.updateSelectAll()">
                    </th>
                    @foreach($model->attributes() as $attribute)
                        <th>{{ $attribute->title() }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="model in vm.getModels() track by $index" ng-class="{ danger: model._meta.removed }">
                    <td>
                        <input type="checkbox" ng-model="model._meta.selected" ng-disabled="model._meta.removed">
                    </td>
                    <td ng-repeat="value in vm.getModelValues(model) track by $index" ng-bind="value"></td>
                </tr>
                </tbody>
            </table>

        </div>
        <!-- Bottom Container -->

    </div>
@endsection