<div class="row">
    <div class="col-md-4">
        {!! cockpit_form()->relationship($renderer->attribute(), ['multiple' => null]) !!}
    </div>
    @foreach($renderer->attribute()->relation()->pivotAttributes() as $pivotAttribute)
        <div class="col-md-4">
            {!! $pivotAttribute->render(['namePrefix' =>  $renderer->attribute()->name() . '.@{{ $index }}.pivot_']) !!}
        </div>
    @endforeach
    <div class="clearfix"></div>
</div>