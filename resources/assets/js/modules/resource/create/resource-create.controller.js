class ResourceCreateController {

    /*@ngInject*/ constructor($http) {
        this.$http = $http;
        this.model = {};
    }

    submit(){
        if(this.form.$invalid){
            return false;
        }

        var payload = {
            title: this.model.title,
            body: this.model.body,
            created_at: this.model.createdAt,
            updated_at: this.model.updatedAt,
            user_id: this.model.userId,
            parent: this.model.parent
        };

        this.$http.post('/api/tutorials', payload)
            .then(result => {
                console.log(result);
            })
            .catch(err => console.error(err));
    }

    hasError(formControl){
        if(Object.keys(formControl.$error).length && formControl.$dirty){
            return 'has-error';
        }
    }

}

export default { name: 'ResourceCreateController', controller: ResourceCreateController };