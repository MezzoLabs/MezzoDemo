@if($image)

    <img class="img-responsive" src="{{ $image->file->url() }}"/>

    @if(!empty($image->caption))
        <span class="caption">{{ $image->caption }}</span>
    @endif

@else
    <img src=""/>
    <span class="caption">Image not found</span>
@endif
