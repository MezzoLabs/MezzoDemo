import ModelApi from './ModelApi';

export default class Api {

    constructor($http){
        this.$http = $http;
    }

    get(url, params = {}) {
        const config = {
            params: params
        };

        return this.apiPromise(this.$http.get(url, config));
    }

    post(url, data) {
        return this.apiPromise(this.$http.post(url, data));
    }

    put(url, data) {
        return this.apiPromise(this.$http.put(url, data));
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
                this.showUnexpectedErrorMessage(JSON.stringify(err));
                throw err;
            });
    }

    files(){
        return this.get('/api/files');
    }

    moveFile(file, folderPath) {
        const payload = {
            folder: folderPath
        };

        return this.put('/api/files/' + file.id, payload);
    }

    deleteFile(file) {
        return this.delete('/api/files/' + file.id);
    }

    contentBlockTemplate(hash) {
        return this.$http.get(`/mezzo/content-block-types/${ hash }.html`)
            .then(response => {
                return response.data;
            })
            .catch(err => {
                console.error(err);
                throw err;
            });
    }

    showUnexpectedErrorMessage(message) {
        sweetAlert('Oops...', message, 'error');
    }

}