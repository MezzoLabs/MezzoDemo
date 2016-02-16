import ResourceController from './ResourceController';

export default class CreateResourceController extends ResourceController {

    /*@ngInject*/
    constructor($injector, $scope) {
        super($injector, $scope);
    }

    init(modelName, options = {}) {
        this.options = options;
        this.modelName = modelName;
        this.modelApi = this.api.model(this.modelName);
    }

    doSubmit(formData) {
        return this.modelApi.create(formData)
            .then(model => {
                toastr.success('Success! ' + model._label + ' created');

                if (model._permissions && !model._permissions.edit) {
                    toastr.warning('No rights to edit.');
                    this.index();
                    return;
                }

                this.edit(model.id);
            });
    }

    edit(modelId) {

        this.modelStateService.name(this.modelName).id(modelId).edit();

    }

    index() {
        this.modelStateService.name(this.modelName).index();

    }

}