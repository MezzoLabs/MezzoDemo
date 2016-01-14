export default class File {

    constructor(apiFile) {
        this.id = apiFile.id;
        this.title = apiFile.filename;
        this.name = apiFile.filename;
        this.extension = apiFile.extension;
        this.url = apiFile.url;
        this.type = apiFile.type;
        this.isFolder = false;
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

    thumbnail() {
        if (this.isImage()) {
            return this.url + '?size=small';
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