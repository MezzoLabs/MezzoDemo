<ul>
    @foreach($children as $category)
        <li>
            @if($user->likesCategory($category))
                <input name="categories[{{ $category->id }}]" checked type="checkbox"/>{{ $category->label }}<br/>
            @else
                <input name="categories[{{ $category->id }}]" type="checkbox"/>{{ $category->label }}<br/>
            @endif

            @include('magazine.profile.liked_category_children', ['children' => $category->children])
        </li>
    @endforeach
</ul>

