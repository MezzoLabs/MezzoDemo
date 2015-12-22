export default class CreatePostController {

    /*@ngInject*/
    constructor(api, contentBlockService) {
        this.api = api;
        this.contentBlockService = contentBlockService;
    }

    init(modelName) {
        this.modelName = modelName;
        this.modelApi = this.api.model(this.modelName);
    }

    submit() {
        const formData = $(document['vm.form']).serializeArray();

        console.log(formData);
        this.modelApi.create(formData);
    }

}