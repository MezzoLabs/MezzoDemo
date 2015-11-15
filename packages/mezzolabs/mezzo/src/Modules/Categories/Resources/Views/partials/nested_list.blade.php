<li>{{ $element->label }}
    <ul>
        @foreach($element->children as $child)

            @include('modules.categories::partials.nested_list', ['element' => $child])

        @endforeach
    </ul>
</li>
