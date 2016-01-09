import CreateResourceController from '../resource/CreateResourceController';

export default class CreatePostController extends CreateResourceController {

    /*@ngInject*/
    constructor($state, api, formDataService, contentBlockService) {
        super($state, api, formDataService);

        this.contentBlockService = contentBlockService;
    }

}