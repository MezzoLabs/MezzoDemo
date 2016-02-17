<div class="list-group-item">
    <?php for ($x = 0; $x != $element->level; $x++) echo "&nbsp;&nbsp;&nbsp" ?>@if($element->level > 0)
        - @endif {{ $element->label }} [{{ $element->slug }}]
</div>
@foreach($element->children as $child)
    <?php $child->level = $element->level + 1; ?>
    @include('modules.categories::partials.nested_list', ['element' => $child])
@endforeach

