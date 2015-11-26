@foreach($model->attributes()->visibleInForm('create')->forget((isset($without))? $without : []) as $attribute)
    {!! $attribute->render() !!}
@endforeach

@if(!isset($hide_submit) || !$hide_submit)
    {!! cockpit_form()->submit('Save as new ' . $model->name()) !!}
@endif