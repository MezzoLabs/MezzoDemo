import EditRelationsController from "./EditRelationsController";

export default class EditSubscriptionsController extends EditRelationsController {
    /*@ngInject*/
    constructor($injector, $scope) {
        super($injector, $scope);

        console.log('edit sub controller');

        this.subscriptionsApi = this.api.model('Subscription');

        setTimeout(() => {
            console.log(this);
        }, 1500);
    }



}