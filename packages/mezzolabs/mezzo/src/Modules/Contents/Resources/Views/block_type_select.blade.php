@foreach($blocks as $block)
    <a class="btn btn-small btn-default" href="#"><i class="{{ $block->icon() }}"></i> {{ $block->title() }}</a>
@endforeach