/*@ngInject*/
export default function run($rootScope) {
    showStateChangeErrors();

    function showStateChangeErrors() {
        $rootScope.$on('$stateChangeStart', onStateChangeError);
    }

    function onStateChangeError(event, toState, toParams, fromState, fromParams, error) {
        console.error(event, toState, toParams, fromState, fromParams, error);

        const messageBuilder = [
            'Event: ' + event.name,
            'To state: ' + JSON.stringify(toState),
            'To params: ' + JSON.stringify(toParams),
            'From state: ' + JSON.stringify(fromState),
            'From params: ' + JSON.stringify(fromParams),
            'Error: ' + JSON.stringify(error)
        ];
        const message = messageBuilder.join('<br>');

        swal({
            title: 'Unexpected Error :(',
            html: message,
            type: 'error'
        });
    }
}