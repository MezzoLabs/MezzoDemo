import State from './State';

export default {name: 'mezzoRegisterState', directive};

/*@ngInject*/
function directive(addState) {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        var uri = attributes.uri;
        var title = attributes.title;
        var templateUrl = '/mezzo/' + uri + '.html';
        var state = new State(title, uri, {
            main: {
                templateUrl
            }
        });

        addState(state);
    }
}