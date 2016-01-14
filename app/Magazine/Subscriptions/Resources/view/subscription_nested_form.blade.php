{!! cockpit_form()->openNestedRelation($renderer->attribute()) !!}

<div class="row days">
    <div class="col-md-6">
        {!! $renderer->renderNested('plan') !!}
    </div>
    <div class="col-md-6">
        {!! $renderer->renderNested('subscribed_until') !!}
    </div>
</div>

{!! cockpit_form()->closeNestedRelation() !!}
