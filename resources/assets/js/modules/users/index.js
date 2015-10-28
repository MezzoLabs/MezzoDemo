import State from '../../common/State';

export default new State('users', 'users', {
    main: {
        templateUrl: 'modules/users/users.html',
        controller: 'UsersController',
        controllerAs: 'vm'
    }
});