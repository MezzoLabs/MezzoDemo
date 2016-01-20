import ResourceController from './ResourceController';

export default class EditResourceController extends ResourceController {

    /*@ngInject*/
    constructor($injector, $scope) {
        super($injector);

        this.$scope = $scope;
        this.$stateParams = $injector.get('$stateParams');
        this.modelId = this.$stateParams.modelId;
        this.content = {};

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
        if (!this.attemptSubmit()) {
            return false;
        }

        tinyMCE.triggerSave();

        const formData = this.formDataService.get();

        this.modelApi.update(this.modelId, formData)
            .then(response => this.onUpdated(this.formDataService.transform(response), formData))
            .catch(err => this.catchServerSideErrors(err));

        return true;
    }

    onUpdated(response, request) {

    }

    loadContent() {
        const params = {
            include: this.includes.join(',')
        };

        this.modelApi.content(this.modelId, params)
            .then(model => {
                this.contentLoaded(model);
            });
    }

    contentLoaded(model) {

        console.log('received data: ', model);

        this.initContentBlocks(model);
        this.initLockable(model);

        var cleaned = this.formDataService.transform(model);

        this.formDataService.set(cleaned);

        this.content = cleaned;

        console.log('fill form: ', this.content);
    }

    initContentBlocks(model) {
        if (!model.content || !model.content.data.blocks) {
            return;
        }

        const blocks = model.content.data.blocks.data;

        blocks.forEach(block => {
            const hash = md5(block.class);

            this.contentBlockService.addContentBlock(
                block.class,
                hash,
                block._label,
                block.id,
                block.fields,
                block.options,
                block.sort
            );
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


}