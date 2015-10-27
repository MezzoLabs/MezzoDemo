import State from '../../../common/State';

export default new State('user-list', 'user/list', {
    main: {
        templateUrl: '/modules/user/list/view.html',
        controller: 'UserListController',
        controllerAs: 'vm'
    }
});