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
        var page = attributes.page;
        var action = attributes.action;
        var controller = mapActionToController(action);
        var state = new State(page, uri, {
            main: {
                templateUrl: '/mezzo/' + uri + '.html',
                controllerAs: 'vm',
                controller: controller

            }
        });

        $stateProvider.state(state.name, state.route);
    }
}

function mapActionToController(action){
    var controllers = {
        index: 'ResourceIndexController',
        create: 'ResourceCreateController',
        edit: 'ResourceEditController'
    };

    return controllers[action];
}