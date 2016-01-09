import CreateResourceController from '../resource/CreateResourceController';

export default class CreatePageController extends CreateResourceController {

    /*@ngInject*/
    constructor($state, api, formDataService, contentBlockService) {
        super($state, api, formDataService);

        this.contentBlockService = contentBlockService;
    }

}