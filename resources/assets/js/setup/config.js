import addCustomRoutes from "./customRoutes";

/*@ngInject*/
export default function config($locationProvider, $httpProvider, $stateProvider) {
    $httpProvider.defaults.headers.common.Accept = 'application/vnd.MezzoLabs.v1+json';

    addCustomRoutes($stateProvider)

    $locationProvider.html5Mode(true);
}