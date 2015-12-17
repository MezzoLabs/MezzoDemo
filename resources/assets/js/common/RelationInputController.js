export default class RelationInputController {

    /*@ngInject*/
    constructor(api) {
        this.api = api;
        console.log(!!this.multiple);
        console.log('RelationInputController');
        console.log(this);
    }

}