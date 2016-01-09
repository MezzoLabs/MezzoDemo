export default class EditResourceController {

    /*@ngInject*/
    constructor($stateParams, api, contentBlockService) {
        this.$stateParams = $stateParams;
        this.api = api;
        this.contentBlockService = contentBlockService;
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

        const formData = this.getFormData();

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

                this.fillForm(model);
            });
    }

    fillForm(model) {
        const form = $('form[name="vm.form"]')[0];

        js2form(form, model);
    }

}