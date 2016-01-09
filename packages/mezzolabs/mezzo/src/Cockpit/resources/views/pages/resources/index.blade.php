@extends('cockpit::layouts.default.content.container')


@section('content')

    <div class="panel panel-bordered">
        <div class="panel-body">
            <input type="text" class="form-control" mezzo-google-maps-search
                   street-number="streetNumber" street="street" city="city" state="state" country="country" postal-code="postalCode" latitude="latitude" longitude="longitude">
            <input name="streetNumber" class="form-control">
            <input name="street" class="form-control">
            <input name="city" class="form-control">
            <input name="state" class="form-control">
            <input name="country" class="form-control">
            <input name="postalCode" class="form-control">
            <input name="latitude" class="form-control">
            <input name="longitude" class="form-control">
        </div>
    </div>

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
                        <th></th>
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
                            <span class="locked-for-user" title="Locked by @{{ vm.lockedBy(model) }}"
                                  ng-show="vm.isLocked(model)"><i class="ion-ios-locked"></i></span>
                        </td>
                        <td>
                            <input type="checkbox" ng-model="model._meta.selected" ng-disabled="model._meta.removed">
                        </td>
                        <td ng-repeat="value in vm.getModelValues(model) track by $index">
                            <a href="" class="disabled" title="ID: @{{ model.id }}" ng-if="vm.displayAsLink($first, model)" ng-click="vm.editId(model.id)" ng-bind="value"></a>
                            <span ng-if="!vm.displayAsLink($first, model)" ng-bind="value"></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>

            </div>
        </div>
        <!-- Bottom Container -->

    </div>
@endsection