class UserListController {

    /*@ngInject*/ constructor($http, userService){
    this.$http = $http;
    this.userService = userService;
    this.users = userService.users || [];

    if(!this.users || this.users.length === 0){
        this.loadUsers();
    }
}

    loadUsers(){
        this.loading = true;

        this.$http.get('/api/users')
            .then(response => {
                this.loading = false;
                this.users = response.data;
                this.userService.users = this.users;

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

export default { name: 'UserListController', controller: UserListController };