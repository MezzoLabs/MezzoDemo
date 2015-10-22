const prefix = '/mezzo/';

export default class Route {

    constructor(url, views){
        this.url = prefix + url;
        this.views = views;
    }

}