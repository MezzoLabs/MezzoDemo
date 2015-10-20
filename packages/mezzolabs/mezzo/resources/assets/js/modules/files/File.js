class File {

    constructor(title, name, extension){
        this.title = title;
        this.name = name;
        this.extension = extension;
        this.type = 'file';
        this.isFolder = false;
    }

    icon(){
        if(this.isImage()){
            return 'ion-image';
        }

        if(this.isVideo()){
            return 'ion-ios-videocam';
        }

        if(this.isAudio()){
            return 'ion-music-note';
        }

        if(this.extension === 'pdf'){
            return 'ion-printer';
        }

        return 'ion-document';
    }

    isImage(){
        return this.hasExtension('png', 'jpg', 'gif');
    }

    isVideo(){
        return this.hasExtension('mp4', 'avi');
    }

    isAudio(){
        return this.hasExtension('mp3');
    }

    isDocument(){
        return this.hasExtension('txt', 'md', 'pdf');
    }

    /* public */
    /* private */

    hasExtension(){
        for(var i = 0; i < arguments.length; i++){
            if(this.extension === arguments[i]){
                return true;
            }
        }

        return false;
    }

}

export default File;