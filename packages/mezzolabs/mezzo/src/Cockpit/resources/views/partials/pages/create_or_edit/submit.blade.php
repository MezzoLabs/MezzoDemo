@if($module_page->isType('create'))
    {!! cockpit_form()->submitCreate($model_reflection) !!}
@else
    {!! cockpit_form()->submitEdit($model_reflection) !!}
@endif