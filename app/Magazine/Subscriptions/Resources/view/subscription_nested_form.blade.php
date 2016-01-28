{!! cockpit_form()->openNestedRelation($renderer->attribute()) !!}

<div class="subscription_add">

    {!! $renderer->renderNested('plan') !!}

    {!! $renderer->renderNested('subscribed_until') !!}


    @if($module_page->isType('edit'))
        {!! $renderer->renderNested('cancelled') !!}
    @endif

</div>

{!! cockpit_form()->closeNestedRelation() !!}
