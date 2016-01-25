<div class="text-right" style="padding-right: 10px;">
    <uib-pagination last-text="{{ Lang::get('mezzo.general.pagination.last') }}"
                    first-text="{{ Lang::get('mezzo.general.pagination.first') }}" force-ellipses="true"
                    boundary-links="true" max-size="vm.pagination.size" total-items="vm.getModels().length"
                    previous-text="<" next-text=">" ng-model="vm.currentPage" items-per-page="vm.perPage"
                    ng-change="vm.pageChanged()"></uib-pagination>
</div>