export default class RelationInputController {

    /*@ngInject*/
    constructor(api) {
        this.api = api;
        this.modelApi = this.api.model(this.related);
        this.model = null;
        this.models = [];
        const params = {
            scopes: this.scopes
        };

        this.modelApi.index(params)
            .then(models => {
                this.models = models;
            });
    }

}