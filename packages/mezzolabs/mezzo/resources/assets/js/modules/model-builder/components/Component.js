export default class Component {

    constructor(name, templateUrl, modifyOptions){
        this.name = name;
        this.directive = directive(templateUrl, modifyOptions);
    }

}

function directive(templateUrl, modifyOptions){
    return /*@ngInject*/ function inject(componentService){
        return {
            restrict: 'E',
            templateUrl: 'modules/model-builder/components/' + templateUrl,
            link
        };

        function link(scope){
            var options = componentService.options;
            scope.options = options;

            modifyOptions(options)
        }
    };
}