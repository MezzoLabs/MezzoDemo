import Event from './Event';

export default class Listener {

    constructor(eventKey, callback) {
        this.eventKey = eventKey;
        this.callback = callback;
    }

    /**
     * Check if this listener belongs to a certain event.
     *
     * @param event
     * @returns {boolean}
     */
    listensTo(event) {
        return event.key == this.eventKey;
    }

    /**
     * Run the callback with the payload given in the fired event.
     *
     * @param {Event} event
     * @param {object} payload
     */
    execute(event, payload) {
        return this.callback(event, payload);
    }
}