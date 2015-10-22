class TestMainController {

    /*@ngInject*/ constructor($http){
        this.models = [];
        this.searchText = '';
        this.selectAll = false;


        $http.get('/api/tutorials', {
            headers: {
                Accept: 'application/vnd.MezzoLabs.v1+json'
            }
        }).success(models => {
            this.models = models;

            this.models.forEach(model => model._meta = {});
        }).error(err => {
            console.error(err);
        });
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
        //TODO
    }

    countSelected(){
        return this.selected().length;
    }

}

export default { name: 'TestMainController', controller: TestMainController };