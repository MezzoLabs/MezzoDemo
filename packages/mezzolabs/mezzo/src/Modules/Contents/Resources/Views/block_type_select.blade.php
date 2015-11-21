@foreach($blocks as $block)
    <button type="button" class="btn btn-small btn-default" ng-click="vm.addContentBlock('{{ $block->key() }}', '{{ $block->title() }}', '{{ $block->hash() }}', '{{ $block->propertyInputName('class') }}')">
        <i class="{{ $block->icon() }}"></i>
        {{ $block->title() }}
    </button>
@endforeach