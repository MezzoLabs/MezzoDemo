@extends('modules.contents::block_container')

@section('content')
    <div class="form-group">
        <label>{{ $fields['images']->title() }}</label>
        {!! $formBuilder->filePicker($block->inputName('images'), new \App\ImageFile(), ['multiple' => true, 'attributes'=> ['data-value' => '@{{ block.fields.images }}']]) !!}
    </div>
    <div class="form-group">
        <label>Display</label>
        <select class="form-control" name="{{ $block->optionInputName('display') }}">
            <option ng-selected="block.options.display == 'grid'" value="grid">Grid</option>
            <option ng-selected="block.options.display == 'list'" value="list">List</option>
            <option ng-selected="block.options.display == 'lightbox'" value="lightbox">Lightbox</option>
        </select>
    </div>
@endsection
