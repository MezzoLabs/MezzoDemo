@extends('cockpit::pages.layouts.create_or_edit')

@section('form_content')
    {!! $model_reflection->attributes('voucher_key')->render() !!}
    {!! $model_reflection->attributes('type')->render() !!}
    {!! $model_reflection->attributes('is_global')->render() !!}
    {!! $model_reflection->attributes('active_until')->render() !!}

    {!! $model_reflection->attributes('options')->render() !!}

    <div ng-if="!vm.inputs['is_global']">
        {!! $model_reflection->attributes('only_for_id')->render() !!}
        {!! $model_reflection->attributes('redeemed_at')->render() !!}
        {!! $model_reflection->attributes('redeemed_by_id')->render() !!}
    </div>
    <div ng-if="vm.inputs['is_global']">
        {!! $model_reflection->attributes('redeemedByUsers')->render(['wrap' => false]) !!}
    </div>

@endsection