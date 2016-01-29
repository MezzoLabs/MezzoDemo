/*@ngInject*/
export default function eventDaysDirective() {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        scope.foo = "hello";

        scope.active = false;

        scope.activeClass = function () {
            return scope.active ? 'active' : '';
        };

        scope.toggleActive = function () {
            scope.active = !scope.active;
        };

        scope.queryChanged = function () {
            var query = scope.query;

            var result = search(query);

            if (result) {
                scope.showModal();
            }
        };

        scope.showModal = function(){
            $('#global-search__modal').modal();
        };


        console.log('lin edays');
    }


    function search(query) {
        if (query.length < 3) return false;

        return true;
    }
}