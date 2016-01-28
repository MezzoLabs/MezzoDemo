export default class ErrorHandlerService {

    showUnexpected(err) {
        var message = JSON.stringify(err);

        if (err.data && err.data.message) {
            message = err.statusText + '. ' + err.data.message;
        }

        console.error(err);
        sweetAlert('Oops, something spilled...', message, 'error');
        throw err;
    }

}