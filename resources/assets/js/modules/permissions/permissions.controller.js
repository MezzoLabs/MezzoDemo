class PermissionsController {

    /*@ngInject*/ constructor($http){
    this.$http = $http;
    this.permissions = [];
    this.loading = true;

    this.$http.get('/api/permissions')
        .then(response => {
            this.loading = false;
            this.permissions = response.data;
        })
        .catch(err => console.error(err));
}

}

export default { name: 'PermissionsController', controller: PermissionsController };