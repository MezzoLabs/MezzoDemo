import ModelApi from './ModelApi';

export default class Api {

    constructor($http){
        this.$http = $http;
    }

    get(url){
        return this.apiPromise(this.$http.get(url));
    }

    delete(url){
        return this.apiPromise(this.$http.delete(url));
    }

    model(modelName){
        return new ModelApi(this, modelName);
    }

    apiPromise($httpPromise){
        return $httpPromise
            .then(response => {
                return response.data.data;
            })
            .catch(err => {
                console.error(err);
                throw err;
            });
    }

    files(){
        return this.get('/api/files');
    }

}