import ResourceController from './ResourceController';
import FormEvent from './../../common/forms/FormEvent';

export default class EditResourceController extends ResourceController {

    /*@ngInject*/
    constructor($injector, $scope) {
        super($injector);

        this.$scope = $scope;
        this.$stateParams = $injector.get('$stateParams');
        this.$rootScope = $injector.get('$rootScope');
        this.eventDispatcher = $injector.get('eventDispatcher');
        this.modelId = this.$stateParams.modelId;

        this.content = {};

        this.includes = ['content'];

        this.$scope.$on('$destroy', () => this.onDestroy());

        this.$scope.$on('$routeChangeStart', function (next, current) {
            alert('route change scope edit resource');
        });
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

    doSubmit(formData) {
        return this.modelApi.update(
            this.modelId,
            formData,
            { params: {include: this.includes.join(',')}})
            .then(model => {
                this.fireEvent('form.updated', this.formDataService.transform(model));
                toastr.success('Success! ' + model._label + ' updated');
            });
    }

    loadContent() {
        const params = {
            include: this.includes.join(',')
        };
        this.loading = true;

        this.modelApi.content(this.modelId, params)
            .then(model => {
                this.contentLoaded(model);
            });
    }

    contentLoaded(model) {
        this.initContentBlocks(model);
        this.initLockable(model);

        const cleaned = this.formDataService.transform(model);

        this.content = cleaned.stripped;
        this.inputs = cleaned.flattened;

        this.loading = false;


        this.eventDispatcher.fire(new FormEvent('form.received', {
            data: cleaned.stripped,
            flattened: cleaned.flattened,
            form: this.form
        }, this.form));
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
                block
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
        this.eventDispatcher.clear();
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