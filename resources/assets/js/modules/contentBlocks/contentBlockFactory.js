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
            }
        };
        this.currentId = 0;
    }

    addContentBlock(key, hash, title, id = '', fields = {}) {
        const contentBlock = {
            id: id,
            key: key,
            cssClass: 'block__' + key.replace(/\\/g, '_'),
            hash: hash,
            title: title,
            fields: fields,
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
            console.log('fill template: ', contentBlock);
            this.deferFormValidation();

            return contentBlock.template = cachedTemplate;
        }

        this.api.contentBlockTemplate(contentBlock.hash)
            .then(template => {
                console.log('fill fresh template: ', contentBlock);

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

}