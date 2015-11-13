import Api from './Api';

/*@ngInject*/
export default function apiService($http){
    return new Api($http);
}