class ResourceCreateController {

    /*@ngInject*/ constructor($http) {
        this.$http = $http;
        this.model = {};
    }

    submit(){
        var payload = {
            title: this.model.title,
            body: this.model.body,
            created_at: this.model.createdAt,
            updated_at: this.model.updatedAt,
            user_id: this.model.userId,
            parent: this.model.parent
        };

        this.$http.post('/api/tutorials', payload)
            .success(result => {
                console.log(result);
            })
            .error(err => console.error(err));
    }

}

export default { name: 'ResourceCreateController', controller: ResourceCreateController };