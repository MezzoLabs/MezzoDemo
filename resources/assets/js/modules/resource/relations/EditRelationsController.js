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

        this.inputs = {};

        this.addForm = this.form;
        this.editForms = this.forms;
    }

    init(from, to) {
        console.log('init', from, to);
    }


}