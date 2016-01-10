export default class EditResourceController {

    /*@ngInject*/
    constructor($scope, $state, $stateParams, api, formDataService, contentBlockFactory) {
        this.$scope = $scope;
        this.$state = $state;
        this.$stateParams = $stateParams;
        this.api = api;
        this.formDataService = formDataService;
        this.contentBlockService = contentBlockFactory();
        this.modelId = this.$stateParams.modelId;

        this.$scope.$on('$destroy', () => this.onDestroy());
    }

    init(modelName) {
        this.modelName = modelName;
        this.modelApi = this.api.model(modelName);

        this.loadContent();
    }

    submit() {
        if (this.form.$invalid) {
            return false;
        }

        const formData = this.formDataService.get();

        this.modelApi.update(this.modelId, formData);
    }

    getFormData() {
        const $form = $('form[name="vm.form"]');

        return $form.toObject();
    }

    loadContent() {
        this.modelApi.content(this.modelId)
            .then(model => {
                const blocks = model.content.data.blocks.data;

                this.initLockable(model);

                blocks.forEach(block => {
                    const hash = md5(block.class);

                    this.contentBlockService.addContentBlock(block.class, hash, block._label, block.id);
                });

                this.stripDataEnvelopes(model.content);
                this.formDataService.set(model);
            });
    }

    startResourceLocking() {
        const thirtySeconds = 30 * 1000;
        this.lockTask = setInterval(() => this.lock(), thirtySeconds);

        this.lock();
    }

    stopResourceLocking() {
        if(this.lockTask) {
            clearInterval(this.lockTask);
        }
    }

    lock() {
        this.modelApi.lock(this.modelId);
    }

    onDestroy() {
        this.stopResourceLocking();
    }

    initLockable(model) {
        this.isLockable = _.has(model, '_locked_by');

        if(!this.isLockable) {
            return;
        }

        if(model._locked_for_user) {
            return this.redirectToIndex(model._locked_by);
        }

        this.startResourceLocking();
    }

    redirectToIndex(lockedBy) {
        const title = 'Oops...';
        const message = 'You are not allowed to edit this resource while it is locked by ' + lockedBy + '!';

        this.$state.go('index' + this.modelName.toLowerCase());
        sweetAlert(title, message, 'error');
    }

    stripDataEnvelopes(object) {
        if(!_.isObject(object)) {
            return;
        }

        const keys = _.keys(object);

        keys.forEach(key => {
            const value = object[key];

            this.stripDataEnvelopes(value);

            if(key === 'data') {
                delete object[key];

                if(_.isArray(value)) {
                    for(let i = 0; i < value.length; i++) {
                        object['num' + i] = value[i];

                        this.stripDataEnvelopes(value[i]);
                    }

                    return;
                }

                if(_.isObject(value)) {
                    return _.assign(object, value);
                }
            }
        });
    }

}