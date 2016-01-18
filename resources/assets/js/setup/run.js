/*@ngInject*/
export default function run($rootScope) {
    showStateChangeErrors();

    function showStateChangeErrors() {
        $rootScope.$on('$stateChangeError', onStateChangeError);
    }

    function onStateChangeError(event, toState, toParams, fromState, fromParams, error) {
        console.error(event, toState, toParams, fromState, fromParams, error);

        const messageBuilder = [
            '<strong>Event:</strong> ' + event.name,
            '<strong>To state:</strong> ' + JSON.stringify(toState),
            '<strong>To params:</strong> ' + JSON.stringify(toParams),
            '<strong>From state:</strong> ' + JSON.stringify(fromState),
            '<strong>From params:</strong> ' + JSON.stringify(fromParams),
            '<strong>Error:</strong> ' + JSON.stringify(error)
        ];
        const message = messageBuilder.join('<br>');

        swal({
            title: 'Unexpected Error :(',
            html: message,
            type: 'error'
        });
    }
}