<div class="list-group">
    <div class="list-element"></div>
</div>
<div class="row">
    {!! cockpit_form()->openNestedRelation($renderer->attribute()) !!}}

    @if($renderer->value())
        @foreach($renderer->value() as $index => $day)
            <div class="col-md-5">
                {!! $renderer->renderNested('start', ['value' => $day['start'], 'index' => $index]) !!}

            </div>
            <div class="col-md-5">
                {!! $renderer->renderNested('end', ['value' => $day['end'], 'index' => $index]) !!}
            </div>
            <div class="col-md-2">
                <button class="btn btn-small btn-secondary btn-block">Add day</button>
            </div>
        @endforeach
    @endif
    <div class="col-md-2">
        <button class="btn btn-small btn-secondary btn-block">Add day</button>
    </div>
    {!! cockpit_form()->closeNestedRelation() !!}
</div>
