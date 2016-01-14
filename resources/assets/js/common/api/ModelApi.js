export default class ModelApi {

    constructor(api, modelName) {
        this.api = api;
        this.modelName = modelName;
        this.modelPlural = _.kebabCase(pluralize(this.modelName));
        this.apiUrl = '/api/' + this.modelPlural;
    }

    index(params = {}) {
        return this.api.get(this.apiUrl, params);
    }

    create(formData) {
        return this.api.post(this.apiUrl, formData);
    }

    update(modelId, formData) {
        return this.api.put(this.apiUrl + '/' + modelId, formData);
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

}