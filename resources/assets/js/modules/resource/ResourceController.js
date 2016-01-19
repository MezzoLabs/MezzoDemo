// Intended for CreateResourceController & EditResourceController
export default class ResourceController {

    /*@ngInject*/
    constructor(api, formDataService, contentBlockFactory, modelStateService) {
        this.api = api;
        this.formDataService = formDataService;
        this.contentBlockService = contentBlockFactory();
        this.modelStateService = modelStateService;
        this.inputs = {}; // ng-model Controller of the input fields will bind to this object
    }

    hasError(inputName) {
        const formControl = this.form[inputName];
        const atLeastOneError = Object.keys(formControl.$error).length > 0;
        const isDirty = formControl.$dirty;

        if(atLeastOneError && isDirty) {
            return 'has-error';
        }
    }

}