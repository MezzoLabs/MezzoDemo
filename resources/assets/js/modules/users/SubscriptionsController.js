export default class SubscriptionsController {

    /*@ngInject*/
    constructor(api, $scope, $element) {
        this.api = api;
        this.$form = $element.parents('form')[0];

        var base = this;
        $scope.$on('mezzo.formdata.set', function (event, mass) {
            base.fill(mass.data, mass.form);
        });
    }

    fill(data, form) {
        if (form != this.$form) {
            return;
        }

        this.subscriptions = data.subscriptions;

        this.sort();

        console.log('subscriptions', this.subscriptions);
    }

    subscribedUntilString(subscription) {
        return moment(subscription.subscribed_until).format('DD.MM.YYYY HH:mm')
    }

    subscribedUntilDate(subscription) {
        return moment(subscription.subscribed_until);
    }

    isCancelled(subscription) {
        return subscription.cancelled == 1;
    }

    sort() {
        var base = this;
        this.subscriptions = _.sortBy(this.subscriptions, function (s) {
                return base.subscribedUntilDate(s).format('X');
            }
        );
    }
}