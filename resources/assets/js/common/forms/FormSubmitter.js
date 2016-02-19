import FormDataReader from './FormDataReader';
import FormObject from './FormObject';

export default class FormSubmitter {
    constructor(controller, $injector) {
        this.pageController = controller;
        this.isBusy = false;
        this.formObject = null;
        this.reader = new FormDataReader();
        this.eventDispatcher = $injector.get('eventDispatcher');
        this.errorHandlerService = $injector.get('errorHandlerService');


    }

    run(form, formController, mergeOptions) {
        const options = this.options = _.merge({
            doSubmit: this.pageController.doSubmit
        }, mergeOptions);

        if (this.isBusy) {
            console.error('Resource controller is still busy. Cannot submit at the moment.');
            return false;
        }

        this.setForm(form, formController);

        this.isBusy = true;

        console.info('submit()');

        tinyMCE.triggerSave();

        if (!this.attemptSubmit()) {
            this.formObject.focusFirstInvalidInput();
            this.unsetForm();
            return false;
        }

        this.loading = true;

        const formData = this.getData(form);

        this.fireEvent('form.submitting', {data: formData, form: form});

        options.doSubmit(formData)
            .then((response) => {
                console.info('doSubmit().then()');
            })
            .catch(err => {
                console.info('doSubmit().catch()');
                this.catchServerSideErrors(err);
                this.fireEvent('form.submitted', {data: formData, form: form});
            })
            .finally(() => {
                this.loading = false;
                this.unsetForm();
            });
    }

    catchServerSideErrors(err) {
        if (!err.data || !err.data.errors) {
            this.errorHandlerService.showUnexpected(err);
            return;
        }

        const errors = err.data.errors;
        console.warn('Server side error', err);
        this.handleServerSideErrors(errors);
    }

    handleServerSideErrors(errors) {
        this.clearServerSideErrors();
        this.showServerSideErrors(errors);
    }

    clearServerSideErrors() {
        return this.formObject.clearServerSideErrors();
    }

    showServerSideErrors(errors) {
        return this.formObject.showServerSideErrors(errors);
    }

    attemptSubmit() {
        if (this.formObject.isInvalid()) {
            console.warn('attemptSubmit() failed because of an invalid form', this.formObject);
            this.formObject.dirtyControls(); // if a submit attempt failed because of an $invalid form all validation messages should be visible

            return false;
        }

        return true;
    }

    controls() {
        return this.formObject.controls();
    }

    fireEvent(name, data) {
        this.formObject.fire(this.eventDispatcher, name, data);
    }

    setForm(form, formController) {
        this.formObject = new FormObject(form, formController);
    }

    unsetForm(){
        this.isBusy = false;
        this.formObject = null;
    }

    getData(form) {
        return this.reader.read(form);
    }


}