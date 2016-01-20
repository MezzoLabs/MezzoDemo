import EditResourceController from "./EditResourceController";

export default class EditSubscriptionsController extends EditResourceController {
    /*@ngInject*/
    constructor($injector, $scope) {
        super($injector, $scope);

    }

    contentLoaded(model) {
        super.contentLoaded(model);

        this.sortSubscriptions();

    }


    timeLeft(subscription) {
        return this.subscribedUntilDate(subscription).fromNow();
    }

    subscribedUntilDate(subscription) {
        return moment(subscription.subscribed_until, 'DD.MM.YYYY HH:mm');
    }

    sortSubscriptions() {
        var base = this;
        this.content.subscriptions = _.sortBy(this.content.subscriptions, (s) => {
                return this.subscribedUntilDate(s).format('X');
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

    deleteSubscription(subscription) {
        var base = this;
        this.modelApi.delete(subscription.id).then(function () {
            var index = base.subscriptions.indexOf(subscription);
            base.subscriptions.splice(index, 1);
            console.log('remove from ', index);
        });
    }


}