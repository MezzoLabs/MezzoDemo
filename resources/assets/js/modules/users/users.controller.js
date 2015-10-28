class UsersController {

    /*@ngInject*/ constructor($http){
        this.$http = $http;
        this.users = [];
        this.loading = true;

        this.$http.get('/api/users')
            .then(response => {
                this.loading = false;
                this.users = response.data;

                setTimeout(this.initTooltips, 1);
            })
            .catch(err => console.error(err));
    }

    moment(date){
        return moment(date).fromNow();
    }

    initTooltips(){
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });
    }

}

export default { name: 'UsersController', controller: UsersController };