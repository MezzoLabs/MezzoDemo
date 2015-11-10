import Mode from './Mode';

class Model {

    constructor(id, name){
        this.id = id;
        this.name = name;
        this.mode = Mode.ONE;

        this.updateNaming();
        this.updateColumn();
    }

    label(){
        if(this.mode === Mode.ONE){
            return this.name;
        }

        if(this.mode === Mode.MANY){
            return pluralize(this.name);
        }

        return this.name;
    }

    updateNaming(){
        this.naming = this.name.toLowerCase();
    }

    updateColumn(){
        this.column = this.name.toLowerCase() + '_id';
    }

}

export default Model;