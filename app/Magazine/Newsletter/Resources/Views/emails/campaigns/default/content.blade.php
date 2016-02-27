@foreach($content->blocks->sortBy('sort') as $block)

    <div class="content_block content_block--{{ $block->shortTypeKey() }}">
        @if(View::exists('modules.newsletter::emails.campaigns.content_blocks.' . $block->shortTypeKey()))
            @include('modules.newsletter::emails.campaigns.content_blocks.' . $block->shortTypeKey(), ['block' => $block])
        @else
            <h1>Content block is not available for newsletters: {{ $block->shortTypeKey() }}</h1>
        @endif

    </div>

@endforeach