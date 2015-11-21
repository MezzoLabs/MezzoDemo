<div class="panel-body row">
    <div class="col-md-8">
        <h3>Content Blocks</h3>
    </div>
    <div class="col-md-4">
        <h3>Block Types</h3>

        <div class="list-group">
            @foreach(\MezzoLabs\Mezzo\Modules\Contents\Types\BlockTypes\ContentBlockTypeRegistrar::make()->all() as $block)
                <button type="button" class="list-group-item"
                        ng-click="vm.addContentBlock('{{ $block->key() }}', '{{ $block->title() }}', '{{ $block->hash() }}', '{{ $block->propertyInputName('class') }}')">
                    <i class="{{ $block->icon() }}"></i>
                    {{ $block->title() }}
                </button>
            @endforeach
        </div>
    </div>

</div>