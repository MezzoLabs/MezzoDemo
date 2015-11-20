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

            <p><a type="button" href="{{ route('cockpit::file.index') }}" class="btn btn-default">Select image</a></p>
            <input type="text" class="form-control" value="{{ old($block->inputName('image')) }}"
                   name="{{ $block->inputName('image') }}">
        </div>
    </div>
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

