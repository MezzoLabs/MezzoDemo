export default class ModelApi {

    constructor(api, modelName){
        this.api = api;
        this.modelName = modelName;
        this.modelPlural = this.modelName.toLowerCase() + 's';
        this.apiUrl = '/api/' + this.modelPlural;
    }

    index(){
        return this.api.get(this.apiUrl);
    }

    delete(modelId){
        return this.api.delete(this.apiUrl + '/' + modelId);
    }

}