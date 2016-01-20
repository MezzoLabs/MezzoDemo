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

    subscribedUntilDate(subscription) {
        return moment(subscription.subscribed_until, 'DD.MM.YYYY HH:mm');
    }

    timeLeft(subscription) {
        return this.subscribedUntilDate(subscription).fromNow();
    }

    isCancelled(subscription) {
        return subscription.cancelled == 1;
    }

    sort() {
        var base = this;
        this.subscriptions = _.sortBy(this.subscriptions, function (s) {
                return base.subscribedUntilDate(s).format('X');
            }
        ).reverse();

    }

    changeCancel(subscription, cancelled = 1) {
        this.modelApi.update(subscription.id, {
            'cancelled': cancelled
        }).then(function () {
            subscription.cancelled = cancelled;
        });
    }

    delete(subscription) {
        var base = this;
        this.modelApi.delete(subscription.id).then(function () {
            var index = base.subscriptions.indexOf(subscription);
            base.subscriptions.splice(index,1);
            console.log('remove from ', index);
        });
    }
}