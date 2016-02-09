import EventListener from './../events/Listener';

export default class FormEventListener extends EventListener {
    constructor(eventKey, callback, form) {
        super(eventKey, callback);
        this.form = form;

    }

    /**
     * Check if this listener belongs to a certain event and the according form.
     *
     * @param event
     * @returns {boolean}
     */
    listensTo(event) {
        return event.key == this.eventKey && event.form == this.form;
    }
}