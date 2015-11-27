<ul class="list-unstyled list-categories">
    @foreach($categories as $category)
        <li class="checkbox">
            <label>
                <input type="checkbox" name="{{ $renderer->name() }}[{{ $category->id }}]" value="">
                {{ $category->label }}
            </label>
            @include('cockpit::partials.categories_input_items', ['categories' => $category->children()->get()])
        </li>
    @endforeach
</ul>