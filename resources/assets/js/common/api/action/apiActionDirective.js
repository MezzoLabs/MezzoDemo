/*@ngInject*/
export default function registerStateDirective(api, errorHandlerService) {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        var uri = attributes.uri;
        var parameters = attributes.parameters;


        scope.sendAction = ($event) => {

            $event.preventDefault();
            sendAction(attributes.href, attributes.parameters);
        };
    }

    function sendAction(uri, parameters) {
        return api.get(uri, parameters)
            .then(result => showResult(result))
            .catch((err) => errorHandlerService.showUnexpected(err));
    }

    function showResult(result) {
        if (result.message && result.title) {
            console.log('result');
            swal(result.title, result.message, 'success');
            return;
        }

        alert('Unexpected action result!');
    }
};