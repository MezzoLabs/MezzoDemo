@extends('modules.contents::block_container')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ $fields['text']->title() }}</label>
            <textarea name="{{ $block->inputName('text') }}"
                      class="form-control">{{ old($block->inputName('text')) }}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ $fields['image']->title() }}</label>

                {!! $formBuilder->filePicker($block->inputName('image'), new \App\ImageFile(), ['multiple' => false]) !!}
            </div>
        </div>
    </div>


    <div class="form-group">
        <label>Image position</label>

        <div class="radio">
            <label><input type="radio" checked="checked" class="" name="{{ $block->optionInputName('image_position') }}"
                          value="left">Left</label>
        </div>
        <div class="radio">
            <label><input type="radio" class="" name="{{ $block->optionInputName('image_position') }}"
                          value="right">Right</label>
        </div>
    </div>
@endsection

