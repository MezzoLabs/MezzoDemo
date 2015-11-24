import FilePickerController from './FilePickerController';

/*@ngInject*/
export default function filePickerModalDirective() {
    return {
        restrict: 'E',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/filePickerModalDirective.html',
        scope: {
            fileTypes: '@',
            fieldName: '@',
            multiple: '@'
        },
        controller: FilePickerController,
        controllerAs: 'vm',
        bindToController: true
    };
}