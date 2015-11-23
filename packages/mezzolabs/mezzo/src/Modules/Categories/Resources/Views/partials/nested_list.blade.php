<div class="list-group-item">
    <?php for ($x = 0; $x != $level; $x++) echo ' - '; ?> {{ $element->label }}
</div>
@foreach($element->children as $child)
    @include('modules.categories::partials.nested_list', ['element' => $child, 'level' => $level++])
@endforeach

