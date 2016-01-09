export default class ModelApi {

    constructor(api, modelName) {
        this.api = api;
        this.modelName = modelName;
        this.modelPlural = pluralize(this.modelName).toLowerCase();
        this.apiUrl = '/api/' + this.modelPlural;
    }

    index(parameters) {
        return this.api.get(this.apiUrl, parameters);
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

    content(modelId) {
        return this.api.get(this.apiUrl + '/' + modelId + '?include=content');
    }

}