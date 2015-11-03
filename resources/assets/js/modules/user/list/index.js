import State from '../../../common/State';

export default new State('user-list', 'users', {
    main: {
        templateUrl: 'modules/user/list/user-list.html',
        controller: 'UserListController',
        controllerAs: 'vm'
    }
});