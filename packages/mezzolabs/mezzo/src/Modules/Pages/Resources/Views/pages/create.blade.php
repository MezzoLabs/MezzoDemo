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
                @foreach($model->attributes()->fillableOnly()->forget(['content_id', 'slug']) as $attribute)
                    <div class="form-group">
                        <label>{{ $attribute->title() }}</label>
                        {!! $attribute->render() !!}
                    </div>
                @endforeach
            </div>
        </div>
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <h3>Content</h3>

                <div class="panel-actions">
                </div>
            </div>
            <div class="panel-body">
                @include('modules.contents::block_type_select')
            </div>

            <div class="panel-heading" ng-repeat-start="block in vm.contentBlocks">
                <h3 ng-bind="block.title"></h3>
            </div>
            <div class="panel-body" ng-repeat-end>
                <input type="hidden" name="[[ block.propertyInputName ]]" value="[[ block.key ]]">
                <div class="block-[[ block.key ]]" ng-bind-html="block.template"></div>
            </div>

        <div class="panel panel-bordered">

            {!! cockpit_form()->submit('Save as new ' . $model->name()) !!}
        </div>


        {!! cockpit_form()->close() !!}
    </div>

@endsection