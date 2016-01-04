<ul>
    @foreach($children as $category)
        <li>
            <input name="categories[{{ $category->id }}]" type="checkbox"/>{{ $category->label }}<br/>

            @include('magazine.profile.liked_category_children', ['children' => $category->children])
        </li>
    @endforeach
</ul>

