import FormEvent from './FormEvent';

export default class FormObject {
    constructor(form, formController){
        if(!formController){
            alert('Invalid form controller.');
            console.error(form, formController);
        }

        this.form = form;
        this.controller = formController;
    }

    controls() {
        return _.filter(this.controller, potentialFormControl => {
            const isFormControl = potentialFormControl && potentialFormControl.$error;

            return isFormControl;
        });
    }

    dirtyControls() {
        this.controls().forEach(formControl => {
            formControl.$dirty = true;
        });
    }

    submitButtonClass(){
        if (this.controller && this.controller.$invalid) {
            return 'disabled';
        }

        return '';
    }

    showServerSideErrors(errors) {
        _.forOwn(errors, (value, key) => {
            const formControl = this.controller[key];
            const errorMessage = value[0];

            if (formControl) {
                this.attachServerSideError(formControl, errorMessage);
                return;
            }

            toastr.error(errorMessage);
        });
    }

    clearServerSideErrors() {
        this.controls().forEach(formControl => {
            delete formControl.$error.mezzoServerSide;
        });
    }

    attachServerSideError(formControl, errorMessage) {
        formControl.$error.mezzoServerSide = errorMessage;
        formControl.$dirty = true;
    }

    isInvalid(){
        return this.controller.$invalid;
    }

    fire(eventDispatcher, name, data){
        if(!this.form){
            alert('Cannot fire event without form.');
            console.error('No form given', this);
            return;
        }

        return eventDispatcher.fire(new FormEvent(name, data, angular.element(this.form)[0]));
    }
}