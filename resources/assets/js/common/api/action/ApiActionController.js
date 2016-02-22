export default class ApiActionController {
    constructor(api) {
        this.api = api;
        console.log(this);
    }

    click() {
        console.log($event);
        this.api.get(this.href, this.parameters);
    }
}