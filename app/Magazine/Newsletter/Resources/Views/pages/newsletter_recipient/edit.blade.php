@extends('cockpit::pages.layouts.create_or_edit')

@section('submit')
    <a class="btn btn-secondary" data-parameters="" data-mezzo-api-action
       href="/api/newsletter-recipients/@{{ vm.modelId }}/resendConfirmation">Resend confirmation mail</a>
    @parent
@endsection