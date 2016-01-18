export default class EditResourceController {

    /*@ngInject*/
    constructor($scope, $stateParams, api, formDataService, contentBlockFactory, modelStateService) {
        this.$scope = $scope;
        this.$stateParams = $stateParams;
        this.api = api;
        this.formDataService = formDataService;
        this.contentBlockService = contentBlockFactory();
        this.modelStateService = modelStateService;
        this.modelId = this.$stateParams.modelId;
        this.includes = ['content'];

        this.$scope.$on('$destroy', () => this.onDestroy());
    }

    init(modelName, includes = []) {
        this.modelName = modelName;
        this.modelApi = this.api.model(modelName);
        this.includes = includes;

        if (!_.includes(this.includes, 'content')) {
            this.includes.push('content');
        }

        this.loadContent();
    }

    submit() {
        console.log('clicked edit resource submit');

        if (this.form.$invalid) {

            console.log('invalid', this.form);
            swal('Booh you!', 'Invalid Form', "error");

            return false;
        }

        tinyMCE.triggerSave();

        const formData = this.formDataService.get();

        this.modelApi.update(this.modelId, formData);
    }


    getFormData() {
        const $form = $('form[name="vm.form"]');

        return $form.toObject();
    }

    loadContent() {
        const params = {
            include: this.includes.join(',')
        }

        this.modelApi.content(this.modelId, params)
            .then(model => {
                this.initContentBlocks(model);
                this.initLockable(model);
                this.stripDataEnvelopes(model.content);
                this.formDataService.set(model);
            });
    }

    initContentBlocks(model) {
        if (!model.content || !model.content.data.blocks) {
            return;
        }

        const blocks = model.content.data.blocks.data;

        blocks.forEach(block => {
            const hash = md5(block.class);

            this.contentBlockService.addContentBlock(block.class, hash, block._label, block.id, block.fields);
        });
    }

    startResourceLocking() {
        const thirtySeconds = 30 * 1000;
        this.lockTask = setInterval(() => this.lock(), thirtySeconds);

        this.lock();
    }

    stopResourceLocking() {
        if (this.lockTask) {
            clearInterval(this.lockTask);
            this.unlock();
        }
    }

    lock() {
        this.modelApi.lock(this.modelId);
    }

    unlock() {
        this.modelApi.unlock(this.modelId);
    }

    onDestroy() {
        this.stopResourceLocking();
    }

    initLockable(model) {
        this.isLockable = _.has(model, '_locked_by');

        if (!this.isLockable) {
            return;
        }

        if (model._locked_for_user) {
            return this.redirectToIndex(model._locked_by);
        }

        this.startResourceLocking();
    }

    redirectToIndex(lockedBy) {
        const title = 'Oops...';
        const message = 'You are not allowed to edit this resource while it is locked by ' + lockedBy + '!';

        this.modelStateService.name(this.modelName).index();
        sweetAlert(title, message, 'error');
    }

    stripDataEnvelopes(object) {
        if (!_.isObject(object)) {
            return;
        }

        const keys = _.keys(object);

        keys.forEach(key => {
            const value = object[key];

            this.stripDataEnvelopes(value);

            if (key === 'data') {
                delete object[key];

                if (_.isArray(value)) {
                    for (let i = 0; i < value.length; i++) {
                        object['num' + i] = value[i];

                        this.stripDataEnvelopes(value[i]);
                    }

                    return;
                }

                if (_.isObject(value)) {
                    return _.assign(object, value);
                }
            }
        });
    }

}