export default class ErrorHandlerService {

    showUnexpected(err) {
        console.error(err);
        sweetAlert('Oops, something spilled...', JSON.stringify(err), 'error');
        throw err;
    }

}