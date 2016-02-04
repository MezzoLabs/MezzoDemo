import EditRelationsController from "./EditRelationsController";

export default class EditUserSubscriptionsController extends EditRelationsController {
    /*@ngInject*/
    constructor($injector, $scope) {
        super($injector, $scope);

        this.relationModelsApi = this.api.model('Subscription');
    }

    deleteRelationItem(relationItem) {
        if(!confirm('Delete?')){
            return false;
        }

        this.relationModelsApi.delete(relationItem.id).then(()=> {
            this.loadRelationItems();
            toastr.info('Subscription "'+ relationItem.id +'" deleted.');
        });
    }

    user(){
        return this.modelItem;
    }



}