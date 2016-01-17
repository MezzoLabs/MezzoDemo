<mezzo-event-days naming="{{ $renderer->attribute()->relationSide()->naming() }}"></mezzo-event-days>

{!! cockpit_form()->openNestedRelation($renderer->attribute()) !!}
<div class="row days">
    <div class="col-md-5">
        {!! $renderer->renderNested('start', ['attributes' => ['index' => 'new'], 'wrap' => false]) !!}

    </div>
    <div class="col-md-5">
        {!! $renderer->renderNested('end', ['attributes' => ['index' => 'new'], 'wrap' => false]) !!}
    </div>
    <div class="col-md-2">
        <button class="btn btn-default btn-sm"><i class="ion-ios-close"></i></button>
    </div>
</div>
<br/>
<div class="row ">
    <div class="col-md-12">
        <button class="btn btn-default btn-block">Add</button>
    </div>
</div>
{!! cockpit_form()->closeNestedRelation() !!}
