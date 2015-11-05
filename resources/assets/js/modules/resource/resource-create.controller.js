class ResourceCreateController {

    /*@ngInject*/
    constructor($http) {
        console.log('ResourceCreateController');
        this.$http = $http;
        this.model = {};

        /* Fake data */
        this.users = [
            { id: 0, name: 'Simon' },
            { id: 1, name: 'Marc' },
            { id: 2, name: 'John Doe' },
            { id: 3, name: 'MSDOS Manfred' }
        ];
        this.tutorials = [
            { id: 0, name: 'Mezzo Tutorial' },
            { id: 1, name: 'How to peel an Egg Tutorial Part 1' },
            { id: 2, name: 'How to sit down Tutorial' }
        ];
        /* Fake data */
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