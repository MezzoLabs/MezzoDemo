export default class ErrorHandlerService {

    showUnexpected(err) {
        var message = JSON.stringify(err);

        if (err.data && err.data.message) {
            message = err.statusText + '. ' + err.data.message;
        }

        if(message.indexOf('{') == -1){
            message = this.htmlDecode(message);
        }

        console.error(err);
        sweetAlert('Oops, something spilled...', message, 'error');
        throw err;
    }

    htmlDecode(text){
        var doc = new DOMParser().parseFromString(text, "text/html");
        return doc.documentElement.textContent;
    }

}