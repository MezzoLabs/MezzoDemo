export default class EditResourceController {

    /*@ngInject*/
    constructor($scope, $stateParams, api, formDataService, contentBlockFactory) {
        this.$scope = $scope;
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
        this.startResourceLocking();
    }

    submit() {
        if(this.form.$invalid) {
            return false;
        }

        const formData = this.formDataService.get();

        this.modelApi.update(this.modelId, formData)
            .then(model => {
                console.log(model);
            });
    }

    getFormData() {
        const $form = $('form[name="vm.form"]');

        return $form.toObject();
    }

    loadContent() {
        this.modelApi.content(this.modelId)
            .then(model => {
                const blocks = model.content.data.blocks.data;

                blocks.forEach(block => {
                    const hash = md5(block.class);

                    this.contentBlockService.addContentBlock(block.class, hash, block._label, block.id);
                });

                this.formDataService.set(model);
            });
    }

    startResourceLocking() {
        const thirtySeconds = 30 * 1000;
        this.lockTask = setInterval(() => this.lock(), thirtySeconds);

        this.lock();
    }

    stopResourceLocking() {
        clearInterval(this.lockTask);
    }

    lock() {
        this.modelApi.lock(this.modelId);
    }

    onDestroy() {
        console.log('Well, looks like I have been murdered.');
        this.stopResourceLocking();
    }

}