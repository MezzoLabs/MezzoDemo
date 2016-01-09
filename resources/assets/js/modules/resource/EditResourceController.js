export default class EditResourceController {

    /*@ngInject*/
    constructor($stateParams, api, formDataService, contentBlockFactory) {
        this.$stateParams = $stateParams;
        this.api = api;
        this.formDataService = formDataService;
        this.contentBlockService = contentBlockFactory();
        this.modelId = this.$stateParams.modelId;
    }

    init(modelName) {
        this.modelName = modelName;
        this.modelApi = this.api.model(modelName);

        this.loadContent();
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
                console.log(model);
                const blocks = model.content.data.blocks.data;

                blocks.forEach(block => {
                    const hash = md5(block.class);

                    this.contentBlockService.addContentBlock(block.class, hash, block._label, block.id);
                });

                this.formDataService.set(model);
            });
    }

}