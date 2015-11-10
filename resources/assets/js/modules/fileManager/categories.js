import Category from './Category';

export default [
    new Category('Everything', 'ion-ios-home', null, true),
    new Category('Images', 'ion-ios-photos', imageFilter),
    new Category('Videos', 'ion-ios-videocam', videoFilter),
    new Category('Audio', 'ion-ios-mic', audioFilter),
    new Category('Documents', 'ion-ios-paper', documentFilter)
];

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