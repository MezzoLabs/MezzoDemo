/*@ngInject*/
export default function registerContentBlockFactory($compile, api, eventDispatcher) {
    return function contentBlockFactory() {
        return new ContentBlockService($compile, api, eventDispatcher);
    }
}

class ContentBlockService {

    constructor($compile, api, eventDispatcher) {
        this.$compile = $compile;
        this.api = api;
        this.modelApi = api.model('ContentBlock');
        this.contentBlocks = [];
        this.templates = {};

        var base = this;

        eventDispatcher.on('form.updated', (event, payload) => this.onFormUpdate(event, payload));


        this.sortableOptions = {
            handle: 'a .ion-arrow-move',
            setup: function (ed) {
                ed.on('remove', function () {
                    console.log('mce better remove');
                });
            },
            start: function (e, ui) {
                console.log('sort');
                $(ui.item).parent().find('[ui-tinymce]').each(function () {
                    $(this).css('opacity', 0.05);
                    tinymce.execCommand('mceRemoveEditor', false, $(this).attr('id'));
                });
            },
            stop: function (e, ui) {
                $(ui.item).parent().find('[ui-tinymce]').each(function () {
                    $(this).css('opacity', 1.0);
                    tinymce.execCommand('mceAddEditor', true, $(this).attr('id'));
                });

                base.rebaseSortingOnHtml();


            }
        };
        this.currentId = 0;
    }

    addContentBlock(key, hash, title, id = '', options = {}, sort = false) {
        const contentBlock = {
            id: id,
            key: key,
            sort: (sort !== false) ? sort : this.contentBlocks.length + 1,
            cssClass: 'block__' + key.replace(/\\/g, '_'),
            hash: hash,
            title: title,
            options: options,
            nameInForm: this.currentId++,
            template: null
        };

        this.fillTemplate(contentBlock);
        this.contentBlocks.push(contentBlock);

        this.refreshSortings();

    }

    removeContentBlock(nameInForm) {
        var index = this.findIndex(nameInForm);

        if (index === false) {
            console.error('Cannot find index for name: ' + nameInForm);
            return false;
        }

        var block = this.contentBlocks[index];

        if (block.id) {
            this.modelApi.delete(block.id).then(() => {
                toastr.success(block.id + ' deleted');
            });
        }

        console.log('before remove', this.contentBlocks);

        this.contentBlocks.splice(index, 1);

        console.log('after remove', this.contentBlocks);


        this.refreshSortings(true);
    }

    findIndex(nameInForm) {
        for (var i in this.contentBlocks) {
            if (this.contentBlocks[i].nameInForm == nameInForm) return i;
        }

        return false;
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

    refreshSortings(updateSort = false) {
        this.contentBlocks = _.sortBy(this.contentBlocks, 'sort');

        if (updateSort == false) {
            return;
        }

        for (var i in this.contentBlocks) {
            this.contentBlocks[i].sort = parseInt(i) + 1;
        }
    }

    rebaseSortingOnHtml() {
        var base = this;

        $('.content-block').each(function (index, element) {
            var $sort = $(this).find('[name$=".sort"]');
            var nameInForm = $sort.attr('name').replace('.sort', '').split('.');
            nameInForm = nameInForm[nameInForm.length - 1];


            var block = _.find(base.contentBlocks, function (test) {
                return test.nameInForm == nameInForm;
            });

            block.sort = index + 1;
        });

    }

    tinyMceModels() {

    }

    onFormUpdate(event, data) {
        if (!data.stripped.content) {
            //console.error('Form update without content.');
            return true;
        }

        var contentBlocksData = data.stripped.content.blocks;

        for (var i in this.contentBlocks) {
            var contentBlock = this.contentBlocks[i];

            for (var j in contentBlocksData) {
                var contentBlockData = contentBlocksData[j];

                if (contentBlockData.sort == contentBlock.sort) {

                    if (contentBlock.id != contentBlockData.id && contentBlock.id != "") {
                        alert('Unexpected error with content block id.');
                        console.error('Content block ids wont fit.', contentBlock, contentBlockData);
                    }

                    if (contentBlock.id != contentBlockData.id) {
                        contentBlock.id = contentBlockData.id;
                        console.log('assign content block id' + contentBlock.id);
                    }
                }
            }
        }
    }

}