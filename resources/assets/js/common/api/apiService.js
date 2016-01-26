import Api from './Api';

/*@ngInject*/
export default function apiService($http, eventDispatcher) {
    return new Api($http, eventDispatcher);
}