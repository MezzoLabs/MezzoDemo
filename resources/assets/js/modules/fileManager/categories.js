import Category from './Category';

export default [
    new Category('everything', 'Everything', 'ion-ios-home', everythingFilter, true),
    new Category('images', 'Images', 'ion-ios-photos', imageFilter),
    new Category('videos', 'Videos', 'ion-ios-videocam', videoFilter),
    new Category('audio', 'Audio', 'ion-ios-mic', audioFilter),
    new Category('documents', 'Documents', 'ion-ios-paper', documentFilter)
];

function everythingFilter(file){
    return true;
}

function imageFilter(file){
    return file.isImage();
}

function videoFilter(file){
    return file.isVideo();
}

function audioFilter(file){
    return file.isAudio();
}

function documentFilter(file){
    return file.isDocument();
}