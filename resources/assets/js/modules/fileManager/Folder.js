import File from './File';

export default class Folder extends File {

    constructor(name, parent = null, skipInPath = false){
        super({
            id: '',
            filename: name,
            extension: '',
            url: ''
        });

        this.parent = parent;
        this.skipInPath = skipInPath;
        this.type = 'folder';
        this.isFolder = true;
        this.files = [];
    }

    displayFolderPath() {
        return this.path();
    }

    path() {
        if (this.skipInPath) {
            return '';
        }

        const folders = [this.name];
        let folder = this;

        while (folder.parent) {
            if (folder.parent.skipInPath) {
                break;
            }

            folders.push(folder.parent.name);

            folder = folder.parent;
        }

        folders.reverse();

        return '/' + folders.join('/');
    }

}