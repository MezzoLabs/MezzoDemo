@extends(cockpit_content_container())


@section('content')
    <div class="wrapper">
        {!! cockpit_form()->open(['route' => 'cockpit::page.store', 'method' => 'POST']) !!}
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <h3>New {{ $model->name() }}</h3>

                <div class="panel-actions">
                </div>
            </div>
            <div class="panel-body">
                @foreach($model->attributes()->fillableOnly() as $attribute)
                    <div class="form-group">
                        <label>{{ $attribute->title() }}</label>
                        {!! $attribute->render() !!}
                    </div>
                @endforeach
            </div>
            <div class="panel-heading">
                <h3>Content Blocks</h3>
            </div>
            <div class="panel-body">
                <button type="button" class="btn btn-primary" style="margin-right: 10px" ng-repeat="button in vm.contentBlockButtons" ng-click="vm.addContentBlock(button.contentBlock)">
                    <span ng-class="button.icon"></span>
                    <span ng-bind="button.label"></span>
                </button>
            </div>
            <div class="panel-heading">
                <h3>Content</h3>

                <div class="panel-actions">
                </div>
            </div>
            <div class="panel-body">

                <div sv-root sv-part="vm.contentBlocks">
                    <div ng-repeat="contentBlock in vm.contentBlocks" sv-element>
                        <div mezzo-compile="contentBlock.directive"></div>
                    </div>
                </div>

                <hr>

                {!! cockpit_form()->submit('Save as new ' . $model->name()) !!}

            </div>

        </div>
        {!! cockpit_form()->close() !!}
    </div>

@endsection