import File from './File';

export default class Folder extends File {

    constructor(name, parent = null){
        super({
            id: '',
            filename: name,
            extension: '',
            url: ''
        });

        this.parent = parent;
        this.type = 'folder';
        this.isFolder = true;
        this.files = [];
    }

    path() {
        const folders = [this.name];
        let folder = this;

        while (folder.parent) {
            folders.push(folder.parent.name);

            folder = folder.parent;
        }

        folders.reverse();

        return '/' + folders.join('/');
    }

}