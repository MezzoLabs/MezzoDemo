export default class ContentBlockService {

    /*@ngInject*/
    constructor(api) {
        this.api = api;
        this.contentBlocks = [];
        this.templates = {};
        this.sortableOptions = {
            handle: 'a .ion-arrow-move'
        };
        this.currentId = 0;
    }

    addContentBlock(key, hash, title, id = '') {
        const contentBlock = {
            id: id,
            key: key,
            hash: hash,
            title: title,
            nameInForm: 'fuck_off_form2js' + this.currentId++,
            template: null
        };

        this.fillTemplate(contentBlock);
        this.contentBlocks.push(contentBlock);
    }

    removeContentBlock(index) {
        this.contentBlocks.splice(index, 1);
    }

    fillTemplate(contentBlock) {
        const cachedTemplate = this.templates[contentBlock.hash];

        if (cachedTemplate) {
            return contentBlock.template = cachedTemplate;
        }

        this.api.contentBlockTemplate(contentBlock.hash)
            .then(template => {
                contentBlock.template = template;
                this.templates[contentBlock.hash] = template;
            });
    }

}