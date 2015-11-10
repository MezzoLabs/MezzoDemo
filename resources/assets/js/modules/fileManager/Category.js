export default class Category {

    constructor(label, icon, filter = null, everything = false){
        this.label = label;
        this.icon = icon;
        this.filter = filter;
        this.everything = everything;
    }

}