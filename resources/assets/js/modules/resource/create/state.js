import State from '../../../common/State';

export default new State('resource-create', 'model/create', {
    main: {
        templateUrl: '/mezzo/sample/tutorial/create.html',
        controller: 'ResourceCreateController',
        controllerAs: 'vm'
    }
});