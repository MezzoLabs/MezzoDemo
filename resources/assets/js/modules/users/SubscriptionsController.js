export default class SubscriptionsController {

    /*@ngInject*/
    constructor(api, $scope, $rootScope, $element, eventDispatcher) {
        console.log('subscription controller');

        this.api = api;
        this.modelApi = api.model('Subscription');
        this.$form = $element.parents('form')[0];

        var base = this;

        eventDispatcher.on('form.received', (event, payload) => {
            base.fill(payload.data, payload.form);

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