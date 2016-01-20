import EditResourceController from "./EditResourceController";

export default class EditSubscriptionsController extends EditResourceController {
    /*@ngInject*/
    constructor($scope, $injector, $stateParams) {
        super($injector);
        console.log('subscriptions contorller here');
    }


}