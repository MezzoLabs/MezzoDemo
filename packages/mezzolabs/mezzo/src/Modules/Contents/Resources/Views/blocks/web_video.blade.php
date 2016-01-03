@extends('modules.contents::block_container')

@section('content')
    <div class="form-group">
        <label>{{ $fields['url']->title() }}</label>
        <input class="form-control" type="url" placeholder="https://vimeo.com/12345678"
               name="{{ $block->inputName('url') }}"/>
    </div>
@endsection
