{!! cockpit_form()->openNestedRelation($renderer->attribute()) !!}
<div class="row">
    <div class="col-md-5">
        {!! $renderer->renderNested('start', ['index' => 'new']) !!}

    </div>
    <div class="col-md-5">
        {!! $renderer->renderNested('end', ['index' => 'new']) !!}
    </div>
</div>
{!! cockpit_form()->closeNestedRelation() !!}
