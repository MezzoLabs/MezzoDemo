import QueryObject from './QueryObject';

export default class IndexResourceController {

    /*@ngInject*/
    constructor($scope, api, modelStateService, languageService, eventDispatcher) {
        this.$scope = $scope;
        this.api = api;
        this.lang = languageService;
        this.modelStateService = modelStateService;
        this.includes = [];
        this.language = languageService;
        this.models = [];
        this.modelValues = {};
        this.searchText = '';
        this.searchText = '';
        this.selectAll = false;
        this.loading = false;
        this.attributes = {};
        this.perPage = 15;
        this.currentPage = 1;
        this.options = {
            backendPagination: false
        };
        this.eventDispatcher = eventDispatcher;
        this.totalCount = 0;
        this.pagination = {
            size: 10
        };

        this.queryObject = QueryObject.makeFromController(this);
        this.formParameters = {};

        this.$scope.$on('$destroy', () => this.onDestroy());
    }

    init(modelName, defaultIncludes, options) {
        this.modelName = modelName;
        this.modelApi = this.api.model(modelName);
        this.includes = defaultIncludes;
        this.options = _.merge(this.options, options);

        this.loadModels();
    }

    addAttribute(name, type, options = {}) {
        this.attributes[name] = {name: name, type: type, order: '', filter: '', options: options};
    }

    attribute(name) {
        return _.find(this.attributes, ['name', name]);
    }

    loadModels(params = {}) {
        this.loading = true;
        params.include = this.includes.join(',');

        this.queryObject = QueryObject.makeFromController(this);

        params = _.merge(this.queryObject.getParameters(), params);

        return this.modelApi.index(params)
            .then(data => {
                const latestResponse = this.modelApi.latestResponse();

                this.loading = false;
                this.models = data;

                if (this.options.backendPagination) {
                    this.totalCount = latestResponse.headers('X-Total-Count');
                } else {
                    this.totalCount = _.size(this.models);
                }

                this.models.forEach(model => model._meta = {});
            });
    }

    getModels() {
        if (this.searchText.length > 0 || this.hasFilters()) {
            return this.search();
        }

        return this.models;
    }

    hasFilters() {
        for (var i in this.attributes) {
            if (this.attributes[i].filter != "") return true;
        }

        return false;
    }

    getPagedModels() {
        var models = this.getModels();

        if (this.options.backendPagination) {
            return models;
        }

        var start = (this.currentPage - 1) * this.perPage;
        var end = (this.currentPage) * this.perPage - 1;

        return models.slice(start, end);
    }

    getModelKeys(model) {
        if (this.models.length > 0 && !model) {
            model = this.models[0];
        }

        if (!model) {
            return [];
        }

        var keys = Object.keys(model);

        return keys.filter(key => key !== '_meta' && model.hasOwnProperty(key));
    }

    getModelValues(model) {
        var values = {};

        for (var i in this.attributes) {
            var attribute = this.attributes[i];
            values[attribute.name] = this.transformModelValue(attribute, model[attribute.name]);
        }

        this.modelValues[model.id] = values;

        return values;
    }

    transformModelValue(attribute, value) {

        if (value && typeof value === "object") {
            if (Object.prototype.toString.call(value.data) === "[object Array]") {
                return this.transformArrayValueToString(name, value.data);
            }

            if (Object.prototype.toString.call(value.data) === "[object Object]") {
                return this.transformObjectValueToString(name, value.data);
            }
        }

        if (value && attribute.type == "datetime") {
            return moment(value).format('DD.MM.YYYY hh:mm');
        }

        if (value && attribute.type == "distance") {
            return parseFloat(value) ;
        }

        if (this.lang.has('attributes.' + attribute.name + '.' + value)) {
            return this.lang.get('attributes.' + attribute.name + '.' + value);
        }

        if (attribute.type == "boolean") {
            return this.lang.get('attributes.boolean.' + (value == "1") ? "true" : "false");
        }


        return value;
    }

    transformArrayValueToString(name, array) {
        var labels = [];

        for (var i in array) {
            labels.push(this.transformObjectValueToString(name, array[i]));
        }

        return labels.join(', ');
    }

    transformObjectValueToString(name, object) {
        return object._label;
    }

    canEdit() {
        return this.selected().length === 1;
    }

    canRemove() {
        return this.selected().length > 0;
    }

    search() {
        var searched = this.models.filter(model => {
            return this.modelIsInSearch(model) && this.modelIsInFilters(model);

        });

        return searched;
    }

    modelIsInSearch(model) {
        if (this.searchText.length == 0) {
            return true;
        }

        for (var key in model) {
            if (model.hasOwnProperty(key)) {
                var value = model[key];

                if (String(value).toLowerCase().indexOf(this.searchText.toLowerCase()) !== -1) {
                    return true;
                }
            }
        }

        return false;
    }

    modelIsInFilters(model) {
        var values = this.modelValues[model.id];

        for (var key in values) {
            var value = values[key];
            var attribute = this.attribute(key);


            if (!attribute || !attribute.filter || attribute.filter == "") continue;

            if (!value) {
                return false;
            }

            if (String(value).toLowerCase().indexOf(attribute.filter.toLowerCase()) === -1) {
                return false;
            }

        }

        return true;


    }

    updateSelectAll() {
        var models = this.getModelsgetModels();

        models.forEach(model => model._meta.selected = this.selectAll);
    }

    selected() {
        return this.models.filter(model => model._meta.selected);
    }

    create() {
    }

    editId(id) {
        this.modelStateService.name(this.modelName).id(id).edit();
    }

    remove() {
        var selected = this.selected();

        swal({
            title: this.language.get('messages.shure_to_delete_models.title'),
            text: this.language.get('messages.shure_to_delete_models.text', selected.length, {count: selected.length}),
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: this.language.get('general.delete'),
            confirmButtonColor: '#fb503b'
        }, confirmed => {
            if (!confirmed) {
                return;
            }

            selected.forEach(model => this.removeModel(model));
        });
    }

    removeModel(model) {
        this.selectAll = false;

        this.modelApi.delete(model.id);

        for (var i = 0; i < this.models.length; i++) {
            if (this.models[i] === model) {
                return this.models.splice(i, 1);
            }
        }
    }

    countSelected() {
        return this.selected().length;
    }

    isLocked(model) {
        return model._locked_for_user;

    }

    lockedBy(model) {
        return model._locked_by;
    }

    displayAsLink($first, model) {
        return $first && !this.isLocked(model) && (!model._permissions || model._permissions.edit);
    }

    /**
     *
     * Apply parameters that were given in the API-Query formular.
     *
     * @param $event
     */
    applyScopes($event) {
        const $formInputs = $($event.target).parents('form').find(':input');
        const params = {};

        $formInputs.each((index, formInput) => {
            const $formInput = $(formInput);
            const inputName = $formInput.attr('name');
            const inputValue = $formInput.val();

            if (!inputName || !inputValue) {
                return;
            }

            params[inputName] = inputValue;
        });

        this.formParameters = params;

        this.loadModels(params);
    }

    /**
     * Triggered when the user hits a pagination link.
     */
    pageChanged() {
        if (!this.options.backendPagination) {
            return;
        }

        this.loadModels();
    }

    /**
     *
     *
     * @param name
     * @returns {string}
     */
    sortIcon(name) {
        switch (this.attribute(name).order) {
            case 'desc':
                return 'fa fa-sort-desc';
            case 'asc':
                return 'fa fa-sort-asc';
            default:
                return 'fa fa-sort';
        }
    }

    /**
     * Move the sorting of a certain column one step further.
     * (desc -> asc -> none)
     *
     * @param name
     */
    sortBy(name) {
        _.forEach(this.attributes, (attribute) => {
            if (attribute.name != name) {
                attribute.order = '';
            }
        });

        var base = this;
        var attribute = this.attribute(name);
        attribute.order = this.nextOrderDirection(attribute.order);

        if (!this.options.backendPagination) {
            return this.clientSideSort(attribute);
        }

        this.loadModels();
    }

    /**
     *
     * Perform a client side sorting, this is only possible if we have all the models.
     * In other words, we can only do this if we dont use the client side pagination.
     *
     * @param name
     * @param order
     * @returns {*}
     */
    clientSideSort(attribute, order) {
        switch (attribute.order) {
            case 'desc':
                return this.models = _.sortBy(this.getModels(),  (model) => {
                    return this.sortByFunction(model, attribute)
                }).reverse();
            case 'asc':
                return this.models = _.sortBy(this.getModels(),  (model) => {
                    return this.sortByFunction(model, attribute)
                });
            default:
                return this.models = _.sortBy(this.getModels(), 'id');
        }
    }

    sortByFunction(model, attribute) {
        var value = model[attribute.name];


        if (attribute.type == "datetime") {
            if (!value || !moment(value).isValid())
                return "";

            return moment(value).format('YYYY-MM-DD-HH-mm');
        }

        if (value && typeof(value) == 'number') {
            return value;
        }


        return String(value).toLowerCase();
    }

    nextOrderDirection(orderDirection) {
        switch (orderDirection) {
            case 'desc':
                return 'asc';
            case 'asc':
                return '';
            default:
                return 'desc';
        }
    }

    useFilters() {
        return !this.options.backendPagination;
    }

    useSortings(column) {
        var attribute = this.attribute(column);

        if(!attribute){
            return false;
        }

        if(!this.options.backendPagination){
            return true;
        }

        return attribute.options.column != "";
    }

    useSearch() {
        return !this.options.backendPagination;

    }

    buildQuery() {

    }

    filterChanged(){
        console.log('filter changed');
    }

    onDestroy() {

    }

}