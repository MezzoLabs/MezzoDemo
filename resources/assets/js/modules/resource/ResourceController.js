// Intended for CreateResourceController & EditResourceController
export default class ResourceController {

    constructor($injector, api, formDataService, contentBlockFactory, modelStateService, errorHandlerService) {
        this.$injector = $injector;
        this.api = this.$injector.get('api');
        this.formDataService = this.$injector.get('formDataService');
        this.contentBlockFactory = this.$injector.get('contentBlockFactory');
        this.contentBlockService = this.contentBlockFactory();
        this.modelStateService = this.$injector.get('modelStateService');
        this.errorHandlerService = this.$injector.get('errorHandlerService');
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

    catchServerSideErrors(err) {
        if (!err.data || !err.data.errors) {
            this.errorHandlerService.showUnexpected(err);
            return;
        }

        const errors = err.data.errors;

        this.handleServerSideErrors(errors);
    }

    handleServerSideErrors(errors) {
        this.clearServerSideErrors();
        this.showServerSideErrors(errors);
    }

    showServerSideErrors(errors) {
        _.forOwn(errors, (value, key) => {
            const formControl = this.form[key];
            const errorMessage = value[0];

            if (formControl) {
                this.attachServerSideError(formControl, errorMessage);
                return;
            }

            toastr.error(errorMessage);
        });
    }

    clearServerSideErrors() {
        this.formControls().forEach(formControl => {
            delete formControl.$error.mezzoServerSide;
        });
    }

    attachServerSideError(formControl, errorMessage) {
        formControl.$error.mezzoServerSide = errorMessage;
        formControl.$dirty = true;
    }

    submitButtonClass() {
        if (this.form.$invalid) {
            return 'disabled';
        }
    }

    formControls() {
        return _.filter(this.form, potentialFormControl => {
            const isFormControl = potentialFormControl && potentialFormControl.$error;

            return isFormControl;
        });
    }

    attemptSubmit() {
        if (this.form.$invalid) {
            this.dirtyFormControls(); // if a submit attempt failed because of an $invalid form all validation messages should be visible

            return false;
        }

        return true;
    }

    dirtyFormControls() {
        this.formControls().forEach(formControl => {
            formControl.$dirty = true;
        });
    }

}