import State from '../../common/State';

export default new State('files', 'files', {
    aside: {
        templateUrl: 'modules/files/aside.html',
        controller: 'FilesAsideController as vm'
    },
    main: {
        templateUrl: 'modules/files/main.html',
        controller: 'FilesMainController as vm'
    }
});