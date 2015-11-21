export default class CreatePageController {

    /*@ngInject*/
    constructor(api, $sce) {
        this.api = api;
        this.$sce = $sce;
        this.contentBlocks = [];
        this.templates = {};
    }

    addContentBlock(key, title, hash, propertyInputName) {
        const contentBlock = {
            key: key,
            title: title,
            hash: hash,
            propertyInputName: propertyInputName,
            template: null
        };

        this.fillTemplate(contentBlock);
        this.contentBlocks.push(contentBlock);
    }

    fillTemplate(contentBlock) {
        const cachedTemplate = this.templates[contentBlock.hash];

        if (cachedTemplate) {
            return contentBlock.template = cachedTemplate;
        }

        this.api.contentBlockTemplate(contentBlock.hash)
            .then(template => {
                const trustedTemplate = this.$sce.trustAsHtml(template);
                contentBlock.template = trustedTemplate;
                this.templates[contentBlock.hash] = trustedTemplate;
            });
    }

}