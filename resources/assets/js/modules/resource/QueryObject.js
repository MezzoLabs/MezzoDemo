import IndexResourceController from './IndexResourceController';

export default class QueryObject {
    constructor() {
        this.clear();
    }

    clear() {
        this.scopes = {};

        this.searchText = "";

        this.paginationObject = {
            offset: 0,
            limit: false
        };

        this.filters = {};

        this.sortings = {};

        this.overwritingParameters = {};
    }


    /**
     *
     * @param {string} column
     * @param {string} direction
     * @returns {QueryObject}
     */
    addSorting(column, direction) {
        this.sortings[column] = direction;

        return this;
    }

    /**
     *
     * @param {string} query
     * @returns {QueryObject}
     */
    search(query) {
        this.searchText = query;

        return this;
    }

    /**
     *
     * @param {int} offset
     * @param {int} limit
     * @returns {QueryObject}
     */
    pagination(offset, limit) {
        this.paginationObject.offset = offset;
        this.paginationObject.limit = limit;

        return this;
    }

    /**
     *
     * @param {string} column
     * @param {string} value
     * @returns {QueryObject}
     */
    addFilter(column, value) {
        this.filters[column] = value


        return this;
    }

    /**
     *
     * @param {string} name
     * @param {Array} parameters
     */
    addScope(name, parameters) {
        this.scopes[name] = _.values(parameters);
    }

    /**
     * Get the parameters for this query.
     *
     * @returns {Object}
     */
    getParameters() {
        var parameters = {};

        if (_.size(this.sortings) > 0) {
            parameters.sort = this.sortString();
        }

        if (this.paginationObject.offset != 0 || this.paginationObject.limit) {
            parameters.offset = this.paginationObject.offset;
            parameters.limit = this.paginationObject.limit;
        }

        if (this.searchText != "") {
            parameters.q = this.searchText;
        }

        if (_.size(this.scopes) > 0) {
            parameters.scopes = this.scopes;
        }

        return _.merge(parameters, this.overwritingParameters);
    }

    /**
     *
     * @returns {string}
     */
    sortString() {
        var sortingStrings = [];

        for (var column in this.sortings) {
            var direction = this.sortings[column];

            if (direction == "asc" || direction == "ascending" || direction == "" || direction == false) {
                sortingStrings.push(column);
                continue;
            }

            sortingStrings.push('-' + column);
        }

        return sortingStrings.join(',');
    }

    /**
     *
     * @param {IndexResourceController} controller
     */
    static makeFromController(controller) {
        const queryObject = new QueryObject();

        if (controller.options.backendPagination) {
            queryObject.pagination((controller.currentPage - 1) * controller.perPage, controller.perPage);
        }

        queryObject.search(controller.searchText);

        _.forEach(controller.attributes, (attribute) => {
            if (attribute.order != '') {
                queryObject.addSorting(attribute.name, attribute.order);
            }
        });

        this.overwritingParameters = controller.formParameters;

        return queryObject;

    }


}