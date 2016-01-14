@foreach($model_reflection->attributes()->visibleInForm('edit')->forget((isset($without))? $without : []) as $attribute)
    {!! $attribute->render() !!}
@endforeach

@if(!isset($hide_submit) || !$hide_submit)
    {!! cockpit_form()->submit('Update ' . $model_reflection->name()) !!}
@endif