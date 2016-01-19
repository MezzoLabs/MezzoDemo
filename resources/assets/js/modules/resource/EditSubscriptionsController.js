import EditResourceController from "./EditResourceController";

export default class EditSubscriptionsController extends EditResourceController {
    init(modelName, includes = []) {
        console.log('subscriptions contorller init');
        super.init(modelName, includes);
    }
}