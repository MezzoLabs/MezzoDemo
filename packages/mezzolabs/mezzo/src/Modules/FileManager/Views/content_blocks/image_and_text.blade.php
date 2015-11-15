<div class="form-group">
    <label>{{ $fields['text']->title() }}</label>
    <textarea name="{{ $block->inputName('text') }}" class="form-control"></textarea>
</div>

<div class="form-group">
    <label>{{ $fields['image']->title() }}</label>

    <p><input type="button" class="btn btn-default" value="Select image"/></p>
    <input type="hidden" value="" name="{{ $block->inputName('image') }}">
</div>

<div class="form-group">
    <label>Image position</label>

    <div class="radio">
        <label><input type="radio" class="" name="{{ $block->optionInputName('image_position') }}"
                      value="left">Left</label>
    </div>
    <div class="radio">
        <label><input type="radio" class="" name="{{ $block->optionInputName('image_position') }}"
                      value="right">Right</label>
    </div>
</div>

