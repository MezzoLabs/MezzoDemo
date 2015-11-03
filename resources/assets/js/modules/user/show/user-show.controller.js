class UserShowController {

    /*@ngInject*/
    constructor($http, $stateParams) {
        this.$http = $http;
        this.$routeParams = $stateParams;
        this.user = null;
        this.userId = $stateParams.userId;

        this.loadUser(this.userId);
    }

    loadUser(userId) {
        this.loading = true;
        var apiUrl = '/api/users/' + userId;

        this.$http.get(apiUrl)
            .then(response = > {
            this.loading = false;
        this.user = response.data.user;
    }

)
.
    catch(err =

>
    console
.
    error(err)

)
    ;
}

saveUser()
{
    this.$http.put('/api/users/' + this.userId, this.user)
        .then(response = > {
        console.log(response);
}
)
.
catch(err = > console.error(err)
)
;
}

moment(date)
{
    return moment(date).fromNow();
}

}

export default {name: 'UserShowController', controller: UserShowController};