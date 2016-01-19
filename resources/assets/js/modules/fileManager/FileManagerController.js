import File from './File';
import Folder from './Folder';
import categories from './categories';

export default class FileManagerController {

    /*@ngInject*/
    constructor($scope, api, Upload, quickviewService) {
        this.$scope = $scope;
        this.api = api;
        this.Upload = Upload;
        this.quickviewService = quickviewService;

        this.categories = categories;
        this.category = this.categories[0];
        this.orderOptions = [ 'Title', 'Last modified' ];
        this.orderBy = this.orderOptions[0];
        this.selected = null;
        this.loading = false;

        this.initFiles();
    }

    initFiles() {
        this.library = new Folder('Library', null, true);
        this.folder = this.library;
        this.files = this.library.files;
        this.loading = true;
        const folders = {};

        this.api.files().then(apiFiles => {
            this.loading = false;

            apiFiles.forEach(apiFile => {
                const file = new File(apiFile);
                const filePath = apiFile.path;

                if(filePath.indexOf('/') === -1) {
                    this.library.files.push(file);
                    return;
                }

                const filePathArray = filePath.split('/');
                const folderPathArray = filePathArray.slice(0, filePathArray.length - 1);
                console.log('folders before:', folders);
                const folderForFile = this.getFolderByPath(folders, folderPathArray);
                console.log('folders after:', folders, folderForFile);
                folderForFile.files.push(file);
            });
        });
    }

    getFolderByPath(folders, folderPathArray) {
        if (folderPathArray.length === 0) {
            return this.library;
        }

        const previousFolder = this.getFolderByPath(folders, folderPathArray.slice(0, folderPathArray.length - 1));
        const folderPath = folderPathArray.join('.');
        let folder = _.get(folders, folderPath);

        if (!folder) {
            const folderName = folderPathArray[folderPathArray.length - 1];
            folder = new Folder(folderName, previousFolder);

            previousFolder.files.push(folder);
            _.set(folders, folderPath, folder);
        }

        return folder;
    }

    isActive(category){
        if(category === this.category){
            return 'active';
        }
    }

    selectCategory(category){
        this.category = category;
    }

    selectFile(file){
        if(file === this.selected){
            this.selected = null;
            this.quickviewService.open = false;

            return;
        }

        this.selected = file;
        this.quickviewService.open = true;
    }

    enterFolder(file){
        if(file.isFolder){
            this.folder = file;
            this.files = file.files;
        }
    }

    folderHierarchy(){
        var folders = [];
        var folder = this.folder;

        while(folder){
            folders.push(folder);

            folder = folder.parent;
        }

        return folders.reverse();
    }

    showFolderHierarchy(){
        return this.category.everything && !this.search;
    }

    showCategoryAsFolderHierarchy(){
        return !this.category.everything && !this.search;
    }

    addFolder(name){
        if(!name){
            return false;
        }

        this.folderName = '';
        const newFolder = new Folder(name, this.folder);

        this.folder.files.push(newFolder);
        $('#add-folder-modal').modal('hide');
    }

    getFiles(){
        if(this.search){
            return this.searchFiles();
        }

        var category = this.category;

        if(category.everything){
            return this.files;
        }

        var filteredFiles = [];

        this.allFiles().forEach(file => {
            if(category.filter(file)){
                filteredFiles.push(file);
            }
        });

        return filteredFiles;
    }

    searchFiles(){
        var files = this.allFiles();
        var found = [];
        var lowerSearch = this.search.toLowerCase();

        files.forEach(file => {
            if(file.title.toLowerCase().indexOf(lowerSearch) !== -1){
                found.push(file);
            }
        });

        return found;
    }

    sortedFiles(){
        var files = this.getFiles();
        var folders = [];
        var notFolders = [];

        files.forEach(file => {
            if(file.isFolder){
                folders.push(file);
            } else {
                notFolders.push(file);
            }
        });

        return folders.concat(notFolders);
    }

    allFiles(folder = this.library){
        var files = [];

        folder.files.forEach(file => {
            files.push(file);

            if(file.isFolder){
                files = files.concat(this.allFiles(file));
            }
        });

        return files;
    }

    items(file){
        var count = 0;

        if(file.isFolder){
            count = file.files.length;
        }

        return count + ' ' + (count === 1 ? 'item': 'items');
    }

    deleteFiles(){
        var file = this.selected;

        if(file) {
            swal({
                title: 'Sind Sie sicher?',
                text: 'Die folgenden Dateien werden unwiderruflich gelöscht: ' + file.title,
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ja, Dateien löschen!',
                confirmButtonColor: '#fb503b',
                cancelButtonText: 'Abbrechen'
            }, confirmed => {
                if (!confirmed) {
                    return;
                }

                this.selected = null;

                this.deleteFile(file);
                this.$scope.$apply();
            });
        }
    }

    deleteFile(file, deleteRemote = true){
        _.remove(this.files, file);

        if (!deleteRemote) {
            return;
        }

        this.api.deleteFile(file);
    }

    moveTo(folder){
        this.moveFile(this.selected, folder);
        $('#move-modal').modal('hide');
        this.enterFolder(folder);
    }

    moveFile(file, folder) {
        this.api.moveFile(file, folder.path());
        this.deleteFile(file, false); // false because we do not want to delete the remote file

        if(file.isFolder){
            file.parent = folder;
        }

        folder.files.push(file);
    }

    upload(file){
        this.Upload.upload({
            url: '/api/files/upload',
            data: {
                file: file
            },
            headers: {
                Accept: 'application/vnd.MezzoLabs.v1+json'
            }
        }).then(response => {
            this.initFiles();
        }).catch(err => {
            console.error(err);
        });
    }

    onDrop(droppable, draggable){
        var files = this.sortedFiles();
        var folderIndex = $(droppable).data('index');
        var draggedIndex = $(draggable).data('index');
        var folder = files[folderIndex];
        var dragged = files[draggedIndex];

        this.moveFile(dragged, folder);
        this.$scope.$apply();
    }

    refresh() {
        this.initFiles();
    }

    canMove() {
        if(this.selected && this.selected.isFile) {
            return true;
        }

        return false;
    }

}