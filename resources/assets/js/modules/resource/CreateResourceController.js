import ResourceController from './ResourceController';

export default class CreateResourceController extends ResourceController {

    /*@ngInject*/
    constructor($injector, $scope) {
        super($injector, $scope);
    }

    init(modelName) {
        this.modelName = modelName;
        this.modelApi = this.api.model(this.modelName);
    }

    doSubmit(formData) {
        return this.modelApi.create(formData)
            .then(model => {
                this.edit(model.id);
                toastr.success('Success! ' + model._label + ' created');
            });
    }

    edit(modelId) {
        this.modelStateService.name(this.modelName).id(modelId).edit();
    }

}