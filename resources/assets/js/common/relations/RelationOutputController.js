export default class RelationOutputController {
    constructor($scope, eventDispatcher) {
        this.$scope = $scope;
        this.eventDispatcher = eventDispatcher;

        this.items = {};
        this.searchText = "";


        this.setListeners();
    }

    setListeners() {
        this.eventDispatcher.getOrListenFor('form.received', (event) => {
            this.fillItems(event.payload.data[this.naming]);
        });
    }

    fillItems(items) {
        this.items = items;
    }

    filteredItems() {
        return _.filter(this.items, (item) => {
            return this.itemIsInSearch(item);
        });
    }

    itemIsInSearch(item) {
        if (this.searchText.length == 0) {
            return true;
        }

        for (var key in item) {
            if (item.hasOwnProperty(key)) {
                var value = item[key];

                if (String(value).toLowerCase().indexOf(this.searchText.toLowerCase()) !== -1) {
                    return true;
                }
            }
        }

        return false;

    }

}