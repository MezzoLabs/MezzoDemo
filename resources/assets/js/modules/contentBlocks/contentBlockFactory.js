/*@ngInject*/
export default function registerContentBlockFactory(api) {
    return function contentBlockFactory() {
        return new ContentBlockService(api);
    }
}

class ContentBlockService {

    constructor(api) {
        this.api = api;
        this.contentBlocks = [];
        this.templates = {};
        this.sortableOptions = {
            handle: 'a .ion-arrow-move',
            start: function (e, ui) {
                $(ui.item).parent().find('.tinymce_textarea').each(function () {
                    tinymce.execCommand('mceRemoveEditor', false, $(this).attr('id'));
                });
            },
            stop: function (e, ui) {
                $(ui.item).parent().find('.tinymce_textarea').each(function () {
                    tinymce.execCommand('mceAddEditor', true, $(this).attr('id'));
                });
            }
        };
        this.currentId = 0;
    }

    addContentBlock(key, hash, title, id = '') {
        const contentBlock = {
            id: id,
            key: key,
            cssClass: 'block__' + key.replace(/\\/g, '_'),
            hash: hash,
            title: title,
            nameInForm: 'num' + this.currentId++,
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