import ResourceController from './ResourceController';

export default class CreateResourceController extends ResourceController {

    /*@ngInject*/
    constructor($scope, $injector) {
        super($scope, $injector);
    }

    init(modelName) {
        this.modelName = modelName;
        this.modelApi = this.api.model(this.modelName);
    }

    submit() {
        if (this.form.$invalid) {
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