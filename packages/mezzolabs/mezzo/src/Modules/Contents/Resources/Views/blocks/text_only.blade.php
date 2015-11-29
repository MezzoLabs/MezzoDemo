<input type="hidden" name="{{ $block->propertyInputName('class') }}" value="{{ $block->key() }}">
<input type="hidden" name="{{ $block->propertyInputName('id') }}" value="@{{ block.id }}">
<input type="hidden" name="{{ $block->propertyInputName('sort') }}" value="@{{ block.sort }}">

<div class="form-group">
    <label>{{ $fields['text']->title() }}</label>
    <textarea name="{{ $block->inputName('text') }}" class="form-control"></textarea>
</div>
