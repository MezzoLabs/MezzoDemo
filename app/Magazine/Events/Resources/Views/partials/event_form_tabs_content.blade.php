<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="general">
        {!! $model_reflection->schema()->attributes('title')->render() !!}
        {!! $model_reflection->schema()->attributes('description')->render() !!}
        {!! $model_reflection->schema()->attributes('user_id')->render() !!}
        {!! $model_reflection->schema()->attributes('event_provider_id')->render() !!}
    </div>
    <div role="tabpanel" class="tab-pane" id="days">
        {!! $model_reflection->schema()->attributes('days')->render() !!}
    </div>
    <div role="tabpanel" class="tab-pane" id="address">
        {!! $model_reflection->schema()->attributes('event_venue_id')->render() !!}
        <hr/>
        {!! $model_reflection->schema()->attributes('address_id')->render() !!}
    </div>
    <div role="tabpanel" class="tab-pane" id="categories">
        {!! $model_reflection->schema()->attributes('categories')->render() !!}
    </div>
</div>
<br/>