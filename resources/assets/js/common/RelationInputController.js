export default class RelationInputController {

    /*@ngInject*/
    constructor(api, $scope, $element, $timeout, eventDispatcher) {
        this.api = api;
        this.modelApi = this.api.model(this.related);
        this.model = null;
        this.$element = $element;
        this.models = [];
        this.selected = null;
        this.modelsLoaded = false;
        this.$timeout = $timeout;
        this.uniqueKey = _.random(10000, 90000);

        this.eventDispatcher = eventDispatcher;
        this.formController = null;

        this.registerListeners();


        this.loadModels();
    }

    registerListeners() {
        const formReceived = this.eventDispatcher.findInHistory('form.received');

        if (formReceived) {
            this.eventDispatcher.on('relationinput.models_loaded.' + this.uniqueKey, (events, payloads) => {
                this.fill(formReceived.payload.data, formReceived.form);
            });

            return;
        }

        this.eventDispatcher.on(['form.received', 'relationinput.models_loaded.' + this.uniqueKey], (events, payloads) => {
            this.fill(payloads['form.received'].data, payloads['form.received'].form);
        });
    }

    linked(scope, element, attrs, ctrls){
        this.formController = ctrls;
    }

    loadModels() {
        const params = {
            scopes: this.scopes
        };

        this.modelApi.index(params)
            .then(models => {
                this.models = models;

                this.modelsLoaded = true;

                this.eventDispatcher.makeAndFire('relationinput.models_loaded.' + this.uniqueKey, {'models': models});


            });
    }

    fill(data, form) {
        if (!this.modelsLoaded) {
            console.error('fill without models loaded');
        }

        if (form != this.formController)
            return false;

        this.selected = _.get(data, this.$element.attr('name'));

        var htmlValue = _.clone(this.selected);


        this.$timeout(() => {
            if (htmlValue && _.isObject(htmlValue) && typeof(htmlValue['id']) == 'undefined') {
                htmlValue = _.map(htmlValue, 'id');
            }

            $(this.$element).val(htmlValue).trigger('change', {'filledFromApi': true}).blur();
        });




    }

}