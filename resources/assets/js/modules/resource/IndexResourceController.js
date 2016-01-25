export default class IndexResourceController {

    /*@ngInject*/
    constructor($scope, api, modelStateService, languageService) {
        this.$scope = $scope;
        this.api = api;
        this.lang = languageService;
        this.modelStateService = modelStateService;
        this.includes = [];
        this.language = languageService;
        this.models = [];
        this.modelValues = {};
        this.searchText = '';
        this.selectAll = false;
        this.loading = false;
        this.attributes = [];
        this.perPage = 10;
        this.currentPage = 1;
        this.pagination = {
            size: 10
        };


    }

    init(modelName, defaultIncludes) {
        this.modelName = modelName;
        this.modelApi = this.api.model(modelName);
        this.includes = defaultIncludes;

        this.loadModels();
    }

    addAttribute(name, type) {

        this.attributes.push({name: name, type: type, order: '', filter: ''});
    }

    attribute(name) {
        return _.find(this.attributes, ['name', name]);
    }

    loadModels(params = {}) {
        this.loading = true;
        params.include = this.includes.join(',');

        return this.modelApi.index(params)
            .then(data => {
                this.loading = false;
                this.models = data;

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
        return this.models.filter(model => {
            return this.modelIsInFilters(model) && this.modelIsInFilters(model);
        });
    }

    modelIsInSearch() {
        for (var key in model) {
            if (model.hasOwnProperty(key)) {
                var value = model[key];

                if (String(value).indexOf(this.searchText) !== -1) {
                    return true;
                }
            }
        }
    }

    modelIsInFilters(model) {

    }

    updateSelectAll() {
        var models = this.getModels();

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
            title: 'Are you sure?',
            text: selected.length + ' models will be deleted!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete them!',
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
        return $first && !this.isLocked(model);
    }

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

        this.loadModels(params);
    }

    pageChanged() {

    }

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

    sortBy(name) {
        _.forEach(this.attributes, (attribute) => {
            if (attribute.name != name) {
                attribute.order = '';
            }
        });

        var attribute = this.attribute(name);
        attribute.order = this.nextOrderDirection(attribute.order);

        switch (attribute.order) {
            case 'desc':
                return this.models = _.sortBy(this.getModels(), name).reverse();
            case 'asc':
                return this.models = _.sortBy(this.getModels(), name);
            default:
                return this.models = _.sortBy(this.getModels(), 'id');
        }


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

}