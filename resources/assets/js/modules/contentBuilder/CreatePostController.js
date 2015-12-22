export default class CreatePostController {

    /*@ngInject*/
    constructor(contentBlockService) {
        this.contentBlockService = contentBlockService;
    }

    init(modelName) {
        this.modelName = modelName;
    }

    submit() {
        console.log(this.form);
    }

}