@if($module_page->isType('create'))
    @include('cockpit::partials.pages.create_wrapper_open')
@else
    @include('cockpit::partials.pages.edit_wrapper_open')
@endif