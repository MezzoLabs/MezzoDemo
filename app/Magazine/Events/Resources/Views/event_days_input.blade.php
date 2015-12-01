<div class="list-group">
    <div class="list-element"></div>
</div>
{!! cockpit_form()->openNestedRelation($renderer->attribute()) !!}

@if($renderer->value())
    @foreach($renderer->value() as $index => $day)
        <div class="row">
            <?php if ($index === "new") continue; ?>
            <div class="col-md-5">
                {!! $renderer->renderNested('start', ['value' => $renderer->dateTimeLocal($day['start']), 'index' => $index]) !!}

            </div>
            <div class="col-md-5">
                {!! $renderer->renderNested('end', ['value' => $renderer->dateTimeLocal($day['end']), 'index' => $index]) !!}
            </div>
        </div>
    @endforeach
@endif
<div class="row">

    <div class="col-md-5">
        {!! $renderer->renderNested('start', ['index' => 'new']) !!}

    </div>
    <div class="col-md-5">
        {!! $renderer->renderNested('end', ['index' => 'new']) !!}
    </div>
</div>
{!! cockpit_form()->closeNestedRelation() !!}
