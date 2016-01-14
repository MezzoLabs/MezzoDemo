export default class IndexResourceController {

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
        this.attributes = [];
    }

    init(modelName, defaultIncludes) {
        this.modelName = modelName;
        this.modelApi = this.api.model(modelName);
        this.includes = defaultIncludes;

        this.loadModels();
    }

    addAttribute(name, type) {
        this.attributes.push({name: name, type: type});
    }

    loadModels() {
        this.loading = true;
        const params = {
            include: this.includes.join(',')
        };

        return this.modelApi.index(params)
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
        var values = [];

        for (var i in this.attributes) {
            var attribute = this.attributes[i];
            values.push(this.transformModelValue(attribute, model[attribute.name]));
        }

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

        if (attribute.type == "boolean") {
            return (value == "1") ? "y" : "n";
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

    editId(id) {
        this.$state.go('edit' + this.modelName.replace('-', '').replace(',', '').toLowerCase(), {modelId: id});
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

    isLocked(model) {
        return model._locked_for_user;

    }

    lockedBy(model) {
        return model._locked_by;
    }

    displayAsLink($first, model) {
        return $first && !this.isLocked(model);
    }

}