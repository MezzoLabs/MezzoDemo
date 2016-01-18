/*@ngInject*/
export default function registerContentBlockFactory(api) {
    return function contentBlockFactory() {
        return new ContentBlockService(api);
    }
}

class ContentBlockService {

    constructor(api) {
        var base = this;

        this.api = api;
        this.contentBlocks = [];
        this.templates = {};
        this.sortableOptions = {
            handle: 'a .ion-arrow-move',
            start: function (e, ui) {
                $(ui.item).parent().find('.tinymce_textarea').each(function () {
                    $(this).css('opacity', 0.05);
                    tinymce.execCommand('mceRemoveEditor', false, $(this).attr('id'));
                });
            },
            stop: function (e, ui) {
                $(ui.item).parent().find('.tinymce_textarea').each(function () {
                    $(this).css('opacity', 1.0);
                    tinymce.execCommand('mceAddEditor', true, $(this).attr('id'));
                });

                $(ui.item).parents('form').find('.content-block').each(function (index, element) {
                    console.log($(this).find('[name$=".sort"]'));
                    $(this).find('[name$=".sort"]').attr('value', index);

                });
            }
        };
        this.currentId = 0;
    }

    addContentBlock(key, hash, title, id = '', fields = {}, options = {}, sort = false) {
        const contentBlock = {
            id: id,
            key: key,
            sort: (sort !== false) ? sort : this.contentBlocks.length,
            cssClass: 'block__' + key.replace(/\\/g, '_'),
            hash: hash,
            title: title,
            fields: fields,
            options: options,
            nameInForm: 'num' + this.currentId++,
            template: null
        };

        this.fillTemplate(contentBlock);
        this.contentBlocks.push(contentBlock);

        this.refreshSortings();
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

    refreshSortings() {
        this.contentBlocks = _.sortBy(this.contentBlocks, 'sort');
    }

}