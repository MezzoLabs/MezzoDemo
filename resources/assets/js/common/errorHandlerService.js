export default class ErrorHandlerService {

    showUnexpected(err) {
        var message = JSON.stringify(err);

        if(err.data && err.data.message){
            message = error.statusText + '. ' + error.data.message;
        }

        console.error(err);
        sweetAlert('Oops, something spilled...', message, 'error');
        throw err;
    }

}