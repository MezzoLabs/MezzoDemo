import ResourceController from './ResourceController';
import FormEvent from './../../common/forms/FormEvent';

export default class EditResourceController extends ResourceController {

    /*@ngInject*/
    constructor($injector, $scope) {
        super($injector, $scope);

        this.$scope = $scope;
        this.$stateParams = $injector.get('$stateParams');
        this.$rootScope = $injector.get('$rootScope');
        this.eventDispatcher = $injector.get('eventDispatcher');
        this.modelId = this.$stateParams.modelId;

        this.content = {};

        this.includes = ['content'];


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

    canEdit() {
        if (!this.content._permissions) {
            return true;
        }

        return this.content._permissions.edit;

    }

    beforeSubmit() {
        if (!this.canEdit()) {
            swal('Error', this.language.get('messages.missing_permissions'), 'error');
            return false;
        }

        return super.beforeSubmit();
    }


    doSubmit(formData) {
        return this.modelApi.update(
            this.modelId,
            formData,
            {params: {include: this.includes.join(',')}})
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

                this.canEdit();
            }).catch((err) => {

            if (err.data) {
                swal(err.data.status_code.toString(), err.data.message, 'error');
            }

            this.redirectToIndex();

        });
    }

    contentLoaded(model) {
        this.initContentBlocks(model);
        this.initLockable(model);

        const cleaned = this.formDataService.transform(model);

        this.content = cleaned.stripped;
        console.log('content', this.content);

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
        super.onDestroy();
        this.stopResourceLocking();
    }

    initLockable(model) {
        this.isLockable = _.has(model, '_locked_by');

        if (!this.isLockable) {
            return;
        }

        if (model._locked_for_user) {
            return this.redirectToIndexBecauseLocked(model._locked_by);
        }

        this.startResourceLocking();
    }

    redirectToIndexBecauseLocked(lockedBy) {
        const title = 'Oops...';
        const message = 'You are not allowed to edit this resource while it is locked by ' + lockedBy + '!';

        sweetAlert(title, message, 'error');
        this.redirectToIndex();
    }

    redirectToIndex() {
        this.modelStateService.name(this.modelName).index();

    }

}