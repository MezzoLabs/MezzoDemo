import CreateResourceController from '../resource/CreateResourceController';

export default class CreatePostController extends CreateResourceController {

    /*@ngInject*/
    constructor(api, contentBlockService) {
        super(api);

        this.contentBlockService = contentBlockService;
    }

}