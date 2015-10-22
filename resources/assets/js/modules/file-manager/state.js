import State from '../../common/State';

export default new State('files', 'files', {
    aside: {
        templateUrl: 'modules/file-manager/aside.html',
        controller: 'FilesAsideController as vm'
    },
    main: {
        templateUrl: 'modules/file-manager/main.html',
        controller: 'FilesMainController as vm'
    }
});