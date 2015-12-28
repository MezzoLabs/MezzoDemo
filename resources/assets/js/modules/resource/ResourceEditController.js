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
                    this.contentBlockService.addContentBlock(block.class, block.name, 'title', block.id);
                });
            });
    }

}