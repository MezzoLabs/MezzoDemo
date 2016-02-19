export default class InputHelperService {

    getFormInputByElement(inputElement, scope, formController) {
        return new Promise((resolve, reject) => {
            const destroyNameWatch = scope.$watch(() => inputElement.attr('name'), onInputNameChange);

            function onInputNameChange(newName, oldName) {
                const formInput = formController[newName];

                if (!formInput) {
                    return;
                }

                destroyNameWatch();

                return resolve(formInput);
            }
        });
    }

}