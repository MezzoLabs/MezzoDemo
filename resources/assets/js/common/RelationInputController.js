export default class RelationInputController {

    /*@ngInject*/
    constructor(api, $scope, $element, $timeout) {
        this.api = api;
        this.modelApi = this.api.model(this.related);
        this.model = null;
        this.$element = $element;
        this.models = [];
        this.selected = null;

        const params = {
            scopes: this.scopes
        };

        var base = this;

        this.modelApi.index(params)
            .then(models => {
                this.models = models;

                $timeout(function () {
                    if (!base.selected) return;

                    var value = base.selected;

                    if (base.selected[0]) {
                        value = _.map(base.selected, 'id');
                    }

                    $(base.$element).val(value).trigger('change', {'filledFromApi': true}).blur();

                });

            });

        var base = this;

        $scope.$on('mezzo.formdata.set', function (event, mass) {
            base.fill(mass.data, mass.form);
        });
    }

    fill(data, form) {
        if (form != $(this.$element).parents('form')[0])
            return false;

        this.selected = data[this.$element.attr('name')];
    }

}