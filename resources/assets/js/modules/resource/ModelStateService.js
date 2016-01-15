export default class ModelStateService {

    /*@ngInject*/
    constructor($state) {
        this.$state = $state;
    }

    name(modelName) {
        this.modelName = modelName;

        return this;
    }

    id(modelId) {
        this.modelId = modelId;

        return this;
    }

    index() {
        this.go('index', this.modelStateName());
    }

    create() {
        this.go('create' + this.modelStateName());
    }

    edit() {
        const stateName = 'edit' + this.modelStateName();
        const stateParams = {
            modelId: this.modelId
        };

        this.go(stateName, stateParams);
    }

    /* public */
    /* private */

    go(stateName, stateParams = {}) {
        this.$state.go(stateName, stateParams);
    }

    modelStateName() {
        return this.modelName.replace('-', '').toLowerCase();
    }

}