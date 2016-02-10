import Listener from './Listener';
import MezzoEvent from './Event';

export default class EventDispatcherService {

    constructor($rootScope) {
        this.listeners = [];
        this.eventHistory = [];

        this.$rootScope = $rootScope;

        this.$rootScope.$on('$stateChangeStart',
            (event, toState, toParams, fromState, fromParams, options) => {
                this.clear();
            });
    }


    /**
     * Execute all the listeners that listen to this event.
     *
     * @param {MezzoEvent} event
     */
    fire(event) {
        this.eventHistory.push(event);


        for (var i in this.listeners) {
            var listener = this.listeners[i];

            if (!listener.listensTo(event)) {
                continue;
            }

            var execution = listener.execute(event, event.payload);

            if (execution === false) {
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
    register(listener) {
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

    /**
     * Creates an event and fires it directly.
     *
     *
     * @param eventKey
     * @param payload
     */
    makeAndFire(eventKey, payload) {
        var event = new MezzoEvent(eventKey, payload);

        return this.fire(event);
    }

    /**
     * Alias for makelistener
     *
     *
     * @param eventKey
     * @param callback
     * @returns {Listener}
     */
    on(eventKey, callback) {
        if (Array.isArray(eventKey))
            return this.listenForAll(eventKey, callback);

        return this.makeListener(eventKey, callback);
    }

    listenForAll(eventKeys, callback) {
        var received = {};
        var payloads = {};
        var events = {};

        for (var i in eventKeys) {
            const eventKey = eventKeys[i];
            this.makeListener(eventKey, (event, payload) => {
                received[event.key] = 1;
                payloads[eventKey] = payload;
                events[eventKey] = event;

                if (_.size(received) == eventKeys.length) {
                    callback(events, payloads);
                }
            });
        }
    }

    findInHistory(eventKey) {
        return _.find(this.eventHistory, function (event) {
            return event.key == eventKey;
        });
    }

    isInHistory(eventKey) {
        return !!this.findInHistory(eventKey);
    }

    clear() {
        for (var i in this.listeners) {
            delete this.listeners[i];
        }

        for (var j in this.eventHistory) {
            delete this.eventHistory[j];
        }

        this.listeners = [];
        this.eventHistory = [];

        console.log('listeners and history cleared');
    }


}