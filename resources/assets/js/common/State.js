import Route from './Route';

export default class State {

    constructor(name, url, views){
        this.name = name;
        this.route = new Route(url, views);
    }

}