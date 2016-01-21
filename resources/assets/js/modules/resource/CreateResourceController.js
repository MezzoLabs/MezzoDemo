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
        this.loading = true;

        this.modelApi.create(formData)
            .then(model => {
                this.loading = false;

                this.edit(model.id);
                toastr.success('Success! ' + model._label + ' created');
            })
            .catch(err => {
                this.loading = false;

                this.catchServerSideErrors(err)
            });
    }

    edit(modelId) {
        this.modelStateService.name(this.modelName).id(modelId).edit();
    }

}