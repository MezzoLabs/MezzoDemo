/*@ngInject*/
export default function apiActionDirective(api, errorHandlerService, languageService) {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        const uri = attributes.href;
        const parameters = JSON.parse(attributes.parameters);

        console.log(element);

        //TODO:
        $(element).click(($event) => {
            $event.preventDefault();

            if (attributes.needsConfirmation == "1") {
                return showConfirmation(function () {
                    sendAction(uri, parameters);
                })
            }

            sendAction(uri, parameters);

        });
    }

    function showConfirmation(callback) {
        swal({
                title: languageService.get('messages.are_you_sure.title'),
                text: '',
                type: "warning",
                showCancelButton: true,
                confirmButtonText: languageService.get('general.yes'),
                cancelButtonText: languageService.get('general.cancel'),
                closeOnConfirm: false
            }
            , function () {
                callback();
            });
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