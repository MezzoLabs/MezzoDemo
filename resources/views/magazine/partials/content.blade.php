@foreach($content->blocks->sortBy('sort') as $block)

    <div class="content_block content_block--{{ $block->shortTypeKey() }}">
        @include('magazine.partials.content_blocks.' . $block->shortTypeKey(), ['block' => $block])

    </div>

@endforeach