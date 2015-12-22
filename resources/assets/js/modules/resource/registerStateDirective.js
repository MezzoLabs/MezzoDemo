import Action from './Action';

/*@ngInject*/
export default function registerStateDirective($stateProvider, hasController) {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        var uri = attributes.uri;
        var page = attributes.page;
        var action = attributes.action;

        registerState(uri, page, action);

        if(action === Action.CREATE) {
            registerState(uri.replace('create', 'edit'), page.replace('Create', 'Edit'), Action.EDIT);
        }
    }

    function registerState(uri, page, action) {
        const url = urlForAction(uri, action);
        let controller = controllerForPage(page);

        if (!controller) {
            controller = controllerForAction(action);
        }

        $stateProvider.state(page, {
            url: url,
            templateUrl: '/mezzo/' + uri + '.html',
            controller: controller,
            controllerAs: 'vm'
        });
    }

    function controllerForPage(page) {
        const controllerName = page + 'Controller';

        if(hasController(controllerName)){
            console.info('Found custom ' + controllerName);

            return controllerName;
        }

        return null;
    }

    function controllerForAction(action) {
        if (action === Action.INDEX) {
            return 'ResourceIndexController';
        }

        if (action === Action.CREATE) {
            return 'ResourceCreateController';
        }

        if (action === Action.EDIT) {
            return 'ResourceEditController';
        }

        if (action === Action.SHOW) {
            return 'ResourceShowController';
        }

        throw new Error(`No suitable Controller found for action "${action}"!`);
    }

    function urlForAction(uri, action){
        const url = '/mezzo/' + uri;

        if(action === Action.EDIT){
            return url + '/:modelId';
        }

        return url;
    }
}