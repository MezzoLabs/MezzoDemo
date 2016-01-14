import Action from './Action';

/*@ngInject*/
export default function registerStateDirective($location, $stateProvider, hasController) {
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

        initSidebarBehaviour(element);
    }

    function registerState(uri, page, action) {
        const stateName = page.toLowerCase();
        const url = urlForAction(uri, action);
        let controller = controllerForPage(page);

        if (!controller) {
            controller = controllerForAction(action);
        }
        console.log(stateName);
        $stateProvider.state(stateName, {
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
            return 'IndexResourceController';
        }

        if (action === Action.CREATE) {
            return 'CreateResourceController';
        }

        if (action === Action.EDIT) {
            return 'EditResourceController';
        }

        if (action === Action.SHOW) {
            return 'ShowResourceController';
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

    function initSidebarBehaviour(element) {
        const $element = $(element);
        const url = $location.url();
        const href = '/' + $element.attr('href');

        if(url === href) {
            $element
                .addClass('active')
                .parents('li.has-pages')
                .addClass('opened');
        }

        $element.click(() => {
            $('a[data-mezzo-register-state]').removeClass('active')
            $element.addClass('active');
        });
    }
}