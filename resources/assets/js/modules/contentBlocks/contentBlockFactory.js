/*@ngInject*/
export default function registerContentBlockFactory($compile, api, eventDispatcher) {
    return function contentBlockFactory(formController) {
        console.log('content block factory', formController);
        return new ContentBlockService($compile, api, eventDispatcher, formController);
    }
}

class ContentBlockService {

    constructor($compile, api, eventDispatcher) {
        this.$compile = $compile;
        this.api = api;
        this.modelApi = api.model('ContentBlock');
        this.contentBlocks = [];
        this.templates = {};
        this.formController = {};

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

    addContentBlock(key, hash, title, block = {}) {
        const contentBlock = {
            id: block.id,
            key: key,
            sort: (block.sort) ? block.sort : this.contentBlocks.length + 1,
            cssClass: 'block__' + key.replace(/\\/g, '_'),
            handle: (block.name) ? block.name : '',
            hash: hash,
            title: title,
            options: (block.options) ? block.options : {},
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

        this.contentBlocks.splice(index, 1);

        this.refreshSortings(true);
    }

    contentBlockOptionsDialog(nameInForm) {
        var block = this.contentBlocks[this.findIndex(nameInForm)];

        console.log(block);

        swal({
            title: 'Options',
            html: '<div class="form-group">' +
            '<label>Block Handle</label>' +
            '<input id="handle-name" type="text" value="' + block.handle + '" class="form-control">' +
            '</div>',
            confirmButtonText: 'Set'
        }, () => {

            block.handle = $('#handle-name').val();
        });

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

        console.log('on form update', event, this.formController);

        if (event.form != this.formController) {
            console.log('invalid form event');
            return;
        }

        var contentBlocksData = data.stripped.content.blocks;

        for (var i in this.contentBlocks) {
            var contentBlock = this.contentBlocks[i];

            for (var j in contentBlocksData) {
                var contentBlockData = contentBlocksData[j];

                if (contentBlockData.sort == contentBlock.sort) {

                    if (contentBlock.id != contentBlockData.id && contentBlock.id != "" && typeof contentBlock.id != "undefined") {
                        alert('Unexpected error with content block id.');
                        console.log(event, this.formController);
                        console.error(typeof contentBlock.id, typeof contentBlockData.id, contentBlock.id, contentBlockData.id);
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