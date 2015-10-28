import State from '../../common/State';

export default new State('permissions', 'permissions', {
    main: {
        templateUrl: 'modules/permissions/permissions.html',
        controller: 'PermissionsController',
        controllerAs: 'vm'
    }
});