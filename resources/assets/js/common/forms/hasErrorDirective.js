/*@ngInject*/
export default function hasErrorDirective() {
    return {
        restrict: 'A',
        require: '^form',
        link(scope, element, attributes, formController) {
            const formInputName = attributes.mezzoHasError;
            const formInput = formController[formInputName];

            scope.$watch(() => formInput.$valid, (isValid, wasValid) => {
                console.log(isValid, wasValid);
                const isDirty = formInput.$dirty;

                if(!isDirty) {
                    return;
                }

                if(isValid === wasValid) {
                    return;
                }

                $(element).toggleClass('has-error', !isValid);
            });

            scope.$watch
        }
    };
}