@if ($block->getOption('image_position') == "above")
    @include('magazine.partials.image', ['image' => $block->getImage()])
    <div class=text">{!! $block->getFieldValue('text') !!}</div>
@endif

@if ($block->getOption('image_position') == "right")
    <div class="row">
        <div class="col-md-6">
            <div class=text">{!! $block->getFieldValue('text') !!}</div>
        </div>
        <div class="col-md-6">
            @include('magazine.partials.image', ['image' => $block->getImage()])
        </div>
    </div>
@endif

@if ($block->getOption('image_position') == "left")
    <div class="row">
        <div class="col-md-6">
            @include('magazine.partials.image', ['image' => $block->getImage()])
        </div>
        <div class="col-md-6">
            <div class=text">{!! $block->getFieldValue('text') !!}</div>
        </div>
    </div>
@endif

@if ($block->getOption('image_position') == "below")
    <div class=text">{!! $block->getFieldValue('text') !!}</div>
    @include('magazine.partials.image', ['image' => $block->getImage()])
@endif

