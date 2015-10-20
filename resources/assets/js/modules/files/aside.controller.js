class FilesAsideController {

    /*@ngInject*/ constructor(fileManager){
        this.fileManager = fileManager;
        this.categories = [
            { label: 'Everything', icon: 'ion-ios-home', everything: true },
            { label: 'Images', icon: 'ion-ios-photos', filter: file => file.isImage() },
            { label: 'Videos', icon: 'ion-ios-videocam', filter: file => file.isVideo() },
            { label: 'Audio', icon: 'ion-ios-mic', filter: file => file.isAudio() },
            { label: 'Documents', icon: 'ion-ios-paper', filter: file => file.isDocument() }
        ];
        this.fileManager.category = this.categories[0];
        this.orderOptions = [ 'Title', 'Last modified' ];
        this.orderBy = this.orderOptions[0];
    }

    isActive(category){
        if(category === this.fileManager.category){
            return 'active';
        }
    }

    selectCategory(category){
        this.fileManager.category = category;
    }

}

export default { name: 'FilesAsideController', controller: FilesAsideController };