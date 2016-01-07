export default class RelationInputController {

    /*@ngInject*/
    constructor(api) {
        this.api = api;
        this.modelApi = this.api.model(this.related);
        this.model = null;
        this.models = [];

        this.modelApi.index({scopes: this.scopes})
            .then(models => {
                this.models = models;
            });
    }

}