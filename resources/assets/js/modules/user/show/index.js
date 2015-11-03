import State from '../../../common/State';

export default new State('user-show', 'user/:userId', {
    main: {
        templateUrl: 'modules/user/show/user-show.html',
        controller: 'UserShowController',
        controllerAs: 'vm'
    }
});