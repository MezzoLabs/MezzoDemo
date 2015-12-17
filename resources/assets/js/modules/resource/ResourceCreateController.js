export default class ResourceCreateController {

    /*@ngInject*/
    constructor(api) {
        this.api = api;

        console.log(this.model);
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