@extends('cockpit::pages.layouts.edit')

@section('submit')
    <a class="btn btn-default" data-needs-confirmation="1" data-parameters='{ "mode": "test"}' data-mezzo-api-action
       href="/api/campaigns/@{{ vm.modelId }}/deliver">Test campaign</a>
    <a class="btn btn-secondary" data-needs-confirmation="1" data-parameters='{ "mode": "real"}' data-mezzo-api-action
       href="/api/campaigns/@{{ vm.modelId }}/deliver">Deliver campaign</a>
    @parent
@endsection