export default class CreateResourceController {

    /*@ngInject*/
    constructor($state, api, formDataService, contentBlockFactory) {
        this.$state = $state;
        this.api = api;
        this.formDataService = formDataService;
        this.contentBlockService = contentBlockFactory();
    }

    init(modelName) {
        this.modelName = modelName;
        this.modelApi = this.api.model(this.modelName);
    }

    submit() {
        if (this.form.$invalid) {
            return false;
        }

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
        this.$state.go('edit' + this.modelName.toLowerCase(), {modelId: modelId});
    }

}