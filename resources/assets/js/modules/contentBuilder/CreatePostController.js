export default class CreatePostController {

    /*@ngInject*/
    constructor(contentBlockService) {
        this.contentBlockService = contentBlockService;
    }

    init(modelName) {
        console.log(modelName);
    }

}