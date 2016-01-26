import Listener from './Listener';
import Event from './Event';

export default class EventDispatcherService {

    constructor() {
        this.listeners = [];
    }


    /**
     * Execute all the listeners that listen to this event.
     *
     * @param {Event} event
     */
    fire(event) {
        for (var i in this.listeners) {
            var listener = this.listeners[i];

            if (!listener.listensTo(event)) {
                continue;
            }

            var execution = listener.execute(event, event.payload);

            if(execution === false){
                console.error('A listener stopped the chain', listener, event);
                return false;
            }
        }

        return true;
    }

    /**
     * Register a new listener
     *
     * @param {Listener} listener
     */
    listen(listener) {
        this.listeners.push(listener);
    }

    /**
     * Alias for this.listen
     *
     * @param {Listener} listener
     */
    register(listener){
        this.listen(listener);
    }

    /**
     * Creates and registers a new listener.
     *
     * @param {string} eventKey
     * @param callback
     * @returns {Listener}
     */
    makeListener(eventKey, callback) {
        var listener = new Listener(eventKey, callback);

        this.listen(listener);

        return listener;
    }


}