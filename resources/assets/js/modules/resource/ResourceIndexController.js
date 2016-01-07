export default class ResourceIndexController {

    /*@ngInject*/
    constructor($scope, $state, api) {
        this.$scope = $scope;
        this.$state = $state;
        this.api = api;
        this.includes = [];
        this.models = [];
        this.searchText = '';
        this.selectAll = false;
        this.loading = false;
        this.removing = 0;
        this.keys = [];
    }

    init(modelName, defaultIncludes) {
        this.modelName = modelName;
        this.modelApi = this.api.model(modelName);
        this.includes = defaultIncludes;

        this.loadModels();
    }

    addAttribute(name) {
        this.keys.push(name);
    }

    loadModels() {
        this.loading = true;

        var parameters = {
            'include': this.includes.join(',')
        };

        return this.modelApi.index(parameters)
            .then(data => {
                this.loading = false;
                this.models = data;

                this.models.forEach(model => model._meta = {});
            });
    }

    getModels() {
        if (this.searchText.length > 0) {
            return this.search();
        }

        return this.models;
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
        var keys = this.keys;
        var values = [];

        keys.forEach(key => values.push(this.transformModelValue(key, model[key])));

        return values;
    }

    transformModelValue(name, value) {

        if (typeof value === "object") {
            return this.transformArrayValueToString(name, value.data);
        }

        return value;
    }

    transformArrayValueToString(name, array) {
        var labels = [];

        for (var i in array) {
            labels.push(array[i]._label);
        }

        return labels.join(', ');
    }

    canEdit() {
        return this.selected().length === 1;
    }

    canRemove() {
        return this.selected().length > 0;
    }

    search() {
        return this.models.filter(model => {
            for (var key in model) {
                if (model.hasOwnProperty(key)) {
                    var value = model[key];

                    if (String(value).indexOf(this.searchText) !== -1) {
                        return true;
                    }
                }
            }
        });
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

    edit() {
        const models = this.selected();
        const state = 'edit' + this.modelName;

        this.$state.go(state, {modelId: models[0].id});
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
        this.removing++;
        this.selectAll = false;
        model._meta.selected = false;
        model._meta.removed = true;

        this.removeRemoteModel(model)
            .then(() => this.removeLocalModel(model))
            .catch(() => this.removing--);
    }

    removeLocalModel(model) {
        for (var i = 0; i < this.models.length; i++) {
            if (this.models[i] === model) {
                return this.models.splice(i, 1);
            }
        }
    }

    removeRemoteModel(model) {
        return this.modelApi.delete(model.id);
    }

    countSelected() {
        return this.selected().length;
    }

}