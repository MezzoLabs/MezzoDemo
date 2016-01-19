export default class CreateResourceController {

    /*@ngInject*/
    constructor(api, formDataService, contentBlockFactory, modelStateService) {
        this.api = api;
        this.formDataService = formDataService;
        this.contentBlockService = contentBlockFactory();
        this.modelStateService = modelStateService;
        this.inputs = {};  // ng-model Controller of the input fields will bind to this object
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

    hasError(inputName) {
        const formControl = this.form[inputName];
        const atLeastOneError = Object.keys(formControl.$error).length > 0;
        const isDirty = formControl.$dirty;

        if(atLeastOneError && isDirty) {
            return 'has-error';
        }
    }

    edit(modelId) {
        this.modelStateService.name(this.modelName).id(modelId).edit();
    }

}