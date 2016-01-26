import MezzoEvent from './../events/Event';

export default class FormEvent extends MezzoEvent {
    constructor(key, payload, form){
        super(key, payload);
        this.form = form;
    }

}