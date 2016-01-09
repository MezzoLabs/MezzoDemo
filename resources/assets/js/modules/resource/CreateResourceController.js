export default class ResourceCreateController {

    /*@ngInject*/
    constructor(api) {
        this.api = api;
    }

    submit(){
        if(this.form.$invalid){
            return false;
        }

        //TODO
    }

    hasError(formControl){
        if(Object.keys(formControl.$error).length && formControl.$dirty){
            return 'has-error';
        }
    }

}