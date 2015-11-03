class ResourceIndexController {

    /*@ngInject*/ constructor($scope, $http){
        this.$scope = $scope;
        this.$http = $http;
        this.models = [];
        this.searchText = '';
        this.selectAll = false;
        this.removing = 0;


        $http.get('/api/tutorials')
            .success(models => {
                this.models = models;

                this.models.forEach(model => model._meta = {});
            })
            .error(err => console.error(err));
    }

    getModels(){
        if(this.searchText.length > 0){
            return this.search();
        }

        return this.models;
    }

    getModelKeys(model){
        if(this.models.length > 0 && !model){
            model = this.models[0];
        }

        if(!model){
            return [];
        }

        var keys = Object.keys(model);

        return keys.filter(key => key !== '_meta' && model.hasOwnProperty(key));
    }

    getModelValues(model){
        var keys = this.getModelKeys(model);
        var values = [];

        keys.forEach(key => values.push(model[key]));

        return values;
    }

    canEdit(){
        return this.selected().length === 1;
    }

    canRemove(){
        return this.selected().length > 0;
    }

    search(){
        return this.models.filter(model => {
            for(var key in model){
                if(model.hasOwnProperty(key)){
                    var value = model[key];

                    if(String(value).indexOf(this.searchText) !== -1){
                        return true;
                    }
                }
            }
        });
    }

    updateSelectAll(){
        var models = this.getModels();

        models.forEach(model => model._meta.selected = this.selectAll);
    }

    selected(){
        return this.models.filter(model => model._meta.selected);
    }

    create(){
        //TODO
    }

    edit(){
        //TODO
    }

    remove(){
        var selected = this.selected();

        swal({
            title: 'Are you sure?',
            text: selected.length + ' models will be deleted!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete them!',
            confirmButtonColor: '#fb503b'
        }, confirmed => {
            if (!confirmed) {
                return;
            }

            selected.forEach(model => this.removeModel(model));
        });
    }

    removeModel(model){
        this.removing++;
        this.selectAll = false;
        model._meta.selected = false;
        model._meta.removed = true;

        this.removeRemoteModel(model)
            .success(result => {
                console.log(result);
                this.removeLocalModel(model);
            })
            .error(err => console.error(err))
            .finally(() => this.removing--);
    }

    removeLocalModel(model){
        for(var i = 0; i < this.models.length; i++){
            if(this.models[i] === model){
                return this.models.splice(i, 1);
            }
        }
    }

    removeRemoteModel(model){
        return this.$http.delete('/api/tutorials/' + model.id, {
            headers: {
                Accept: 'application/vnd.MezzoLabs.v1+json'
            }
        });
    }

    countSelected(){
        return this.selected().length;
    }

}

export default { name: 'ResourceIndexController', controller: ResourceIndexController };