
/*@ngInject*/
export default function customRoutes($stateProvider) {

    $stateProvider.state('subscriptionsuser', {
        url: '/mezzo/user/user/subscriptions/:modelId',
        templateUrl: '/mezzo/user/user/subscriptions.html',
        controller: 'EditSubscriptionsController',
        controllerAs: 'vm'
    });



}