
/*@ngInject*/
export default function customRoutes($stateProvider) {

    $stateProvider.state('subscriptionsuser', {
        url: '/mezzo/user/user/edit/:modelId/subscriptions',
        templateUrl: '/mezzo/user/user/edit/subscriptions.html',
        controller: 'EditUserSubscriptionsController',
        controllerAs: 'vm'
    });



}