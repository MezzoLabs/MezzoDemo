import State from './State';

export default { name: 'mezzoRegisterState', directive };

/*@ngInject*/
function directive($stateProvider) {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        var uri = attributes.uri;
        var title = attributes.title;
        var action = attributes.action;
        var state = new State(title, uri, {
            main: {
                templateUrl: '/mezzo/' + uri + '.html'
            }
        });
        console.log(action);
        $stateProvider.state(state.name, state.route);
    }
}