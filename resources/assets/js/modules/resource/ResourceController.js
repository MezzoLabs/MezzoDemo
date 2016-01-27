import FormEvent from './../../common/forms/FormEvent';

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
        this.inputs = {}; // ng-model Controller of the input fields will bind to this object
        this.isBusy = false;
    }

    hasError(inputName) {
        const formControl = this.form[inputName];

        if (!formControl) {
            return;
        }

        const atLeastOneError = Object.keys(formControl.$error).length > 0;
        const isDirty = formControl.$dirty;

        if (atLeastOneError && isDirty) {
            return 'has-error';
        }
    }

    catchServerSideErrors(err) {
        if (!err.data || !err.data.errors) {
            this.errorHandlerService.showUnexpected(err);
            return;
        }

        const errors = err.data.errors;
        console.error(err);
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
        console.info('attemptSubmit()');


        if (this.form.$invalid) {
            console.warn('attemptSubmit() failed because of an invalid form', this.form);
            this.dirtyFormControls(); // if a submit attempt failed because of an $invalid form all validation messages should be visible

            return false;
        }

        return true;
    }

    // Override this method in extending class
    doSubmit(formData) {
        console.warn('doSubmit() should be implemented by the extending class!');
        return Promise.resolve();
    }

    submit() {
        if (this.isBusy) {
            console.error('Resource controller is still busy. Cannot submit at the moment.');
            return false;
        }

        this.isBusy = true;

        console.info('submit()');

        tinyMCE.triggerSave();

        if (!this.attemptSubmit()) {
            this.isBusy = false;
            return false;
        }

        this.loading = true;
        const formData = this.getFormData();

        this.fireEvent('form.sending', formData);


        this.doSubmit(formData)
            .then((response) => {
                console.info('doSubmit().then()');

                this.loading = false;
            })
            .catch(err => {
                console.info('doSubmit().catch()');

                this.loading = false;

                this.catchServerSideErrors(err);
            })
            .finally(() => {
                this.isBusy = false;
        });
    }

    dirtyFormControls() {
        this.formControls().forEach(formControl => {
            formControl.$dirty = true;
        });
    }

    getFormData() {
        const formData = {};

        this.htmlForm()
            .find(':input[name]')
            .each((index, formInput) => {
                const $formInput = $(formInput);
                const name = $formInput.attr('name');
                const value = $formInput.val();

                if ($formInput.is('input[type=radio]')) {
                    if (!$formInput.prop('checked')) {
                        return;
                    }
                }

                /* Start checkbox edge case */
                // match checkbox key e.g. categories[1] or categories[10]
                const regex = /(.+)\[([0-9]+)\]/i;
                const match = name.match(regex);

                if (match) {
                    const checkboxKey = match[1];
                    const checkboxId = match[2];
                    let checkbox = _.get(formData, checkboxKey);

                    if (!_.isArray(checkbox)) {
                        checkbox = [];

                        _.set(formData, checkboxKey, checkbox);
                    }

                    if (!$formInput.prop('checked')) {
                        return;
                    }

                    checkbox.push(checkboxId);

                    return;
                }

                if ($formInput.is('input[type=checkbox]')){
                    _.set(formData, name, ($formInput.prop('checked')) ? 1 : 0 );
                    return;
                }
                /* End checkbox edge case */

                _.set(formData, name, value);
            });

        return formData;
    }

    htmlForm() {
        return $('form[name="vm.form"]');
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
        return this.eventDispatcher.fire(new FormEvent(name, data, this.htmlForm()[0]));
    }

    getInput(name) {
        console.log('get', this.inputs[name]);
        return this.inputs[name];
    }


}