import State from '../../common/State';

export default new State('files', 'filemanager', {
    main: {
        templateUrl: 'mezzo/filemanager/file/create.html',
        controller: 'FileManagerController as vm'
    }
});