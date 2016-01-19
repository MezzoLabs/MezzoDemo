/*@ngInject*/
export default function registerContentBlockFactory($compile, api, formValidationService) {
    return function contentBlockFactory($scope) {
        return new ContentBlockService($compile, $scope, api, formValidationService);
    }
}

class ContentBlockService {

    constructor($compile, $scope, api, formValidationService) {
        this.$compile = $compile;
        this.$scope = $scope;
        this.api = api;
        this.formValidationService = formValidationService;
        this.modelApi = api.model('ContentBlock');
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

                base.rebaseSortingOnHtml();


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
        var block = this.contentBlocks[index];

        if (block.id) {
            this.modelApi.delete(block.id);
        }

        this.contentBlocks.splice(index, 1);

        this.refreshSortings();
    }

    fillTemplate(contentBlock) {
        const cachedTemplate = this.templates[contentBlock.hash];

        if (cachedTemplate) {
            console.log('fill template: ', contentBlock);
            this.deferFormValidation();

            return contentBlock.template = cachedTemplate;
        }

        this.api.contentBlockTemplate(contentBlock.hash)
            .then(template => {
                contentBlock.template = template;
                this.templates[contentBlock.hash] = template;

                this.deferFormValidation();
            });
    }

    deferFormValidation() {
        setTimeout(() => {
            this.applyFormValidation();
        }, 1);
    }

    applyFormValidation() {
        $('div.content-block-body')
            .children('div.form-group')
            .find(':input')
            .each((index, formInput) => {
                this.formValidationService.assign(formInput);
                this.$compile(formInput)(this.$scope);
            });
    }

    refreshSortings() {
        this.contentBlocks = _.sortBy(this.contentBlocks, 'sort');

        for(var i in this.contentBlocks){
            this.contentBlocks[i].sort = parseInt(i);
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
            block.sort = index;

            $sort.attr('value', index).trigger('change');
        });

        this.refreshSortings();
    }

}