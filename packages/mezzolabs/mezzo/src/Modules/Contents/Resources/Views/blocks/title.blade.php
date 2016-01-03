@extends('modules.contents::block_container')

@section('content')
    <div class="form-group">
        <input type="text" name="{{ $block->inputName('title') }}" class="form-control"/>
    </div>
@endsection


