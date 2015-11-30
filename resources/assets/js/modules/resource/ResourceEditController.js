export default class ResourceEditController {

    /*@ngInject*/
    constructor($stateParams) {
        this.$stateParams = $stateParams;
        console.log('ResourceEditController');
        console.log($stateParams.modelId);
    }

}