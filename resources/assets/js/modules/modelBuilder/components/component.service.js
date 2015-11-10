exports.name = 'componentService';
exports.service = function inject(){
    return new ComponentService();
};

class ComponentService {

    constructor(){
        this.options = null;
        this.eventListeners = [];
    }

    setOptions(options){
        this.options = options;

        this.eventListeners.forEach(eventListener => {
            eventListener(options);
        });
    }

    onOptionsChange(eventListener){
        eventListener(this.options);
        this.eventListeners.push(eventListener);
    }

}
