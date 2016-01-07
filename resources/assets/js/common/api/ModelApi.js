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

    delete(modelId) {
        return this.api.delete(this.apiUrl + '/' + modelId);
    }

}