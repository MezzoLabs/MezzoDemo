@extends('modules.contents::block_container')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ $fields['text']->title() }}</label>
                <textarea
                        {!! $block->form()->htmlAttributes('text', ['ng-value' => null]) !!} class="form-control">@{{ block.fields.text }}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ $fields['image']->title() }}</label>
                {!! $formBuilder->filePicker($block->inputName('image'), new \App\ImageFile(), ['multiple' => false, 'attributes'=> ['data-value' => '@{{ block.fields.image }}']]) !!}
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Image position</label>

        <div class="radio-inline">
            <label><input type="radio"
                          ng-checked="@{{ !block.options.image_position || block.options.image_position == 'left' }}"
                          class="" name="{{ $block->optionInputName('image_position') }}"
                          value="left">Left</label>
        </div>
        <div class="radio-inline">
            <label><input type="radio" ng-checked="@{{ block.options.image_position == 'right' }}" class=""
                          name="{{ $block->optionInputName('image_position') }}"
                          value="right">Right</label>
        </div>
        <div class="radio-inline">
            <label><input type="radio" ng-checked="@{{ block.options.image_position == 'above' }}" class=""
                          name="{{ $block->optionInputName('image_position') }}"
                          value="above">Above</label>
        </div>
        <div class="radio-inline">
            <label><input type="radio" ng-checked="@{{ block.options.image_position == 'below' }}" class=""
                          name="{{ $block->optionInputName('image_position') }}"
                          value="below">Below</label>
        </div>
    </div>
@endsection

