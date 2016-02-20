@foreach($block->getImages() as $image)
    @include('magazine.partials.image', ['image' => $image])
@endforeach