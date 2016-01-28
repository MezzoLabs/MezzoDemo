export default class ModelApi {

    constructor(api, modelName, eventDispatcher) {
        this.api = api;
        this.modelName = modelName;

        this.modelPlural = _.kebabCase(pluralize(this.modelName));
        this.apiUrl = '/api/' + this.modelPlural;
        this.eventDispatcher = eventDispatcher;
    }

    index(params = {}) {
        return this.api.get(this.apiUrl, params);
    }

    create(formData) {
        return this.api.post(this.apiUrl, formData);
    }

    update(modelId, formData, config = {}) {

        this.throwEvent('update', {data: formData, id: modelId})

        var request = this.api.put(this.apiUrl + '/' + modelId, formData, config);
        this.throwEvent('updated', {data: formData, id: modelId});

        return request;
    }

    delete(modelId) {
        return this.api.delete(this.apiUrl + '/' + modelId);
    }

    content(modelId, params = {}) {
        return this.api.get(this.apiUrl + '/' + modelId, params);
    }

    lock(modelId) {
        return this.api.get(this.apiUrl + '/' + modelId + '/lock');
    }

    unlock(modelId) {
        return this.api.get(this.apiUrl + '/' + modelId + '/unlock');
    }

    throwEvent(name, data) {
        var payload = _.merge({
            'modelName': this.modelName
        }, data);

        this.eventDispatcher.makeAndFire('model.' + name, payload);
    }

}