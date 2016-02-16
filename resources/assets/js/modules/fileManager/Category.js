export default class Category {

    constructor(key, label, icon, filter = null, everything = false) {
        this.key = key;
        this.label = label;
        this.icon = icon;
        this.filter = filter;
        this.everything = everything;
    }

}