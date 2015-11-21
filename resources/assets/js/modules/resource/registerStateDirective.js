/*@ngInject*/
export default function registerStateDirective($stateProvider, $controller) {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        var uri = attributes.uri;
        var page = attributes.page;
        var action = attributes.action;
        var controller = controllerForPage(page);

        if (!controller) {
            controller = controllerForAction(action);
        }

        $stateProvider.state(page, {
            url: '/mezzo/' + uri,
            templateUrl: '/mezzo/' + uri + '.html',
            controller: controller,
            controllerAs: 'vm'
        });
    }

    function controllerForPage(page) {
        try {
            var controllerName = page + 'Controller';

            $controller(controllerName);

            return controllerName;
        } catch (err) {
            return null;
        }
    }

    function controllerForAction(action) {
        if (action === 'index') {
            return 'ResourceIndexController';
        }

        if (action === 'create') {
            return 'ResourceCreateController';
        }

        if (action === 'edit') {
            return 'ResourceEditController';
        }

        if (action === 'show') {
            return 'ResourceShowController';
        }

        throw new Error(`No suitable Controller found for action "${action}"!`);
    }
}