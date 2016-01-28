export default class File {

    constructor(apiFile) {
        this.id = apiFile.id;
        this.title = apiFile.filename;
        this.name = apiFile.filename;
        this.extension = apiFile.extension;
        this.addon = apiFile.addon;
        this.url = apiFile.url;
        this.type = apiFile.type;
        this.filePath = apiFile.path;
        this.isFolder = false;
    }

    displayFolderPath() {
        if(this.filePath.indexOf('/') === -1) {
            return 'Library';
        }

        const filePathSplitted = this.filePath.split('/');

        return filePathSplitted.slice(0, filePathSplitted.length - 1).join('/');
    }

    displayPath(){
        return this.displayFolderPath() + '/' + this.name;
    }

    icon() {
        if (this.isImage()) {
            return 'ion-image';
        }

        if (this.isVideo()) {
            return 'ion-ios-videocam';
        }

        if (this.isAudio()) {
            return 'ion-music-note';
        }

        if (this.extension === 'pdf') {
            return 'ion-printer';
        }

        return 'ion-document';
    }

    isImage() {
        return this.hasExtension('png', 'jpg', 'gif', 'jpeg');
    }

    isVideo() {
        return this.hasExtension('mp4', 'avi');
    }

    isAudio() {
        return this.hasExtension('mp3');
    }

    isDocument() {
        return this.hasExtension('txt', 'md', 'pdf');
    }

    thumbnail(size = 'thumb') {
        if (this.isImage()) {
            if(size) {
                return this.url + '?size=' + size;
            }

            return this.url;
        }


        return false;
    }

    /* public */
    /* private */

    hasExtension() {
        for(var i = 0; i < arguments.length; i++){
            if(this.extension === arguments[i]){
                return true;
            }
        }

        return false;
    }

}