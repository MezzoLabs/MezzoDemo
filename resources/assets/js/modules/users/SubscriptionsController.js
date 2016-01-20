export default class SubscriptionsController {

    /*@ngInject*/
    constructor(api, $scope, $rootScope, $element) {
        this.api = api;
        this.modelApi = api.model('Subscription');
        this.$form = $element.parents('form')[0];

        var base = this;
        $scope.$on('mezzo.formdata.set', function (event, mass) {
            base.fill(mass.data, mass.form);
        });

        $rootScope.$on('mezzo.model.update', function () {
            console.log('event', one, two, three);
        });

        $scope.$on('mezzo.model.update', function () {
            console.log('event', one, two, three);
        });
    }

    fill(data, form) {
        if (form != this.$form) {
            return;
        }

        this.subscriptions = data.subscriptions;

        this.sort();
    }

    subscribedUntilString(subscription) {
        return this.subscribedUntilDate(subscription).format('DD.MM.YYYY HH:mm');
    }


    isCancelled(subscription) {
        return subscription.cancelled == 1;
    }


}