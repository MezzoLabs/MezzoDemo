import ModelApi from './ModelApi';

export default class Api {

    /** @ngInject */
    constructor($http, eventDispatcher) {
        this.$http = $http;
        this.eventDispatcher = eventDispatcher;
        this.latestResponse = null;
    }

    get(url, params = {}, options = {}) {
        const config = {
            params: params
        };

        return this.apiPromise(this.$http.get(url, config), options);
    }

    post(url, data, config = {}) {
        return this.apiPromise(this.$http.post(url, data, config));
    }

    put(url, data, config = {}) {
        return this.apiPromise(this.$http.put(url, data, config));
    }

    delete(url) {
        return this.apiPromise(this.$http.delete(url));
    }

    model(modelName) {
        return new ModelApi(this, modelName, this.eventDispatcher);
    }

    apiPromise($httpPromise, options = {}) {
        return $httpPromise
            .then(response => {

                this.latestResponse = response;

                return response.data.data;
            });
    }

    files() {
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
            });
    }

}