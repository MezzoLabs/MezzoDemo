@extends('cockpit::layouts.default.content.container')


@section('content')

    <div class="wrapper">
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <h3>{{ str_plural($model->name()) }}</h3>

                <div class="panel-actions">
                </div>
            </div>
            <div class="panel-body">

                @include('cockpit::pages.resources.index.actions')

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
        </div>
    </div>

@endsection