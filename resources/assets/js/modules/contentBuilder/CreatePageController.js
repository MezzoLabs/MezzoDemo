export default class CreatePageController {

    /*@ngInject*/
    constructor(api, random) {
        this.api = api;
        this.random = random;
        this.contentBlocks = [];
        this.templates = {};
    }

    addContentBlock(key, hash, title) {
        const contentBlock = {
            id: '',
            key: key,
            hash: hash,
            title: title,
            nameInForm: this.random.string(),
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