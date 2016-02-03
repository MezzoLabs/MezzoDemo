export default class ModelApi {

    constructor(api, modelName, relationName, eventDispatcher) {
        this.api = api;
        this.modelName = modelName;
        this.relationName = relationName;

        this.modelPlural = _.kebabCase(pluralize(this.modelName));
        this.modelUri = '/api/' + this.modelPlural;
        this.eventDispatcher = eventDispatcher;
    }

    index(modelId, params = {}, options = {}) {
        return this.api.get(this.modelUri + '/'+ modelId + '/' + this.relationName, params);
    }


}