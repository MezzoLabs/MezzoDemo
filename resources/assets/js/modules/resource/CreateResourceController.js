import ResourceController from './ResourceController';

export default class CreateResourceController extends ResourceController {

    /*@ngInject*/
    constructor($injector) {
        super($injector);
    }

    init(modelName) {
        this.modelName = modelName;
        this.modelApi = this.api.model(this.modelName);
    }

    submit() {
        if (!this.attemptSubmit()) {
            return false;
        }

        tinyMCE.triggerSave();

        const formData = this.formDataService.get();

        this.modelApi.create(formData)
            .then(model => {
                this.edit(model.id);
            })
            .catch(err => this.catchServerSideErrors(err));
    }

    edit(modelId) {
        this.modelStateService.name(this.modelName).id(modelId).edit();
    }

}