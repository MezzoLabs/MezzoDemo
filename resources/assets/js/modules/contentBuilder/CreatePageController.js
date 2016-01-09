import CreateResourceController from '../resource/CreateResourceController';

export default class CreatePageController extends CreateResourceController {

    /*@ngInject*/
    constructor($state, api, contentBlockService) {
        super($state, api);

        this.contentBlockService = contentBlockService;
    }

}