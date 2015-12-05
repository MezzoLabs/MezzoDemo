<div class="row">
    <div class="col-md-9">
        <div class="content-blocks" ui-sortable="vm.contentBlockService.sortableOptions" ng-model="vm.contentBlockService.contentBlocks">
            <div class="content-block" ng-repeat="block in vm.contentBlockService.contentBlocks">
                <div class="content-block-heading">
                    <b>@{{ block.title }}</b>

                    <div class="content-block-actions">
                        <a class="" href="#"><i class="ion-ios-gear"></i></a>
                        <a href="#"><i class="ion-arrow-move"></i></a>
                        <a href="#"><i class="ion-ios-close-empty" ng-click="vm.contentBlockService.removeContentBlock($index)"></i></a>
                    </div>
                </div>
                <div class="content-block-body block-@{{ block.key }}" mezzo-compile-html="block.template"></div>
            </div>
        </div>

    </div>
    <div class="col-md-3">
        <h3>Block Types</h3>

        <div class="list-group">
            @foreach(\MezzoLabs\Mezzo\Modules\Contents\Types\BlockTypes\ContentBlockTypeRegistrar::make()->all() as $blockType)
                <button type="button" class="list-group-item"
                        ng-click="vm.contentBlockService.addContentBlock('{{ addslashes($blockType->key()) }}', '{{ $blockType->hash() }}', '{{ $blockType->title() }}')">
                    <i class="{{ $blockType->icon() }}"></i>
                    {{ $blockType->title() }}
                </button>
            @endforeach
        </div>
    </div>

</div>