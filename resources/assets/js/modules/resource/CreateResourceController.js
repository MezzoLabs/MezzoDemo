export default class ResourceCreateController {

    /*@ngInject*/
    constructor(api) {
        this.api = api;
    }

    init(modelName) {
        this.modelName = modelName;
        this.modelApi = this.api.model(this.modelName);
    }

    submit() {
        if(this.form.$invalid) {
            return false;
        }

        const formData = this.getFormData();

        this.modelApi.create(formData);
    }

    hasError(formControl) {
        if(Object.keys(formControl.$error).length && formControl.$dirty){
            return 'has-error';
        }
    }

    /* public */
    /* private */

    getFormData() {
        const $form = $('form[name="vm.form"]');

        return $form.toObject();
    }

}