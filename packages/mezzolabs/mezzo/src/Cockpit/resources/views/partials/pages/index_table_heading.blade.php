<thead class="resource-index-table-head">
<tr>
    <th></th>
    <th>
        <input type="checkbox" ng-model="vm.selectAll" ng-change="vm.updateSelectAll()">
    </th>

    @foreach($module_page->columns() as $name => $column)
        <th ng-init="vm.addAttribute('{{ $name }}', '{{ $column['type'] }}')">
            {{ $column['title'] }}
            <span ng-if="vm.useSortings('{{ $name }}')" href="#" ng-click="vm.sortBy('{{ $name }}')" class="sortby"><i
                        ng-class="vm.sortIcon('{{ $name }}')"></i></span>
            <input ng-if="vm.useFilters()" class="form-control input-sm" type="search" ng-model="vm.attributes.{{ $name }}.filter">
        </th>
    @endforeach
</tr>
</thead>