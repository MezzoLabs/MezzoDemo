<div class="row">
    <div class="col-md-8">
        <div class="content-blocks">
            <div class="content-block" ng-repeat="block in vm.contentBlocks">
                <div class="content-block-heading">
                    <b>@{{ block.title }}</b>
                    <small>@{{ block.hash }}</small>
                    <div class="content-block-actions">
                        <a class="" href="#"><i class="ion-ios-gear"></i></a>
                        <a href="#"><i class="ion-arrow-move"></i></a>
                        <a href="#"><i class="ion-ios-close-empty"></i></a>
                    </div>
                </div>
                <div class="content-block-body block-@{{ block.key }}" ng-bind-html="block.template"></div>
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <h3>Block Types</h3>

        <div class="list-group">
            @foreach(\MezzoLabs\Mezzo\Modules\Contents\Types\BlockTypes\ContentBlockTypeRegistrar::make()->all() as $block)
                <button type="button" class="list-group-item"
                        ng-click="vm.addContentBlock('{{ addslashes($block->key()) }}', '{{ $block->title() }}', '{{ $block->hash() }}', '{{ $block->propertyInputName('class') }}')">
                    <i class="{{ $block->icon() }}"></i>
                    {{ $block->title() }}
                </button>
            @endforeach
        </div>
    </div>

</div>