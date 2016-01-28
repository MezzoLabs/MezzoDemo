import EditResourceController from "./EditResourceController";

export default class EditSubscriptionsController extends EditResourceController {
    /*@ngInject*/
    constructor($injector, $scope) {
        super($injector, $scope);


        this.subscriptionsApi = this.api.model('Subscription');


    }

    contentLoaded(model) {
        super.contentLoaded(model);




        this.sortSubscriptions();
    }

    /**
     * Strip the data tags and update the subscriptions on the screen.
     * @param response
     */
    onUpdated(response, request) {
        super.onUpdated(response, request);

        this.subscriptionsApi.index({'user': this.modelId})
            .then(response => {
                this.content.subscriptions = _.values(this.formDataService.transform(response));
                this.sortSubscriptions();
            });
    }


    timeLeft(subscription) {
        return this.subscribedUntilDate(subscription).fromNow();
    }

    subscribedUntilDate(subscription) {
        return moment(subscription.subscribed_until, 'DD.MM.YYYY HH:mm');
    }

    sortSubscriptions() {
        this.content.subscriptions = _.sortBy(this.content.subscriptions, (s) => {
                return this.subscribedUntilDate(s).format('X');
            }
        ).reverse();

    }

    changeCancel(subscription, cancelled = 1) {
        this.subscriptionsApi.update(subscription.id, {
            'cancelled': cancelled
        }).then(function () {
            subscription.cancelled = cancelled;
        });
    }

    deleteSubscription(subscription) {
        this.subscriptionsApi.delete(subscription.id).then(() => {
            var index = this.content.subscriptions.indexOf(subscription);
            this.content.subscriptions.splice(index, 1);
        });
    }


}