@if(!empty($module_page->filtersView))
@include($module_page->filtersView)
@endif

<!-- Bottom Container -->
<div class="panel panel-bordered">

    <div class="panel-heading">
        <h3>{{ $model_reflection->pluralTitle() }} (@{{ vm.totalCount }})</h3>
    </div>
    <div class="panel-body">
        <div class="progress" ng-show="vm.loading">
            <div class="progress-bar progress-bar-danger progress-bar-striped active" style="width: 100%">Please
                be patient...
            </div>
        </div>

        <div class="table-responsive">
            <table class="resource-index-table table table-responsive">
                @include('cockpit::partials.pages.index_table_heading')
                @include('cockpit::partials.pages.index_table_body')
            </table>
        </div>

        @include('cockpit::partials.pages.index_pagination')


    </div>
</div>
<!-- Bottom Container -->