export default class ComponentOptions {

    constructor(name, templateUrl, controller){
        this.name = name;
        this.directive = directive(templateUrl, controller);
    }

}

function directive(templateUrl, controller){
    return /*@ngInject*/ function inject(componentService){
        return {
            restrict: 'E',
            templateUrl: 'modules/model-builder/components/' + templateUrl,
            link
        };

        function link(scope){
            componentService.onOptionsChange(options => {
                scope.options = options;
            });

            if(controller){
                controller(scope);
            }
        }
    };
}