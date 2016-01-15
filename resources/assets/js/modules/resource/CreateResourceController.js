export default class CreateResourceController {

    /*@ngInject*/
    constructor(api, formDataService, contentBlockFactory, modelStateService) {
        this.api = api;
        this.formDataService = formDataService;
        this.contentBlockService = contentBlockFactory();
        this.modelStateService = modelStateService;
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
            });
    }

    hasError(formControl) {
        if (Object.keys(formControl.$error).length && formControl.$dirty) {
            return 'has-error';
        }
    }

    edit(modelId) {
        this.modelStateService.name(this.modelName).id(modelId).edit();
    }

}