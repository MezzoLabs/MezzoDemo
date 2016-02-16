<div class="pivot-rows">
    <div class="pivot-row row" ng-repeat="pivotRow in vm.content.{{ $renderer->attribute()->name()  }}">
        <div class="col-md-4">
            {!! cockpit_form()->relationship($renderer->attribute(), ['multiple' => null, 'name' => $renderer->attribute()->name() . '.@{{ $index }}.id']) !!}
        </div>
        @foreach($renderer->attribute()->relation()->pivotAttributes() as $pivotAttribute)
            <div class="col-md-4">
                {!! $pivotAttribute->render(['attributes' => ['ng-model' => "vm.inputs['". $renderer->attribute()->name() .".'+" . '$index' . "+'.pivot_". $pivotAttribute->name() ."']"], 'namePrefix' =>  $renderer->attribute()->name() . '.@{{ $index }}.pivot_']) !!}
            </div>
        @endforeach
        <div class="clearfix"></div>
    </div>
</div>