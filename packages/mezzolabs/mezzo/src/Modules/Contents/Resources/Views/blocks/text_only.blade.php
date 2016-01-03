@extends('modules.contents::block_container')

@section('content')
    <div class="form-group">
        <label>{{ $fields['text']->title() }}</label>
        <textarea name="{{ $block->inputName('text') }}" class="form-control"></textarea>
    </div>
@endsection


