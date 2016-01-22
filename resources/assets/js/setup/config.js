import addCustomRoutes from "./customRoutes";
import addTranslations from "./lang";

/*@ngInject*/
export default function config($locationProvider, $httpProvider, $stateProvider, $translateProvider) {
    $httpProvider.defaults.headers.common.Accept = 'application/vnd.MezzoLabs.v1+json';

    addCustomRoutes($stateProvider);
    addTranslations($translateProvider);

    $locationProvider.html5Mode(true);
}