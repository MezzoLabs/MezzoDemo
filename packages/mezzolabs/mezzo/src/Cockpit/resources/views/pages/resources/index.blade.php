<div>
    <label>Search</label>
    <input name="search" class="form-control" type="search"/>
</div>

<h1>{{ str_plural($model->name()) }}</h1>

<table class="table" data-model="{{ $model->name() }}">
    @foreach($model->attributes() as $attribute)
        <th>{{ $attribute->title() }}</th>@endforeach
</table>
