@extends('modules.contents::block_container')

@section('content')
    <div class="form-group">
        <textarea data-mezzo-richtext name="{{ $block->inputName('text') }}" class="form-control"></textarea>
    </div>
@endsection


