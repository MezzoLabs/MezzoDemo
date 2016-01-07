@extends('cockpit::layouts.default.content.container')


@section('content')
    <div class="wrapper"
         ng-init="vm.init('{{ $model_reflection->slug() }}', {!! str_replace('"', "'", $model_reflection->defaultIncludes()->toJson()) !!})">

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
        <!-- Top Container -->

        <!-- Bottom Container -->
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <h3>{{ str_plural($model_reflection->name()) }}</h3>
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
                        <th>
                            <input type="checkbox" ng-model="vm.selectAll" ng-change="vm.updateSelectAll()">
                        </th>
                        @foreach($model_reflection->attributes()->visibleInForm('index') as $attribute)
                            <th ng-init="vm.addAttribute('{{ $attribute->naming() }}', '{{ $attribute->type()->doctrineTypeName() }}')">{{ $attribute->title() }}</th>
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

            </div>
        </div>
        <!-- Bottom Container -->

    </div>
@endsection