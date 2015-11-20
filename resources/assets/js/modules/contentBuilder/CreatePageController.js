export default class CreatePageController {

    /*@ngInject*/
    constructor(){
        this.contentBlockButtons = [
            { label: 'Text only', icon: 'ion-document-text', contentBlock: 'text-only' },
            { label: 'Text and Image', icon: 'ion-images', contentBlock: 'text-and-image' }
        ];
        this.contentBlocks = [];
    }

    addContentBlock(name){
        var contentBlock = {
            name: name,
            directive: 'mezzo-' + name
        };

        this.contentBlocks.push(contentBlock);
    }

}