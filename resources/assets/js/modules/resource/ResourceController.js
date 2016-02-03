import FormEvent from './../../common/forms/FormEvent';
import FormSubmitter from './../../common/forms/FormSubmitter';
import FormObject from './../../common/forms/FormObject';

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
        this.eventDispatcher = this.$injector.get('eventDispatcher');
        this.$timeout = this.$injector.get('$timeout');
        this.formSubmitter = new FormSubmitter(this, $injector);
        this.inputs = {}; // ng-model Controller of the input fields will bind to this object
        this.isBusy = false;

        this.form = {}; //name of the main form is vm.form

        // TODO: Make resource controller ready for multiple forms.
        this.submittingForm = null;

    }

    hasError(inputName) {
        const form = this.form;

        if (!form) {
            return;
        }

        const formControl = form[inputName];

        if (!formControl) {
            return;
        }

        const atLeastOneError = Object.keys(formControl.$error).length > 0;
        const isDirty = formControl.$dirty;

        if (atLeastOneError && isDirty) {
            return 'has-error';
        }
    }

    submitButtonClass(formController) {
        return this.formObject(null, formController).submitButtonClass();
    }

    // Override this method in extending class
    doSubmit(formData) {
        console.error('doSubmit() should be implemented by the extending class!');
        return Promise.resolve();
    }

    submit($event, formController) {
        console.log('submit', $event, formController);
        return this.formSubmitter.run($event.target, formController);
    }

    tinymceOptions() {
        return {
            plugins: [
                "link"
            ],
            toolbar: "undo redo | bold italic underline | link",
            menubar: "",
            elementpath: false
        }
    };

    fireEvent(name, data) {
        return this.eventDispatcher.fire(new FormEvent(name, data, this.form));
    }

    getInput(name) {
        return this.inputs[name];
    }

    activeForm() {
        return (this.submittingForm) ? this.submittingForm : this.form;
    }

    formObject(form, formController){
        return new FormObject(form, formController);
    }


}