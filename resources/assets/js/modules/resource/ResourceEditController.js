export default class ResourceEditController {

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

        this.loadContentBlocks();
    }

    loadContentBlocks() {
        this.modelApi.content(this.modelId)
            .then(model => {
                const blocks = model.content.data.blocks.data;

                blocks.forEach(block => {
                    const hash = md5(block.class);

                    this.contentBlockService.addContentBlock(block.class, hash, 'title', block.id);
                });
            });
    }

}