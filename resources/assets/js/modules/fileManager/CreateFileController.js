import File from './File';
import Folder from './Folder';
import categories from './categories';

export default class CreateFileController {

    /*@ngInject*/
    constructor($scope, api, Upload){
        this.$scope = $scope;
        this.api = api;
        this.Upload = Upload;

        this.categories = categories;
        this.category = this.categories[0];
        this.orderOptions = [ 'Title', 'Last modified' ];
        this.orderBy = this.orderOptions[0];
        this.selected = null;

        this.initFiles();
    }

    initFiles(){
        this.library = new Folder('Library');
        this.folder = this.library;
        this.files = this.library.files;

        this.api.files().then(apiFiles => {
            apiFiles.forEach(apiFile => {
                const file = new File(apiFile);

                this.library.files.push(file);
            });
        });
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

            return;
        }

        this.selected = file;
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
        var folder = new Folder(name, this.folder);

        this.folder.files.push(folder);
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

    deleteFile(file){
        for(var i = 0; i < this.files.length; i++){
            if(file === this.files[i]){
                this.files.splice(i, 1);

                return;
            }
        }
    }

    moveTo(folder){
        this.moveFile(this.selected, folder);
        $('#move-modal').modal('hide');
        this.enterFolder(folder);
    }

    moveFile(file, folder){
        this.deleteFile(file);

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

}