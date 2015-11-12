import File from './File';

export default class Folder extends File {

    constructor(name, parent = null){
        super(name, name, '');

        this.parent = parent;
        this.type = 'folder';
        this.isFolder = true;
        this.files = [];
    }

}