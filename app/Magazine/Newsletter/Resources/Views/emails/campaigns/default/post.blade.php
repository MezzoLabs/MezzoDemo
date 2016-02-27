<div class="post post--mode-{{ $mode }}">
    @if($mode == 'preview')
        Preview {{ $post->title }}
    @else
        Full {{ $post->title }}
    @endif
</div>

