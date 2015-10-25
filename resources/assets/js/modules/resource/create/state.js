import State from '../../../common/State';

export default new State('resource-create', 'sample/tutorial/create', {
    main: {
        templateUrl: 'modules/resource/create/test.html',
        controller: 'ResourceCreateController',
        controllerAs: 'vm'
    }
});