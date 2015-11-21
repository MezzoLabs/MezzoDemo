<div class="panel-body row">
    <div class="col-md-9">
        <h4>Blocks</h4>
    </div>

    <div class="col-md-3">
        <h4>Add new Content</h4>

        <div class="list-group">
            @foreach(\MezzoLabs\Mezzo\Modules\Contents\Types\BlockTypes\ContentBlockTypeRegistrar::make()->all() as $block)
                <a class="list-group-item btn-default" href="#"><i
                            class="{{ $block->icon() }}"></i> {{ $block->title() }}</a>
            @endforeach
        </div>
    </div>

</div>

