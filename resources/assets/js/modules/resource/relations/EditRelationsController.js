import FormDataReader from './../../../common/forms/FormDataReader';
import FormSubmitter from './../../../common/forms/FormSubmitter';
import FormObject from './../../../common/forms/FormObject';

export default class EditRelationsController {
    /**
     * @ngInject
     * @param $injector
     * @param $scope
     */
    constructor($injector, $scope) {
        this.$injector = $injector;
        this.$scope = $scope;

        this.api = this.$injector.get('api');
        this.formDataService = this.$injector.get('formDataService');
        this.eventDispatcher = this.$injector.get('eventDispatcher');
        this.$timeout = this.$injector.get('$timeout');

        this.$stateParams = $injector.get('$stateParams');
        this.modelId = this.$stateParams.modelId;

        this.modelName = null;
        this.relationName = null;

        this.modelApi = null;
        this.relationApi = null;

        this.relationItems = {};
        this.modelItem = {};
        this.inputs = {};

        this.formDataReader = new FormDataReader();
        this.formSubmitter = new FormSubmitter(this, $injector);


        this.$scope.$on('$destroy', () => this.onDestroy());
    }

    onDestroy() {
    }

    init(modelName, relationName) {
        this.modelName = modelName;
        this.relationName = relationName;

        this.modelApi = this.api.model(modelName);
        this.relationApi = this.api.relation(modelName, relationName);

        this.loadRelationItems();
        this.loadModelItem();

    }

    loadRelationItems() {
        this.relationApi.index(this.modelId).then((data) => {
            this.relationItemsLoaded(data);
        });
    }

    loadModelItem(){
        this.modelApi.content(this.modelId).then((data) => {
           this.modelItemLoaded(data);
        });
    }

    relationItemsLoaded(data) {
        const cleaned = this.formDataService.transform(data);

        var prefixedAndFlattened = {};

        _.forEach(cleaned.flattened, (value, key) => {
            prefixedAndFlattened[this.relationName + '.' + key] = value;
        });

        this.inputs = prefixedAndFlattened;
        this.relationItems = cleaned.stripped;

            this.addRelationForm().$setPristine();

    }

    modelItemLoaded(data){
        const cleaned = this.formDataService.transform(data);

        this.modelItem = cleaned.stripped;
    }

    submit($event, formController) {
        if (formController == this.addRelationForm()) {
            return this.submitAddRelation($event);
        }

        return this.submitEditRelation($event, formController);
    }

    submitAddRelation($event) {
        return this.formSubmitter.run($event.target, this.addRelationForm(), {
            doSubmit: (formData) => {
                return this.doAddRelation(formData)
            }
        });
    }

    doAddRelation(formData) {
        return this.modelApi.update(this.modelId, formData, {})
            .then(model => {
                toastr.success('Added to ' + this.relationName);
                this.loadRelationItems();
            });
    }

    submitEditRelation($event, formController) {
        return this.formSubmitter.run($event.target, formController, {
            doSubmit: (formData) => {
                return this.doEditRelation(formData)
            }
        });
    }

    doEditRelation(formData) {
        return this.modelApi.update(this.modelId, formData, {})
            .then(model => {
                toastr.success('Edited ' + this.relationName);
            });
    }

    addRelationForm() {
        return this.form;
    }

    editRelationForms() {
        return this.forms;
    }

    deleteRelationItem(relationItem) {

    }


}