@extends('modules.contents::block_container')

@section('content')
    <div class="form-group">
        <label>{{ $fields['images']->title() }}</label>

        {!! $formBuilder->filePicker($block->inputName('images'), new \App\ImageFile(), ['multiple' => true]) !!}
    </div>


    <div class="form-group">
        <label>Display</label>

        <select name="{{ $block->optionInputName('display') }}">
            <option value="grid">Grid</option>
            <option value="list">List</option>
            <option value="lightbox">Lightbox</option>
        </select>
    </div>
@endsection

